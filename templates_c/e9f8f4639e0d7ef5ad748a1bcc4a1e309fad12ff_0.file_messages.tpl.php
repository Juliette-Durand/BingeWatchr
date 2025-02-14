<?php
/* Smarty version 5.4.3, created on 2025-02-14 10:34:26
  from 'file:views/_partial/messages.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.3',
  'unifunc' => 'content_67af1c321696b6_08577256',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e9f8f4639e0d7ef5ad748a1bcc4a1e309fad12ff' => 
    array (
      0 => 'views/_partial/messages.tpl',
      1 => 1739527951,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_67af1c321696b6_08577256 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\wamp64\\www\\BingeWatchrs\\views\\_partial';
if (($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('arrErrors')) > 0)) {?>
<div class="alert alert-danger">
<?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('arrErrors'), 'strError');
$foreach2DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('strError')->value) {
$foreach2DoElse = false;
?>
    <p><?php echo $_smarty_tpl->getValue('strError');?>
</p>
<?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
</div>
<?php }
if (($_smarty_tpl->getValue('strSuccess') != '')) {?>
<div class="alert alert-success">
    <p><?php echo $_smarty_tpl->getValue('strSuccess');?>
</p>
</div>
<?php }?>	<?php }
}
