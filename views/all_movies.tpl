    {**
    * Page affichant tous les films à l'affiche (s'il y en a) et 6 films récemment ajoutés
    * @author Hugo Gomes
    *}
    {extends file="views/layout.tpl"}

    {block name="contenu"}

    <div class="container mb-5">
        <h1>{$strTitle}{if $boolDisplay == 1} à l'affiche {/if}</h1>
    </div>
    
    <section class="container" id="adv_search_movie">
    <form action="#" method="post" class="mb-3">
        <div class="accordion accordion-flush" id="accordionFlushExample">
            <div class="accordion-item">
                <h2 class="accordion-header d-flex">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                    <div class="d-flex me-3">
                        <input class="form-control me-2" type="search" aria-label="Search" name="keywords" value="{$objMovieModel->strKeyword}" placeholder="Rechercher un film">
                        <input type="submit" class="btn btn-primary btn-sm" value="Rechercher">
                    </div>
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
                                        <!--Liste des catégories-->
                                        {foreach $arrCat as $objCat} 
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" name="cat[]" {if (in_array($objCat->getId(), $objMovieModel->arrCategory))} checked {/if} value="{$objCat->getId()}">
                                            <label class="form-check-label" for="flexSwitchCheckDefault">{$objCat->getName()}</label>
                                        </div>
                                        {/foreach}
                                    </div>
                                </div>
                                <div class="col-6">
                                    <h3>Date de Sortie</h3>
                                    <div>
                                        <p><label>Date de début</label></p> 
                                        <p><input type="date" name="startdate" class="form-control w-50" value="{$objMovieModel->strStartDate}"></p> 
                                    </div>
                                    <div>
                                        <p><label>Date de fin</label></p> 
                                        <p><input type="date" name="enddate" class="form-control w-50" value="{$objMovieModel->strEndDate}"></p> 
                                    </div>
                                    <div class="row">
                                        <h4>Durée du film (en minutes)</h4>
                                        <div class="col-5">
                                            <p><label>Min</label></p> 
                                            <p><input type="number" name="minduration" class="form-control w-30" value="{$objMovieModel->intStartTime}" min="0"></p> 
                                        </div>
                                        <div class="col-5">
                                        <p><label>Max</label></p> 
                                        <p><input type="number" name="maxduration" class="form-control w-30" value="{$objMovieModel->intEndTime}" max="500"></p> 
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <input type="submit" class="btn btn-primary btn-sm" value="filtrer mes recherches"> <input type="reset" class="btn btn-primary btn-sm mx-2" value="Réinitialiser">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    

    <div class="container">
    {if count($arrAdvMovie) > 0}
            <div class="row">
                    {foreach $arrAdvMovie as $objMovie}
                        {include file="views/_partial/movie_card.tpl"}
                    {/foreach}
            </div>
        {/if} 
    </div>
    {/block}

