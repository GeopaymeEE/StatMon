<?php 
	/**
	 * Index page
	 * @package StatMon
	 * @since Version 1.0
	 * @author Michael Greenhill
	 */
	
	$Servers = new Servers();
	
	$data = array();
	
	foreach ($Servers->servers as $Server) {
		$data[$Server->id] = array(
			"name" => $Server->name,
			"address" => $Server->address
		);
		
		if ($Server->Type instanceof Type) {
			$data[$Server->id]['type'] = $Server->Type->name;
		}
		
		$Scan = new Scan;
		$Scan->getLatestFromServer($Server); 
		
		$data[$Server->id]['status'] = $Scan->result;
		$data[$Server->id]['rtt'] = number_format($Scan->rtt, 2);
		
		if ($Scan->timestamp instanceof DateTime) {
			$data[$Server->id]['timestamp'] = $Scan->timestamp->format(DATE_RFC2822);
		} else {
			$data[$Server->id]['timestamp'] = "";
		}
		
		if ($Scan->result == "down") {
			$data[$Server->id]['ui']['class'] = "danger";
		} elseif ($Scan->rtt > $Server->rtt_max || $Scan->result == "") {
			$data[$Server->id]['ui']['class'] = "warning"; 
		} else {
			$data[$Server->id]['ui']['class'] = "";
		}
	}
	
	$Smarty->assign("servers", $data);
	$Smarty->display("index.tpl");
?>