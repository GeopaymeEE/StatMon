<?php
	/**
	 * Smarty configuration
	 * @since Version 1.0
	 * @package StatMon
	 * @author Michael Greenhill
	 */
	
	if (!defined("DS")) {
		define("DS", DIRECTORY_SEPARATOR);
	}
	
	require_once("vendor" . DS . "smarty" . DS . "smarty" . DS . "distribution" . DS . "libs" . DS . "Smarty.class.php");
	
	$Smarty = new Smarty;
	$Smarty->setCompileDir(dirname(__DIR__) . DS . "cache");
	$Smarty->setTemplateDir(dirname(__DIR__) . DS . "html" . DS . "global");
?>