<?php /* Smarty version Smarty-3.1-DEV, created on 2014-02-17 12:40:32
         compiled from "/srv/whsc.vic.edu.au/status/public_html/view/addserver/html/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:12336827035301395eee8ab5-17385324%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3d8ed3711a2bd83b32dd22b85f6bd81337b995e8' => 
    array (
      0 => '/srv/whsc.vic.edu.au/status/public_html/view/addserver/html/index.tpl',
      1 => 1392601232,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '12336827035301395eee8ab5-17385324',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1-DEV',
  'unifunc' => 'content_5301395ef107d1_57369155',
  'variables' => 
  array (
    'types' => 0,
    'id' => 0,
    'data' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5301395ef107d1_57369155')) {function content_5301395ef107d1_57369155($_smarty_tpl) {?><div class="container">
	<div class="row">
		<h1>Add a server to monitor</h1>
		<form action="?view=addserver" method="post" role="form" class="validate">
				
			<div class="bs-callout bs-callout-info">
				<h4>Basic information</h4>
				<p>Server name, address, etc.</p>
			</div>
				
			<div class="form-group">
				<label for="server_name">Name</label>
				<input type="text" placeholder="Enter the name of your monitored device" id="server_name" name="server_name" class="form-control required">
				<span class="glyphicon form-control-feedback" style="display: none;"></span>
			</div>
			
			<div class="form-group">
				<label for="server_address">Address</label>
				<input type="text" placeholder="Enter the address your monitored device" id="server_address" name="server_address" class="form-control required">
				<span class="glyphicon form-control-feedback" style="display: none;"></span>
			</div>
			
			<div class="form-group">
				<label for="server_rtt">Connection timeout</label>
				<input type="number" placeholder="Maximum time in seconds before the status checker gives up" id="server_rtt" name="server_rtt" class="form-control required">
				<span class="glyphicon form-control-feedback" style="display: none;"></span>
			</div>
			
			<div class="form-group">
				<label for="server_type">Type</label>
				<select class="form-control" name="server_type" id="server_type">
					<?php  $_smarty_tpl->tpl_vars['data'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['data']->_loop = false;
 $_smarty_tpl->tpl_vars['id'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['types']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['data']->key => $_smarty_tpl->tpl_vars['data']->value) {
$_smarty_tpl->tpl_vars['data']->_loop = true;
 $_smarty_tpl->tpl_vars['id']->value = $_smarty_tpl->tpl_vars['data']->key;
?>
					<option value="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['data']->value['type_name'];?>
 (<?php echo $_smarty_tpl->tpl_vars['data']->value['type_port'];?>
)</option>
					<?php } ?>
				</select>
			</div>
			
			<div class="form-group">
				<div class="bs-callout bs-callout-info">
					<h4>Proxy server</h4>
					<p>Used to check a website outside of your corporate network. Leave blank if not needed. </p>
				</div>
				
				<label>Proxy server address and port</label>
				<div class="row">
					<div class="col-xs-10">
						<input type="text" placeholder="Proxy server address" name="server_meta[proxy][address]" class="form-control">
					</div>
					<div class="col-xs-2">
						<input type="number" placeholder="Port number" name="server_meta[proxy][port]" class="form-control">
					</div>
				</div>
				<label>Proxy server authentication</label>
				<div class="row">
					<div class="col-xs-6">
						<input type="text" placeholder="Proxy server username" name="server_meta[proxy][username]" class="form-control">
					</div>
					<div class="col-xs-6">
						<input type="password" placeholder="Proxy server password" name="server_meta[proxy][password]" class="form-control">
					</div>
				</div>
			</div>
			
			<button type="submit" class="btn btn-primary">Submit</button>
		</form>
	</div>
</div>

<script>
	$(".validate").on("submit", function(e) {
		
		$(this).find(".required").each(function() {
			$(this).removeClass("ok");
			
			if ($(this).val() == "" || typeof $(this).val() == "undefined") {
				$(this).parent().removeClass("has-success").addClass("has-error has-feedback").find(".glyphicon").show().addClass("glyphicon-remove").removeClass("glyphicon-ok");
			} else {
				$(this).addClass("ok").parent().removeClass("has-error").addClass("has-success has-feedback").find(".glyphicon").show().addClass("glyphicon-ok").removeClass("glyphicon-remove");
			}
		});
		
		if ($(this).find(".required").length != $(this).find(".ok").length) {
			e.preventDefault(); 
			
			console.log($(this).find(".required").length);
			console.log($(this).find(".ok").length);
		}
	});
</script><?php }} ?>
