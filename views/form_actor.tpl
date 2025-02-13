	{**
	* Classe de formulaire pour ajoute nouve actor
	* @author Arlind Halimi
	*}
	
<div class="container">
    <form  method="post" id="movie_form" enctype="multipart/form-data">
		{if count($arrErrors) > 0}
			<div class="alert alert-danger">
				{foreach $arrErrors as $strError}
					<p>{$strError}</p>
				{/foreach}
			</div>
		{/if}
        <label> Nom de d'actor : *</label>
        <input  class="form-control { (isset($arrErrors['first_name']))?'is-invalid':''}" type="text" id="first_name" name="first_name">
        <label> Prénom d'actor : *</label>
        <input  class="form-control <?php echo (isset($arrErrors['last_name']))?'is-invalid':'';  ?>" type="text" name="last_name" id="last_name">
        <label>Actor Image * : <small class="secondPlan"> (5Mo max)</small></label>
        <input class="form-control <?php echo (isset($arrErrors['fichier']))?'is-invalid':'';  ?>" value="<?php //echo($strPhoto) ?>" name="fichier" type="file">
        <div class="col-5">
	    	<input class="col-3 form-control  my-3  btn btn-primary" type="submit"  value="Soumettre cet acteur">	
		</div>
    </form>
	<div class="col-3">
		<a href='future_index.php?ctrl=movie&action=form_movie' class="btn"  value="go backr">go back </a>
	</div>
</div>