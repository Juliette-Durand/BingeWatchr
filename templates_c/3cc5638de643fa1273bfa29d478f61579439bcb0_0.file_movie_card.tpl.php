<?php
/* Smarty version 5.4.3, created on 2025-02-13 15:33:32
  from 'file:views/_partial/movie_card.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.3',
  'unifunc' => 'content_67ae10ccaa9367_83285324',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3cc5638de643fa1273bfa29d478f61579439bcb0' => 
    array (
      0 => 'views/_partial/movie_card.tpl',
      1 => 1739450747,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_67ae10ccaa9367_83285324 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\wamp64\\www\\BingeWatchrs\\views\\_partial';
?><div class="col-2">
    <div class="card">
            <a href="page_dun_film.php?id=<?php echo $_smarty_tpl->getValue('objMovie')->getId();?>
"> 
                <img src="assets/img/movies/movie_posters/<?php echo $_smarty_tpl->getValue('objSmarty')->getPoster();?>
" class="card-img-top" alt="Affiche du film <?php echo $_smarty_tpl->getValue('objMovie')->getName();?>
">
                <div class="card-body">
                <h3 class="card-title text-center"><?php echo $_smarty_tpl->getValue('objMovie')->getName();?>
</h3>
            </a>
        </div>
    </div>
</div><?php }
}
