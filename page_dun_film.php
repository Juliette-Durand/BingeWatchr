<?php 
/**
 * Creator @Arlind Halimi
 * doit fait cette page
 */


    include('head.php');

    require_once("entities/movie_entity.php");
    require_once("entities/acteur_entity.php");
    require_once("models/movie_model.php");
    require_once("models/actor_model.php");

    // object pour Movie Model
    $objMovieModel = new MovieModel(); 


    $objMovie = new MovieEntity(); 
    $objMovie->setId($_GET["id"]);
    //var_dump($objMovie->getId());
    $arrMovieEntity = $objMovieModel->findMovie($objMovie->getId());
    
// if (isset($_GET['id']) && ($_GET['id'] != $_SESSION['movie']->getId())){
// 		header("Location:error_403.php");
// 	}
    //var_dump($arrMovieEntity);
    
?>
    <div class="container pt-5">
        <div class="row">
            <div class="col-md-4 card">
            <?php
                    $objMovie = new MovieEntity();
                    $objMovie->hydrate($arrMovieEntity);
                ?> 
                <img src="assets/img/movies/movie_posters/<?php echo($objMovie->getPoster()); ?>" alt="photo de film">
                                                        
            </div>
            <div class="col-md-8">
            

                    <h2><?php echo($objMovie->getName()); ?>  </h2>
                    <p><?php echo($objMovie->getDesc()); ?> </p>
                    <p><?php echo($objMovie->getDateFr()); ?> </p>
                    <p><?php echo($objMovie->getCreatedate()); ?>  </p>
                    <?php if($objMovie->getPegi() != null){ ?>
                        <p><?php echo($objMovie->getPegi()); ?> </p>
                    <?php } ?>
                    <p><?php echo($objMovie->getDuration()); ?> </p>

                    <?php 
                         $objActors = new ActorModel();
                         $arrActors = $objActors->findActor($objMovie->getId()); // e gjen id e filmit

                        foreach($arrActors as $actor){
                            $objOneActor = new ActorEntity();
                            $objOneActor->hydrate($actor);
                            //var_dump($objOneActor);
                            
                            ?> 
                            <p> <?php echo($objOneActor->getLast_name()." ". $objOneActor->getFirst_name()); ?> </p>
                        <?php }
                        //var_dump($arrActors);
                    ?>
                    
                
            </div>
        </div>
    </div>