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
            require("entities/movie_entity.php"); 
            $strQuery		=   "SELECT movie_name, movie_poster  
                                FROM movie
                                ORDER BY movie_release DESC
                                LIMIT 6 OFFSET 0;";

	        $arrMovies	= $db->query($strQuery)->fetchAll();
            var_dump(strQuerry)
            
            ?>
            <div class="container pt-5">
                <div class="row">
                    <?php 
                        foreach($arrMovies as $arrDetMovie) {
                            $objMovie = new Movie();
                            $objMovie->setName($arrDetMovie['movie_name']);
                            $objMovie->setPoster($arrDetMovie['movie_poster']);
                        }
                    ?>
                    <div class="col-2">
                        <div class="card" style="width: 18rem;">
                            <img src="https://picsum.photos/200/300" class="card-img-top" alt="...">
                            <div class="card-body">
                            <a href="#"> 
                                <h5 class="card-title text-center">Film Test</h5>
                            </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container pt-5">
                <div class="row">
                    <div class="col-2">
                        <div class="card" style="width: 18rem;">
                            <img src="https://picsum.photos/200/300" class="card-img-top" alt="...">
                            <div class="card-body">
                            <a href="#"> 
                                <h5 class="card-title text-center">Film Test</h5>
                            </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        </body>
    </html>