    {**
    * Page d'accueil affichant 6 films à l'affiche (s'il y en a) et 6 films récemment ajoutés
    * @author Hugo Gomes
    *}
    {extends file="views/layout.tpl"}      

    {block name="contenu"}
    <div class="container pt-5">
        <h1>{$strTitle}</h1>              

        {if count($arrMovies) > 0}
        <div class="row">
            <h2>Films à l'affiche</h2>
                {foreach from=$arrMovies item=objMovie}
                    {include file="views/_partial/movie_card.tpl"}
                {/foreach}
                <div>
                    <a href="index.php?ctrl=movie&action=allmovies&bool=1" class="btn btn-primary mt-3">Tous les films à l'affiche</a>
                </div>
        </div>
        {/if}
        
        {if count($arrRecentMovie) > 0}
        <div class="row">
            <h2>Films récemment ajoutés</h2>
                {foreach $arrRecentMovie as $objMovie}
                    {include file="views/_partial/movie_card.tpl"}
                {/foreach}
        </div>
        {/if}

        <div class="row">
            <span>Vous ne trouvez pas le film que vous cherchez ?</span>
            <a href="index.php?ctrl=movie&action=form_movie"><button type="button" class="btn btn-primary btn-sm">Ajoutez le ici</button></a>
        </div>
    </div>
    {/block}