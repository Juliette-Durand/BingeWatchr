<?php
    /**
    * Page affichant tous les films à l'affiche (s'il y en a) et 6 films récemment ajoutés
    * @author Hugo Gomes
    */
?>
    <div class="container">
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
                                        <?php foreach($arrCat as $arrDetCat) { 
                                            $objCat = new CategoryEntity(); 
                                            $objCat->setName($arrDetCat['cat_name']); ?>                   
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" name="cat[]" value="<?php //$objCat->getId() ?>">
                                            <label class="form-check-label" for="flexSwitchCheckDefault"><?php echo($objCat->getName()); ?></label>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <h3>Date de Sortie</h3>
                                    <div>
                                        <p><label>Date de début</label></p> 
                                        <p><input type="date" name="startdate" class="form-control w-50" value="<?php echo($objMovieModel->strStartDate) ?>"></p> 
                                    </div>
                                    <div>
                                        <p><label>Date de fin</label></p> 
                                        <p><input type="date" name="enddate" class="form-control w-50" value="<?php echo($objMovieModel->strEndDate) ?>"></p> 
                                    </div>
                                    <div class="row">
                                        <h4>Durée du film (en minutes)</h4>
                                        <div class="col-5">
                                            <p><label>Min</label></p> 
                                            <p><input type="number" name="minduration" class="form-control w-30" value="<?php echo($objMovieModel->strStartTime) ?>"></p> 
                                        </div>
                                        <div class="col-5">
                                        <p><label>Max</label></p> 
                                        <p><input type="number" name="maxduration" class="form-control w-30" value="<?php echo($objMovieModel->strEndTime) ?>"></p> 
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <input type="submit" class="btn btn-primary btn-sm" value="filtrer mes recherches">  
                                </div>
                            </div>
                        </div>    
                    </form>
                </div>
            </div>
        </div>
        <form class="d-flex my-2" role="search" method="post">
            <input class="form-control w-50 me-2" type="search" aria-label="Search" name="keywords" value="<?php echo($objMovieModel->strKeyword); ?>">
            <input type="submit" class="btn btn-primary btn-sm" value="Rechercher">
        </form>
    </div>
    

<div class="container">
   <?php if(count($arrMovie) > 0) { ?>
        <div class="row">
            <h2>Tous les films</h2>
            <?php 
                foreach($arrMovie as $arrDetMovie) {
                    $objMovie = new MovieEntity();
                    $objMovie->hydrate($arrDetMovie);
                    include('movie_card.php');
                }
            ?>
        </div>
    <?php } ?> 
</div>
