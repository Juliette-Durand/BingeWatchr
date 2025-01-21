<div class="col-2">
    <div class="card">
            <a href="#"> 
                <img src="assets/img/movies/movie_posters/<?php echo($objMovie->getPoster()) ?>" class="card-img-top" alt="Affiche du film <?php echo($objMovie->getName()) ?>">
                <div class="card-body">
                <h3 class="card-title text-center"><?php echo($objMovie->getName()) ?> </h3>
            </a>
        </div>
    </div>
</div>