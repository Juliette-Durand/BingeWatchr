<?php 
	/**
	* Classe de formulaire pour ajoute nouve film
	* @author Arlind Halimi
	*/
	// Variable fonctionalles 
	$refPage="formuler_movie";
	
	// Variables d'affichage
	$strTitle="Ajoute nouveau film";
	
	// Inclusion du ficher model et entity
	require_once("entities/movie_entity.php");
	require_once("models/movie_model.php");
				
	
	// Instanciation
	$objMovie	= new MovieModel();

	// Movie
	$arrMovie 	= $objMovie->findMovie();
	
	foreach ($arrMovie as $arrDetMovie){
		$objMovie = new MovieEntity();
		//$objMovie->hydrate($arrDetMovie);
	}

	var_dump($objMovie);
	var_dump($arrMovie);
	
	include_once("head.php")
	?>

	<div class="container">
		
		<form action="">
			<div class="row">
				<div class="col-3">
					<label>Image * : <small class="secondPlan"> (5Mo max)</small></label>
					<input class="form-control  <?php echo (isset($arrErrors['fichier']))?'is-invalid':'';  ?>" name="fichier" type="file">
				</div>
				<div class="col-9">
					<div>
						<label for="txt_title">Titre *</label>
						<input type="text" name="txt_title" id="txt_title" class="form-control" >
					</div>
					<div>
						<label for="date">Date realise *</label>
						<input type="date" name="date" id="date" class="form-control">
					</div>
					<div class="row">
						<div class="col-6"><div>
							<label for="acteur">Acteur 1*</label>
							<input type="text" name="acteur" id="acteur" class="form-control">
						</div>
						<div>
							<label for="acteur">Acteur 2</label>
							<input type="text" name="acteur" id="acteur" class="form-control">
						</div>
					</div>
						<div class="col-6">
							<div>
								<label for="acteur">Acteur 3</label>
								<input type="text" name="acteur" id="acteur" class="form-control">
							</div>
							<div>
								<label for="acteur">Acteur 4</label>
								<input type="text" name="acteur" id="acteur" class="form-control">
							</div>
						</div>
					</div>
				</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<label>Zone de texte Symepris*:</label>
						<textarea name="symepris" class="form-control" id=""></textarea>
					</div>
					<div class="col-md-6">
						<label>Zone de texte Notes*:</label>
						<textarea name="notes" class="form-control" id=""></textarea>
					</div>
				</div>
		</form>
	</div>

<?php 
	include_once('footer.php')
?>