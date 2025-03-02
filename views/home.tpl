    {**
    * Page d'accueil affichant 6 films à l'affiche (s'il y en a) et 6 films récemment ajoutés
    * @author Hugo Gomes
    *}
    {extends file="views/layout.tpl"}      

    {block name="contenu"}
        <div class="container mb-5">
            <h1>{$strTitle}</h1>              
        </div>
        
        <div class="container">
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
    
            {if isset($smarty.session.user)&&($smarty.session.user->getRole()=="admin" || $smarty.session.user->getRole()=="modo")}
                <div class="row">
                    <span>Modérateur et Admin peuvent ajouter des films</span>
                    <a href="index.php?ctrl=movie&action=form_movie"><button type="button" class="btn btn-primary btn-sm">Ajoutez le ici</button></a>
                </div>
            {/if}
        </div>
    {/block}