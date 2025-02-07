<?php
    /**
    * Page affichant tous les films à l'affiche (s'il y en a) et 6 films récemment ajoutés
    * @author Hugo Gomes
    */
?>

<?php if(count($arrMovie) > 0) { ?>
    <div class="row">
        <h2>Tous les films</h2>
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