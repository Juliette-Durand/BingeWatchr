<?php 
/**
 * Creator @Arlind Halimi
 * doit fait cette page
 */

    include('head.php');

    require_once("entities/movie_entity.php");
    require_once("models/movie_model.php");

    // object pour Movie Model
    $objMovieModel = new MovieModel(); 


    $objMovie = new MovieEntity(); 
    $arrMovieEntity = $objMovieModel->findMovie();
    

    var_dump($arrMovieEntity);
    
?>
    <div class="container pt-5">
        <div class="row">
            <div class="col-md-4 card">
            <?php
                    $objMovie = new MovieEntity();
                    $objMovie->hydrate($arrMovieEntity);
                    // foreach($arrMovieModel as $arrDetMovie){
                    //     $objMovie = new MovieEntity();
                    //     $objMovie->hydrate($arrDetMovie); 
                ?> 
                <img src="assets/img/movies/movie_posters/<?php echo($objMovie->getPoster()); ?>" alt="photo de film">
                                                        
            </div>
            <div class="col-md-8">
            

                    <h2><?php echo($objMovie->getName()); ?> Titre </h2>
                    <p><?php echo($objMovie->getDesc()); ?> Description</p>
                    <p><?php echo($objMovie->getRelease()); ?> Release</p>
                    <p><?php echo($objMovie->getCreatedate()); ?> creation date</p>
                    <?php // if exist ajoute si non not ajoute ?>
                    <p><?php echo($objMovie->getPegi()); ?> movie pegi 10 / 12 / 16 / 18</p>
                    <p><?php echo($objMovie->getDuration()); ?> movie Duration</p>

                
            </div>
        </div>
    </div>