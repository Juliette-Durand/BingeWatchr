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

    //Utilisation (création d'un tableau contenant les infos de la requête)
    $arrMovie = $objMovieModel->findAll();

    $objMovie = new MovieEntity(); 
    $arrMovieEntity = $objMovieModel->findMovie();
    

    var_dump($arrMovieEntity);
    
    ?>
    <div class="container pt-5">
        <div class="row">
            <div class="col-md-4 card">
                <img src="assets/img/movies/movie_posters/<?php echo($objMovie->getPoster())?>" alt="photo de film">
            </div>
            <div class="col-md-8">

                <h2><?php echo($objMovie->getName()) ?> Titre </h2>
                <p><?php echo($objMovie->getDesc()) ?> Description</p>
                <p><?php echo($objMovie->getRealise()) ?> Release</p>
                <p><?php echo($objMovie->getCreatedate()) ?> creation date</p>
                <p><?php echo($objMovie->getPegi()) ?> movie pegi 10 / 12 / 16 / 18</p>
                <p><?php echo("") ?> movie display</p>
                <p><?php echo($objMovie->getDuration()) ?> movie Duration</p>
            </div>
        </div>
    </div>