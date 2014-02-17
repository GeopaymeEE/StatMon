<?php
	/**
	 * Add a server
	 * @since Version 1.0
	 * @package StatMon
	 * @author Michael Greenhill
	 */
	
	/**
	 * Add the server
	 */
	
	if (isset($_REQUEST['server_name']) && !empty($_REQUEST['server_name'])) {
		$Server = new Server;
		
		if (isset($_REQUEST['server_id']) && filter_var($_REQUEST['server_id'], FILTER_VALIDATE_INT) && $_REQUEST['server_id'] > 0) {
			$Server->id = $_REQUEST['server_id']; 
			$Server->get();
		}
		
		$Server->name = $_REQUEST['server_name'];
		$Server->address = $_REQUEST['server_address']; 
		$Server->rtt_max = $_REQUEST['server_rtt'];
		$Server->Type = new Type($_REQUEST['server_type']);
		$Server->meta = $_REQUEST['server_meta'];
		
		if ($Server->put()) {
			$_SESSION['message'][] = "Server added";
		}
		
		header("Location: /?view=addserver");die;
	}
	
	/**
	 * Display the form
	 */
	
	$Types = new Types;
	$types = array();
	
	foreach ($Types->types as $Type) {
		$types[$Type->id] = array(
			"type_id" => $Type->id,
			"type_name" => $Type->name,
			"type_port" => $Type->port,
			"type_meta" => $Type->meta
		);
	}
	
	$types = $Smarty->assign("types", $types);
	
	$Smarty->display("index.tpl");
?>