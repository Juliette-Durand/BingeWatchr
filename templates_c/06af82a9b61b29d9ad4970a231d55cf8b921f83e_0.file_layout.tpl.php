<?php
/* Smarty version 5.4.3, created on 2025-02-13 15:33:32
  from 'file:views/layout.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.3',
  'unifunc' => 'content_67ae10cc721ed5_69294143',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '06af82a9b61b29d9ad4970a231d55cf8b921f83e' => 
    array (
      0 => 'views/layout.tpl',
      1 => 1739435586,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:views/_partial/head.tpl' => 1,
    'file:views/_partial/footer.tpl' => 1,
  ),
))) {
function content_67ae10cc721ed5_69294143 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\wamp64\\www\\BingeWatchrs\\views';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, false);
$_smarty_tpl->renderSubTemplate('file:views/_partial/head.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>

<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_65462051267ae10cc7202c2_67127366', "contenu");
?>


<?php $_smarty_tpl->renderSubTemplate('file:views/_partial/footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
}
/* {block "contenu"} */
class Block_65462051267ae10cc7202c2_67127366 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\wamp64\\www\\BingeWatchrs\\views';
?>

    Contenu par défaut
<?php
}
}
/* {/block "contenu"} */
}
