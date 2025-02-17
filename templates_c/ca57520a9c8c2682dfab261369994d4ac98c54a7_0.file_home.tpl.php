<?php
/* Smarty version 5.4.3, created on 2025-02-17 15:15:40
  from 'file:views/home.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.3',
  'unifunc' => 'content_67b3529cb22d77_05622822',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ca57520a9c8c2682dfab261369994d4ac98c54a7' => 
    array (
      0 => 'views/home.tpl',
      1 => 1739527603,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:views/_partial/movie_card.tpl' => 2,
  ),
))) {
function content_67b3529cb22d77_05622822 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\wamp64\\www\\BingeWatchrs\\views';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>
              

    <?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_163192939967b3529cb099b9_60410404', "contenu");
$_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "views/layout.tpl", $_smarty_current_dir);
}
/* {block "contenu"} */
class Block_163192939967b3529cb099b9_60410404 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\wamp64\\www\\BingeWatchrs\\views';
?>

    <div class="container pt-5">
        <h1><?php echo $_smarty_tpl->getValue('strTitle');?>
</h1>              

        <?php if ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('arrMovies')) > 0) {?>
        <div class="row">
            <h2>Films à l'affiche</h2>
                <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('arrMovies'), 'objMovie');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('objMovie')->value) {
$foreach0DoElse = false;
?>
                    <?php $_smarty_tpl->renderSubTemplate("file:views/_partial/movie_card.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>
                <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
        </div>
        <?php }?>
        
        <?php if ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('arrRecentMovie')) > 0) {?>
        <div class="row">
            <h2>Films récemment ajoutés</h2>
                <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('arrRecentMovie'), 'objMovie');
$foreach1DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('objMovie')->value) {
$foreach1DoElse = false;
?>
                    <?php $_smarty_tpl->renderSubTemplate("file:views/_partial/movie_card.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>
                <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
        </div>
        <?php }?>

        <div class="row">
            <span>Vous ne trouvez pas le film que vous cherchez ?</span>
            <a href="form_movie.php"><button type="button" class="btn btn-primary btn-sm">Ajoutez le ici</button></a>
        </div>
    </div>
    <?php
}
}
/* {/block "contenu"} */
}
