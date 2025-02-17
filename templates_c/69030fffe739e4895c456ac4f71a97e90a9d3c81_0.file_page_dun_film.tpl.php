<?php
/* Smarty version 5.4.3, created on 2025-02-17 15:06:06
  from 'file:views/page_dun_film.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.3',
  'unifunc' => 'content_67b3505eba3a37_88182785',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '69030fffe739e4895c456ac4f71a97e90a9d3c81' => 
    array (
      0 => 'views/page_dun_film.tpl',
      1 => 1739463826,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_67b3505eba3a37_88182785 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\wamp64\\www\\BingeWatchrs\\views';
?>
    <div class="container pt-5">
        <div class="row">
            <div class="col-md-4 card">
                
                <img src="assets/img/movies/movie_posters/<?php echo $_smarty_tpl->getValue('objMovie')->getPoster();?>
" alt="photo de film">
                                                        
            </div>
            <div class="col-md-8">
            

                    <h2><?php echo $_smarty_tpl->getValue('objMovie')->getName();?>
</h2>
                    <p><?php echo $_smarty_tpl->getValue('objMovie')->getDesc();?>
</p>
                    <p><?php echo $_smarty_tpl->getValue('objMovie')->getDateFr();?>
</p>
                    <p><?php echo $_smarty_tpl->getValue('objMovie')->getCreation_date();?>
</p>
                    <?php if ($_smarty_tpl->getValue('objMovie')->getPegi() != null) {?>
                        <p><?php echo $_smarty_tpl->getValue('objMovie')->getPegi();?>
</p>
                    <?php }?>
                    <p><?php echo $_smarty_tpl->getValue('objMovie')->getDuration();?>
</p>
                                    <?php echo '<?php'; ?>
 if(isset($_SESSION['user'])){ <?php echo '?>'; ?>

                    <form class="col-10 form-control" method="post" id="movie_form" enctype="multipart/form-data">
                        <?php echo '<?php'; ?>
 if (count($arrErrors) > 0){ <?php echo '?>'; ?>

                            <div class="alert alert-danger">
                                <?php echo '<?php'; ?>
 foreach($arrErrors as $strError){ <?php echo '?>'; ?>

                                    <p><?php echo '<?php'; ?>
 echo $strError; <?php echo '?>'; ?>
</p>
                                <?php echo '<?php'; ?>
 } <?php echo '?>'; ?>

                            </div>
                        <?php echo '<?php'; ?>
 } <?php echo '?>'; ?>

                        <label class="col-12" for="title">Title comment</label>
                        <input class="col-12 form-control my-3 <?php echo '<?php'; ?>
 echo (isset($arrErrors['title']))?'is-invalid':'';  <?php echo '?>'; ?>
" type="text" name="title" id="title" value="<?php echo '<?php'; ?>
 echo($strTitleCom) <?php echo '?>'; ?>
">
                        <textarea class="col-12 form-control <?php echo '<?php'; ?>
 echo (isset($arrErrors['content']))?'is-invalid':'';  <?php echo '?>'; ?>
" name="content" id="content" value=""><?php echo '<?php'; ?>
 echo($strContentCom) <?php echo '?>'; ?>
</textarea>
                        <input class="col-12 btn brn-primary my-3" type="submit" name="addComent" id="addComment" value="add comment">
                    </form>
                <?php echo '<?php'; ?>
 } <?php echo '?>'; ?>

            </div>
            
                    <h3 class='mt-5'>Dernier trois commentes : </h3>
                    

                    <?php echo '<?php'; ?>

                        foreach($arrComments as $arrDetComment){
                            $objCommentEntity = new CommentEntity(); // Article 'coquille vide' 
                            $objCommentEntity->hydrate($arrDetComment);
                            include("views/_partial/comment.php");
                        }
                    <?php echo '?>'; ?>

                    
            
        </div>
    </div><?php }
}
