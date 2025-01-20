<!DOCTYPE html>
    <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
            <title>BingeWatchr - Home</title>
        </head>
        <body>
            <?php
            require_once("entities/movie_entity.php");
			require_once("models/movie_model.php");

			
			
			// object pour Movie Model
			$objMovieModel = new MovieModel(); 

            //Utilisation (création d'un tableau contenant les infos de la requête)
            $arrMovie = $objMovieModel->movieDisplay();
            $arrRecentMovie = $objMovieModel->movieRecentAdd();
            //var_dump($arrMovie);
            
            ?>
            <div class="container pt-5">
                <h1>Bienvenue sur BingeWatchr</h1>
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
            </div>
            

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        </body>
    </html>