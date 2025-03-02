{**
* Page de gestion des commentaires des utilisateurs
* @author Juliette Durand
*}
{extends file="views/layout.tpl"}

{block name="contenu"}
    <div class="container mb-5">
        <h1>{$strTitle}</h1>
    </div>
    
    <section class="container" id="comment_manage">
        <div class="row">
            <div class="accordion" id="accordionListUsers">

                {foreach $arrComment as $objComment}
                    {include file="views/_partial/comment_item.tpl"}
                {{/foreach}}
                
            </div>
        </div>
    </section>
{/block}