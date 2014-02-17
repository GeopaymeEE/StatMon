<?php /* Smarty version Smarty-3.1-DEV, created on 2014-02-14 15:30:41
         compiled from "/srv/whsc.vic.edu.au/status/public_html/view/index/html/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:8054788052fd90b1b97329-83687502%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6b2480372cfee156fb82bc14191df65eb89a94ef' => 
    array (
      0 => '/srv/whsc.vic.edu.au/status/public_html/view/index/html/index.tpl',
      1 => 1392352239,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '8054788052fd90b1b97329-83687502',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1-DEV',
  'unifunc' => 'content_52fd90b1bfc006_45966118',
  'variables' => 
  array (
    'servers' => 0,
    'server' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52fd90b1bfc006_45966118')) {function content_52fd90b1bfc006_45966118($_smarty_tpl) {?><div class="container">
	<div class="row">
		
		<table class="table table-striped">
			<thead>
				<tr>
					<th>Server</th>
					<th>Type</th>
					<th>Status</th>
					<th>RTT</th>
					<th>Check</th>
				</tr>
			</thead>
			<tbody>
			<?php  $_smarty_tpl->tpl_vars['server'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['server']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['servers']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['server']->key => $_smarty_tpl->tpl_vars['server']->value) {
$_smarty_tpl->tpl_vars['server']->_loop = true;
?>
				<tr class="<?php echo $_smarty_tpl->tpl_vars['server']->value['ui']['class'];?>
">
					<td><?php echo $_smarty_tpl->tpl_vars['server']->value['name'];?>
</td>
					<td><?php echo $_smarty_tpl->tpl_vars['server']->value['type'];?>
</td>
					<td><?php echo $_smarty_tpl->tpl_vars['server']->value['status'];?>
</td>
					<td><?php echo $_smarty_tpl->tpl_vars['server']->value['rtt'];?>
s</td>
					<td><a href="/?view=scan&server_id=<?php echo $_smarty_tpl->tpl_vars['server']->value['id'];?>
" class="btn btn-primary btn-xs" role="button">Scan now</a></td>
				</tr>
			<?php } ?>
			</tbody>
		</table>
		
	</div>
</div><?php }} ?>
