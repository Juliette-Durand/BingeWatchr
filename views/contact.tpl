{*
	/**
	* Classe de pour envoye de mail
	* @author Arlind Halimi
	* @date 11/02/2025
	*/
*}
{extends file="views/layout.tpl"}

{block name="contenu"}
<div class="container col-6" id="contact">
	<form action="" method="post" id="movie_contact" enctype="multipart/form-data">
		{if $arrErrors|count > 0}
            <div class="alert alert-danger">
                {foreach from=$arrErrors  item=strError}
                    <p>{$strError}</p>
				{/foreach}
            </div>
		{/if} 
		<div class="my-3">
			<label class="form-label" for="name" >Nom / Prénom</label>
			<input class="form-control" type="text" name="name" id="name" placeholder="Leo Messi" value="{$strName}">
			<label class="form-label" for="mail" >Destination adresse-email</label>
			<input class="form-control" type="mail" name="mail" id="mail" value="{$strMail}" placeholder="example@email.fr">
		
		</div>
		<div class="my-3">
			<label class="form-label" for="message">Message</label>
			<textarea class="form-control" name="message" id="message">{$strName} Hey, je viens de tomber sur ce film et je pense qu'il pourrait te plaire ! 
Link: {assign var="previous_page" value=$smarty.server.HTTP_REFERER|default:''}
{$previous_page}
			</textarea>
		</div>
		<p>
			<input class="btn btn-primary" type="submit" value="Envoye mail" />
		</p>
	</form>
</div>
{/block}