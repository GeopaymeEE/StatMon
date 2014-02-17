<?php
	/**
	 * Command line server / host scan 
	 * @since Version 1.0
	 * @package StatMon
	 * @author Michael Greenhill
	 */
	
	/**
	 * Load config
	 */
	
	require_once("config.php"); 
	
	/**
	 * Get all the servers
	 */
	 
	$Servers = new Servers();
	
	/**
	 * Loop through each server and scan it
	 */
	
	foreach ($Servers->servers as $Server) {
		$Scan = new Scan;
		$Scan->Server = $Server;
		$Scan->verbose = true;
		$Scan->runScan();
	}
?>