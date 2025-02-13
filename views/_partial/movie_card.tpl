<div class="col-2">
    <div class="card">
            <a href="page_dun_film.php?id={$objMovie->getId()}"> 
                <img src="assets/img/movies/movie_posters/{$objSmarty->getPoster()}" class="card-img-top" alt="Affiche du film {$objMovie->getName()}">
                <div class="card-body">
                <h3 class="card-title text-center">{$objMovie->getName()}</h3>
            </a>
        </div>
    </div>
</div>