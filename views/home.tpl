    {**
    * Page d'accueil affichant 6 films à l'affiche (s'il y en a) et 6 films récemment ajoutés
    * @author Hugo Gomes
    *}
    {extends file="views/layout.tpl"}      

    {block name="contenu"}
    <div class="container pt-5">
        <h1>{$strTitle}</h1>              

        {if count($arrMovie) > 0}
        <div class="row">
            <h2>Films à l'affiche</h2>
                {foreach $arrMovie as $objMovie}
                    {* $objMovie = new MovieEntity();
                    $objMovie->hydrate($arrDetMovie); *}
                    {include file="views/_partial/movie_card.tpl"};
                {/foreach}
        </div>
        {/if}
        
        {if count($arrRecentMovie) > 0}
        <div class="row">
            <h2>Films récemment ajoutés</h2>
                {foreach $arrRecentMovie as $arrDetMovie}
                    {* $objMovie = new MovieEntity();
                    $objMovie->hydrate($arrDetMovie); *}
                    {include file="views/_partial/movie_card.tpl"};
                {/foreach}
        </div>
        {/if}

        <div class="row">
            <span>Vous ne trouvez pas le film que vous cherchez ?</span>
            <a href="form_movie.php"><button type="button" class="btn btn-primary btn-sm">Ajoutez le ici</button></a>
        </div>
    </div>
    {/block}