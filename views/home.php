<?php
    /**
    * Page d'accueil affichant 6 films à l'affiche (s'il y en a) et 6 films récemment ajoutés
    * @author Hugo Gomes
    */
?>

            <div class="accordion accordion-flush" id="accordionFlushExample">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                        Recherche par filtres avancés
                    </button>
                    </h2>
                <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-6">
                                    <h3>Catégories</h3>
                                    <div class="list-group">
                                        <!--Catégorie Comédie-->
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                            <label class="form-check-label" for="flexSwitchCheckDefault">Comédie</label>
                                        </div>
                                        <!--Catégorie Drame-->
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked">
                                            <label class="form-check-label" for="flexSwitchCheckChecked">Drame</label>
                                        </div>
                                        <!--Catégorie Romance-->
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                            <label class="form-check-label" for="flexSwitchCheckDefault">Romance</label>
                                        </div>
                                        <!--Catégorie Aventure-->
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked">
                                            <label class="form-check-label" for="flexSwitchCheckChecked">Aventure</label>
                                        </div>
                                        <!--Catégorie Thriller-->
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                            <label class="form-check-label" for="flexSwitchCheckDefault">Thriller</label>
                                        </div>
                                        <!--Catégorie Action-->
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked">
                                            <label class="form-check-label" for="flexSwitchCheckChecked">Action</label>
                                        </div>
                                        <!--Catégorie Musique-->
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                            <label class="form-check-label" for="flexSwitchCheckDefault">Musique</label>
                                        </div>
                                        <!--Catégorie Horreur-->
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked">
                                            <label class="form-check-label" for="flexSwitchCheckChecked">Horreur</label>
                                        </div>
                                        <!--Catégorie Science-fiction-->
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked">
                                            <label class="form-check-label" for="flexSwitchCheckChecked">Science-fiction</label>
                                        </div>
                                        <!--Catégorie Fantastique-->
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                            <label class="form-check-label" for="flexSwitchCheckDefault">Fantastique</label>
                                        </div>
                                        <!--Catégorie Historique-->
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked">
                                            <label class="form-check-label" for="flexSwitchCheckChecked">Historique</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <h3>Date de Sortie</h3>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container pt-5">
                <h1>Bienvenue sur BingeWatchr</h1>
                <form class="d-flex mb-2" role="search" method="post">
                    <input class="form-control me-2" type="search" aria-label="Search" name="keywords" value="<?php echo($objMovieModel->strKeyword); ?>">
                    <input type="submit" class="btn btn-primary btn-sm" value="Rechercher">
                </form>

                <?php if(count($arrMovie) > 0) { ?>
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