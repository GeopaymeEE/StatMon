<?php
	/**
	 * StatMon header
	 * @since Version 1.0
	 * @package StatMon
	 * @author Michael Greenhill
	 */
	
	if (isset($_SESSION['message'])) {
		$Smarty->assign("message_ok", $_SESSION['message']);
		unset($_SESSION['message']);	
	}
	
	if (isset($_SESSION['error'])) {
		$Smarty->assign("message_error", $_SESSION['error']);
		unset($_SESSION['error']);
	}
	
	$Smarty->display("header.tpl");
?>