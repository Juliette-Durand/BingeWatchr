<?php 
/**
 * Creator @Arlind Halimi
 * doit fait cette page
 */
?>
    <div class="container pt-5">
        <div class="row">
            <div class="col-md-4 card">
                
                <img src="assets/img/movies/movie_posters/<?php echo($objMovie->getPoster()); ?>" alt="photo de film">
                                                        
            </div>
            <div class="col-md-8">
            

                    <h2><?php echo($objMovie->getName()); ?>  </h2>
                    <p><?php echo($objMovie->getDesc()); ?> </p>
                    <p><?php echo($objMovie->getDateFr()); ?> </p>
                    <p><?php echo($objMovie->getCreation_date()); ?>  </p>
                    <?php if($objMovie->getPegi() != null){ ?>
                        <p><?php echo($objMovie->getPegi()); ?> </p>
                    <?php } ?>
                    <p><?php echo($objMovie->getDuration()); ?> </p>

                    <?php 
                        $objActorsModel = new ActorModel();
                        
                        $arrActors = $objActorsModel->findActor($idMovie); // cherche le ID de movie

                        foreach($arrActors as $actor){
                            $objOneActor = new ActorEntity();
                            $objOneActor->hydrate($actor);
                            
                            ?> 
                            <p> <?php echo($objOneActor->getLast_name()." ". $objOneActor->getFirst_name()); ?> </p>
                        <?php }
                    ?>
                <?php
                // ajoute 3 dernier comments par requete LIMIT 3
                ?>
                <?php if(isset($_SESSION['user'])){ ?>
                    <form class="col-10 form-control" method="post" id="movie_form" enctype="multipart/form-data">
                        <?php if (count($arrErrors) > 0){ ?>
                            <div class="alert alert-danger">
                                <?php foreach($arrErrors as $strError){ ?>
                                    <p><?php echo $strError; ?></p>
                                <?php } ?>
                            </div>
                        <?php } else if($strSuccess != ""){ ?>
                            <div class="alert alert-success">
                                <?php echo($strSuccess); ?>
                            </div>
                        <?php } ?>
                        <label class="col-12" for="title">Title comment</label>
                        <input class="col-12 form-control my-3 <?php echo (isset($arrErrors['title']))?'is-invalid':'';  ?>" type="text" name="title" id="title" value="<?php echo($objCommentEntity->getTitle()) ?>">
                        <textarea class="col-12 form-control <?php echo (isset($arrErrors['content']))?'is-invalid':'';  ?>" name="content" id="content" value=""><?php echo($objCommentEntity->getContent()) ?></textarea>

                        <?php if($intNbTotalPic < 10){ ?>
                            <label for="picture">Ajouter des photos :</label>
                            <input type="file" name="pictures[]" for="picture" multiple>
                        <?php } ?>


                        <input class="col-12 btn btn-primary my-3" type="submit" name="addComent" id="addComment" value="add comment">
                    </form>
                <?php } ?>
            </div>
            <h3 class='mt-5'>Dernier trois commentes : </h3>

            <?php
                foreach($arrComments as $arrDetComment){
                    $objCommentEntity = new CommentEntity(); // Article 'coquille vide' 
                    $objCommentEntity->hydrate($arrDetComment);
                    include("views/_partial/comment.php");
                }
            ?>
            <!-- button pour partage movie par mail -->
            <a href="http://localhost/BingeWatchr-10/BingeWatchr/future_index.php?ctrl=movie&action=contact" class="btn">Partage par email</a>
        </div>
    </div>