<?php
include_once('head.php');

            require_once("entities/movie_entity.php");
			require_once("models/movie_model.php");

			// object pour Movie Model
			$objMovieModel = new MovieModel(); 

            //Utilisation (création d'un tableau contenant les infos de la requête)
            $arrMovie = $objMovieModel->movieDisplay();
            $arrRecentMovie = $objMovieModel->movieRecentAdd();
            $arrKeyword = $objMovieModel->findKeyword();
            //var_dump($arrMovie);

            // Récupération des données du formulaire
	        $objMovieModel->strKeyword = $_POST['keywords']??"";
            
            ?>

            

            <div class="container pt-5">
                <h1>Bienvenue sur BingeWatchr</h1>
                <form class="d-flex mb-2" role="search" method="post">
                    <input class="form-control me-2" type="search" aria-label="Search" name="keywords" value="<?php echo($objMovieModel->strKeyword); ?>">
                    <button type="button" class="btn btn-primary btn-sm">Rechercher</button>
                </form>
                <div class="row">
                    <h2>Films à l'affiche</h2>
                    <?php 
                        foreach($arrMovie as $arrDetMovie) {
                            $objMovie = new MovieEntity();
                            $objMovie->hydrate($arrDetMovie);
                            include('movie_card.php');
                        }

                    ?>
                </div>

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

                <div class="row">
                    <span>Vous ne trouvez pas le film que vous cherchez ?</span>
                    <a href="form_movie.php"><button type="button" class="btn btn-primary btn-sm">Ajoutez le ici</button></a>
                </div>
            </div>

    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
