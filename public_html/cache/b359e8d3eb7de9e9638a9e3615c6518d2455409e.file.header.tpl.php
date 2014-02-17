<?php /* Smarty version Smarty-3.1-DEV, created on 2014-02-17 10:49:24
         compiled from "/srv/whsc.vic.edu.au/status/public_html/html/global/header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:152475643752fd90dbdba470-21230228%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b359e8d3eb7de9e9638a9e3615c6518d2455409e' => 
    array (
      0 => '/srv/whsc.vic.edu.au/status/public_html/html/global/header.tpl',
      1 => 1392594305,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '152475643752fd90dbdba470-21230228',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1-DEV',
  'unifunc' => 'content_52fd90dbe0e582_31296184',
  'variables' => 
  array (
    'pagetitle' => 0,
    'message_ok' => 0,
    'text' => 0,
    'message_error' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52fd90dbe0e582_31296184')) {function content_52fd90dbe0e582_31296184($_smarty_tpl) {?><!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php echo $_smarty_tpl->tpl_vars['pagetitle']->value;?>
</title>
<link rel="stylesheet" href="/css/bootstrap.min.css">
<link rel="stylesheet" href="/css/bootstrap-theme.min.css">
<link rel="stylesheet" href="/css/style.css">
<script src="/js/jquery-2.1.0.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
</head>

<body>
	<nav class="navbar navbar-default navbar-static-top navbar-inverse" role="navigation">
		<div class="container">
			<div class="navbar-header">
				<a class="navbar-brand" href="/">StatMon</a>
			</div>
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li><a href="/?view=addserver">Add server</a></li>
				</ul>
			</div>
		</div>
	</nav>
	
	<?php if (isset($_smarty_tpl->tpl_vars['message_ok']->value)&&count($_smarty_tpl->tpl_vars['message_ok']->value)) {?>
	<div class="container">
		<div class="row">
			<?php  $_smarty_tpl->tpl_vars['text'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['text']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['message_ok']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['text']->key => $_smarty_tpl->tpl_vars['text']->value) {
$_smarty_tpl->tpl_vars['text']->_loop = true;
?><div class="alert alert-success"><?php echo $_smarty_tpl->tpl_vars['text']->value;?>
</div><?php } ?>
		</div>
	</div>
	<?php }?>
	
	<?php if (isset($_smarty_tpl->tpl_vars['message_error']->value)&&count($_smarty_tpl->tpl_vars['message_error']->value)) {?>
	<div class="container">
		<div class="row">
			<?php  $_smarty_tpl->tpl_vars['text'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['text']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['message_error']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['text']->key => $_smarty_tpl->tpl_vars['text']->value) {
$_smarty_tpl->tpl_vars['text']->_loop = true;
?><div class="alert alert-danger"><?php echo $_smarty_tpl->tpl_vars['text']->value;?>
</div><?php } ?>
		</div>
	</div>
	<?php }?><?php }} ?>
