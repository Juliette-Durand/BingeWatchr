<?php 
/**
 * Creator @Arlind Halimi
 * doit fait cette page
 */


//     include('head.php');

//     require_once("entities/movie_entity.php");
//     require_once("entities/acteur_entity.php");
//     require_once("models/movie_model.php");
//     require_once("models/actor_model.php");

//     // object pour Movie Model
//     $objMovieModel = new MovieModel(); 
//     $objMovie = new MovieEntity(); 

//     $objMovie->setId($_GET["id"]);

//     $arrMovieEntity = $objMovieModel->findMovie($objMovie->getId());
//     $idMovie = $objMovie->getId()
    
// // if (isset($_GET['id']) && ($_GET['id'] != $_SESSION['movie']->getId())){
// // 		header("Location:error_403.php");
// // 	}
//     //var_dump($arrMovieEntity);
    
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
                            //var_dump($objOneActor);
                            
                            ?> 
                            <p> <?php echo($objOneActor->getLast_name()." ". $objOneActor->getFirst_name()); ?> </p>
                        <?php }
                    ?>
                
                <?php
                // ajoute 3 dernier comments 
                // CODE
                
                ?>
                <?php if(isset($_SESSION['user'])){ ?>
                    <form class="col-10 form-control" method="post" id="movie_form" enctype="multipart/form-data">
                        <?php if (count($arrErrors) > 0){ ?>
                            <div class="alert alert-danger">
                                <?php foreach($arrErrors as $strError){ ?>
                                    <p><?php echo $strError; ?></p>
                                <?php } ?>
                            </div>
                        <?php } ?>
                        <label class="col-12" for="title">Title comment</label>
                        <input class="col-12 form-control my-3 <?php echo (isset($arrErrors['title']))?'is-invalid':'';  ?>" type="text" name="title" id="title" value="<?php echo($strTitleCom) ?>">
                        <textarea class="col-12 form-control <?php echo (isset($arrErrors['content']))?'is-invalid':'';  ?>" name="content" id="content" value=""><?php echo($strContentCom) ?></textarea>
                        <input class="col-12 btn brn-primary my-3" type="submit" name="addComent" id="addComment" value="add comment">
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
                    
            
        </div>
    </div>