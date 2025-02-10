<?php
    /**
    * Page d'accueil affichant 6 films à l'affiche (s'il y en a) et 6 films récemment ajoutés
    * @author Hugo Gomes
    */
    //var_dump($_POST);
    //var_dump($objMovieModel);
?>
            

    <div class="container pt-5">
        <h1>Bienvenue sur BingeWatchr</h1>              

        <?php if(count($arrMovie) > 0) { ?>
        <div class="row">
            <h2>Films à l'affiche</h2>
            <?php 
                foreach($arrMovie as $arrDetMovie) {
                    //var_dump($arrMovie);
                    $objMovie = new MovieEntity();
                    $objMovie->hydrate($arrDetMovie);
                    include('movie_card.php');
                }
            ?>
        </div>
        <?php } ?>
        
        <?php if(count($arrRecentMovie) > 0) {  ?>
        <div class="row">
            <h2>Films récemment ajoutés</h2>
            <?php 
                foreach($arrRecentMovie as $arrDetMovie) {
                    $objMovie = new MovieEntity();
                    $objMovie->hydrate($arrDetMovie);
                    include('movie_card.php');
                }
            ?>
        </div>
        <?php } ?>

        <div class="row">
            <span>Vous ne trouvez pas le film que vous cherchez ?</span>
            <a href="form_movie.php"><button type="button" class="btn btn-primary btn-sm">Ajoutez le ici</button></a>
        </div>
    </div>