<?php
	/**
	 * StatMon index file
	 * @since Version 1.0
	 * @package StatMon
	 * @author Michael Greenhill
	 */
	
	/**
	 * Load the config
	 */
	
	require_once("config.php");
	
	$Smarty->assign("pagetitle", "StatMon");
	
	/**
	 * Load the header
	 */
	
	require_once("header.php"); 
	
	/**
	 * Check if the requested file / module is available, and load
	 */
	
	$view = isset($_REQUEST['view']) && !empty($_REQUEST['view']) ? $_REQUEST['view'] : "index";
	
	if ($view && file_exists("view" . DIRECTORY_SEPARATOR . $view . DIRECTORY_SEPARATOR . "index.php")) {
		try {
			$Smarty->addTemplateDir(__DIR__ . DIRECTORY_SEPARATOR . "view" . DIRECTORY_SEPARATOR . $view . DIRECTORY_SEPARATOR . "html");
			
			require_once("view" . DIRECTORY_SEPARATOR . $view . DIRECTORY_SEPARATOR . "index.php");
		} catch (Exception $e) {
			printArray($e->getMessage());
			printArray($e->getFile() . "(" . $e->getLine() . ")");
			printArray($e->getTraceAsString());
		}
	}
	
	/**
	 * Load the footer
	 */
	
	require_once("footer.php");
?>