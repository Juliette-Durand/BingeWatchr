{**
* Classe de formulaire pour ajoute nouve actor
* @author Arlind Halimi
*}
{extends file="views/layout.tpl"}

{block name="contenu"}
	<div class="container">
		<form  method="post" id="movie_form" enctype="multipart/form-data">
		
			<label> Nom de d'actor : *</label>
			<input  class="form-control {if $arrErrors['first_name']|isset} is-invalid {/if}" type="text" id="first_name" name="first_name" value="{$strName}">
			<label> Prénom d'actor : *</label>
			<input  class="form-control {if $arrErrors['last_name']|isset} is-invalid {/if}" type="text" name="last_name" id="last_name" value="{$strPrenom}">
			<label>Actor Image * : <small class="secondPlan"> (5Mo max)</small></label>
			<input class="form-control {if $arrErrors['fichier']|isset} is-invalid {/if}" value="{$strPhoto}" name="fichier" type="file">
			<div class="col-5">
				<input class="col-3 form-control  my-3  btn btn-primary" type="submit"  value="Soumettre cet acteur">	
			</div>
		</form>
		<div class="col-3">
			<a href='index.php?ctrl=movie&action=form_movie' class="btn"  value="go backr">go back </a>
		</div>
	</div>
{/block}