<?php
	/**
	 * Status monitor local config
	 * @since Version 1.0
	 * @package StatMon
	 * @author Michael Greenhill
	 */
	
	/**
	 * Disable PHP5's Zend OpCache
	 */
	
	if (function_exists("opcache_reset")) {
		opcache_reset();
	}
	
	/**
	 * Set the default timezone
	 */
	
	date_default_timezone_set("Australia/Melbourne");
	
	/**
	 * Start the session
	 */
	
	session_start();
	
	/**
	 * Get the error reporting in early
	 */
	
	require_once("includes" . DIRECTORY_SEPARATOR . "inc.error_reporting.php");
	require_once("includes" . DIRECTORY_SEPARATOR . "functions.php");
	
	/**
	 * Add to thie include path
	 */
	
	set_include_path(get_include_path() . PATH_SEPARATOR . __DIR__ );
	
	/**
	 * Create an default configuration array
	 * Define your custom settings in localconfig.php, which should be located in the same directory as this file. Any settings in localsettings.php override those specified here.
	 */
	
	$config = array();
	
	$config['db']['host'] = "";
	$config['db']['user'] = "";
	$config['db']['pass'] = "";
	$config['db']['name'] = "";
	$config['db']['type'] = "PDO_MYSQL"; // At this point only MySQL (including MySQLi and MariaDB) database(s) are supported.
	
	$config['proxy']['host'] = "";
	$config['proxy']['port'] = "";
	$config['proxy']['user'] = "";
	$config['proxy']['pass'] = "";
	
	/**
	 * If a localconfig.php file is found, overwrite any settings here with those
	 */
	
	if (file_exists("localconfig.php")) {
		require_once("localconfig.php"); 
	}
	
	/**
	 * Initiate the Composer autoloader
	 */
	
	require_once("vendor" . DIRECTORY_SEPARATOR . "autoload.php");
	
	/**
	 * Create the database object and connect to it
	 */
	 
	use Zend\Db\Adapter\Adapter;
	
	$adapter = new Zend\Db\Adapter\Adapter(array(
		"driver" => $config['db']['type'],
		"host" => $config['db']['host'],
		"username" => $config['db']['user'],
		"password" => $config['db']['pass'],
		"database" => $config['db']['name']
	));
	
	Zend\Db\TableGateway\Feature\GlobalAdapterFeature::setStaticAdapter($adapter);
	
	/**
	 * Load some files, do some stuff...
	 */
	
	require_once("includes" . DIRECTORY_SEPARATOR . "inc.smarty.php");
	
	/**
	 * Load the site modules
	 */
	
	require_once("includes" . DIRECTORY_SEPARATOR . "class.db.server.php"); 
	require_once("includes" . DIRECTORY_SEPARATOR . "class.db.servers.php"); 
	require_once("includes" . DIRECTORY_SEPARATOR . "class.db.type.php"); 
	require_once("includes" . DIRECTORY_SEPARATOR . "class.db.types.php"); 
	require_once("includes" . DIRECTORY_SEPARATOR . "class.db.scan.php"); 
?>