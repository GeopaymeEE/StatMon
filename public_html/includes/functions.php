<?php
	/**
	 * Basic / miscellaneous functions
	 * @since Version 1.0
	 * @package StatMon
	 * @author Michael Greenhill
	 */
	
	function printArray($object = false) {
		if (!$object) {
			return false;
		}
		
		if (is_object($object) || is_array($object)) {
			print "<pre>"; print_r($object); print "</pre>";
		} else {
			print "<pre>"; var_dump($object); print "</pre>";
		}
	}
	
	##############################################
	#
	#	Script By Oscar Liang - www.oscarliang.com
	#	Version 1.0
	#	01/March/2013
	#
	##############################################
	
	function ping($target) {
	
		$result = array();
	
		/* Execute Shell Command To Ping Target */
		$cmd_result = shell_exec("ping -c 1 -w 1 ". $target);
	
		/* Get Results From Ping */
		$result = explode(",",$cmd_result);
	
		/* Return Server Status */
		if (preg_match("#0 received#i", $result[1])){
			return 'offline';
		} elseif (preg_match("#1 received#i", $result[1])){
			return 'online';
		} else {
			return 'unknown';
		}
	
	}
?>