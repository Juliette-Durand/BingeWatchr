<?php
    /**
    * Page d'accueil affichant 6 films à l'affiche (s'il y en a) et 6 films récemment ajoutés
    * @author Hugo Gomes
    */
?>
            <div class="accordion accordion-flush" id="accordionFlushExample">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                    <button class="accordion-button collapsed text-center" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                        Recherche par filtres avancés
                    </button>
                    </h2>
                <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                        <form action="#" method="post">
                            <div class="container">
                                <div class="row">
                                    <div class="col-6">
                                        <h3>Catégories</h3>
                                        <div class="list-group">
                                            <!--Liste des catégories-->
                                            <?php foreach($arrCat as $arrDetCat) { ?>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" name="cat[]" value="<?php $objCat->getName() ?>">
                                                <label class="form-check-label" for="flexSwitchCheckDefault">Comédie</label>
                                            </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <h3>Date de Sortie</h3>
                                        <div>
                                            <p><label>Date de début</label></p> 
                                            <p><input type="date"></p> 
                                        </div>
                                        <div>
                                            <p><label>Date de fin</label></p> 
                                            <p><input type="date"></p> 
                                        </div>
                                        <div class="col-4">
                                            <label for="customRange1" class="form-label">Durée du film</label>
                                            <input type="range" class="form-range" id="customRange1">
                                        </div>
                                        <div class="row">
                                            <div class="col-5">
                                                <p><label>Min</label></p> 
                                                <p><input type="number" class="w-30"></p> 
                                            </div>
                                            <div class="col-5">
                                            <p><label>Max</label></p> 
                                            <p><input type="number" class="w-30"></p> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                       <input type="submit" class="p-1" value="filtrer mes recherches">  
                                    </div>
                                </div>
                            </div>    
                        </form>
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