{**
 * Creator @Arlind Halimi
 * doit fait cette page
*}

{extends file="views/layout.tpl"}

{block name="contenu"}
    <div class="container pt-5">
        <div class="row">
            <div class="col-md-4 card">
                
                <img src="assets/img/movies/movie_posters/{$objMovie->getPoster()}" alt="photo de film">
                                                        
            </div>
            <div class="col-md-8">
            
                <h2>{$objMovie->getName()}</h2>
                    <p>{$objMovie->getDesc()}</p>
                    <p>{$objMovie->getDateFr()}</p>
                    <p>{$objMovie->getCreation_date()}</p>
                    {if $objMovie->getPegi() != null}
                        <p>{$objMovie->getPegi()}</p>
                    {/if}
                    <p>{$objMovie->getDuration()}</p>
                    
                {if isset($_SESSION['user'])}
                    <form class="col-10 form-control" method="post" id="movie_form" enctype="multipart/form-data">
                        {if count($arrErrors) > 0}
                            <div class="alert alert-danger">
                                {foreach $arrErrors as $strError}
                                    <p>{$strError}</p>
                                {/foreach}
                            </div>
                        {/if}
                        <label class="col-12" for="title">Title comment</label>
                        <input class="col-12 form-control my-3 {if $arrErrors['title']|isset} is-invalid {/if}" type="text" name="title" id="title" value="{$strTitleCom}">
                        <textarea class="col-12 form-control {if $arrErrors['content']|isset} is-invalid {/if}" name="content" id="content" value="">{$strContentCom}</textarea>
                        <input class="col-12 btn brn-primary my-3" type="submit" name="addComent" id="addComment" value="add comment">
                    </form>
                {/if}
            </div>
                    {if count($arrComments)>0}
                        <h3 class='mt-5'>Dernier trois commentes : </h3>
                    {/if}
                    {foreach $arrComments as $objCommentEntity}            
                        {include file="views/_partial/comment.tpl"}
                    {/foreach}           
        </div>
       
        <a class="btn btn-secondary mt-3" href="index.php?controller=movie&action=contact"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-share" viewBox="0 0 16 16">
            <path d="M13.5 1a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3M11 2.5a2.5 2.5 0 1 1 .603 1.628l-6.718 3.12a2.5 2.5 0 0 1 0 1.504l6.718 3.12a2.5 2.5 0 1 1-.488.876l-6.718-3.12a2.5 2.5 0 1 1 0-3.256l6.718-3.12A2.5 2.5 0 0 1 11 2.5m-8.5 4a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3m11 5.5a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3"/>
        </svg> Partage par email</a>
    </div>
{/block}