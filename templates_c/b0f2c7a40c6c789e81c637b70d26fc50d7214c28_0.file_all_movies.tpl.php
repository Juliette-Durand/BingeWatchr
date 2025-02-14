<?php
/* Smarty version 5.4.3, created on 2025-02-14 10:42:39
  from 'file:views/all_movies.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.3',
  'unifunc' => 'content_67af1e1f5c7973_14679823',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b0f2c7a40c6c789e81c637b70d26fc50d7214c28' => 
    array (
      0 => 'views/all_movies.tpl',
      1 => 1739529759,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:views/_partial/movie_card.tpl' => 1,
  ),
))) {
function content_67af1e1f5c7973_14679823 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\wamp64\\www\\BingeWatchrs\\views';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>
        

    <?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_213626320867af1e1f5a2358_55627230', "contenu");
?>


<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "views/layout.tpl", $_smarty_current_dir);
}
/* {block "contenu"} */
class Block_213626320867af1e1f5a2358_55627230 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\wamp64\\www\\BingeWatchrs\\views';
?>

    <div class="container">
        <div class="accordion accordion-flush" id="accordionFlushExample">
            <div class="accordion-item">
                <h2 class="accordion-header">
                <button class="accordion-button collapsed text-center" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                    Recherche par filtres avancés
                </button>
                </h2>
            <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                    <form action="#" method="post">
                        <div class="container">
                            <div class="row">
                                <div class="col-6">
                                    <h3>Catégories</h3>
                                    <div class="list-group">
                                        <!--Liste des catégories-->
                                        <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('arrCat'), 'objCat');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('objCat')->value) {
$foreach0DoElse = false;
?> 
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" name="cat[]" <?php if (($_smarty_tpl->getSmarty()->getModifierCallback('in_array')($_smarty_tpl->getValue('objCat')->getId(),$_smarty_tpl->getValue('objMovieModel')->arrCategory))) {?> checked <?php }?> value="<?php echo $_smarty_tpl->getValue('objCat')->getId();?>
">
                                            <label class="form-check-label" for="flexSwitchCheckDefault"><?php echo $_smarty_tpl->getValue('objCat')->getName();?>
</label>
                                        </div>
                                        <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <h3>Date de Sortie</h3>
                                    <div>
                                        <p><label>Date de début</label></p> 
                                        <p><input type="date" name="startdate" class="form-control w-50" value="<?php echo $_smarty_tpl->getValue('objMovieModel')->strStartDate;?>
"></p> 
                                    </div>
                                    <div>
                                        <p><label>Date de fin</label></p> 
                                        <p><input type="date" name="enddate" class="form-control w-50" value="<?php echo $_smarty_tpl->getValue('objMovieModel')->strEndDate;?>
"></p> 
                                    </div>
                                    <div class="row">
                                        <h4>Durée du film (en minutes)</h4>
                                        <div class="col-5">
                                            <p><label>Min</label></p> 
                                            <p><input type="number" name="minduration" class="form-control w-30" value="<?php echo $_smarty_tpl->getValue('objMovieModel')->intStartTime;?>
"></p> 
                                        </div>
                                        <div class="col-5">
                                        <p><label>Max</label></p> 
                                        <p><input type="number" name="maxduration" class="form-control w-30" value="<?php echo $_smarty_tpl->getValue('objMovieModel')->intEndTime;?>
"></p> 
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <input type="submit" class="btn btn-primary btn-sm" value="filtrer mes recherches"> <input type="reset" class="btn btn-primary btn-sm mx-2" value="Réinitialiser">
                                </div>
                            </div>
                        </div>    
                    </form>
                </div>
            </div>
        </div>
        <form class="d-flex my-2" role="search" method="post">
            <input class="form-control w-50 me-2" type="search" aria-label="Search" name="keywords" value="<?php echo $_smarty_tpl->getValue('objMovieModel')->strKeyword;?>
">
            <input type="submit" class="btn btn-primary btn-sm" value="Rechercher">
        </form>
    </div>
    

    <div class="container">
    <?php if (($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('arrAdvMovie')) > 0)) {?>
            <div class="row">
                <h2>Tous les films</h2>
                    <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('arrAdvMovie'), 'objMovie');
$foreach1DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('objMovie')->value) {
$foreach1DoElse = false;
?>
                        <?php $_smarty_tpl->renderSubTemplate("file:views/_partial/movie_card.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>;
                    <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
            </div>
        <?php }?> 
    </div>
    <?php
}
}
/* {/block "contenu"} */
}
