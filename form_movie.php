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

	// Récupérer les informations du $_POST
	// ?? Version PHP 7 (équivalent isset) => Valeur par défaut si l'indice n'existe pas dans le $_POST
	$strPhoto 		= $_POST['fichier']??"";
	$strTitle 		= $_POST['txt_title']??"";
	$strDate 		= $_POST['date']??"";
	$strActor_ob	= $_POST['actor_ob']??"";
	$strActor_2		= $_POST['actor_2']??"";
	$strActor_3		= $_POST['actor_3']??"";
	$strActor_4		= $_POST['actor_4']??"";
	$strSymepris	= $_POST['symepris']??"";
	$strNotes 		= $_POST['notes']??"";

	//var_dump($objMovie);
	//var_dump($arrMovie);
	
	// Initialisation du tableau vide
	$arrErrors = array();

	if(count($_POST)>0){
		// Vérification du formulaire
		if($strPhoto == ""){
			$arrErrors['fichier'] = "Image est obligatoire";
		}
	}


	include_once("head.php")
	?>

	<div class="container">
	
		<form action="" method="post">

			<div class="row g-5 py-3">
			

				<?php
				if(count($arrErrors) > 0){
					if (isset($arrErrors['fichier'])) { ?>
					<div class="alert alert-danger" role="alert">
						<?php echo $arrErrors['fichier']; ?>
					</div>
				<?php }} ?>
				<div class="row"> </div>
				<div class="col-3">
					<label>Image * : <small class="secondPlan"> (5Mo max)</small></label>
					<input class="form-control <?php echo (isset($arrErrors['fichier']))?'is-invalid':'';  ?>" name="fichier" type="file">
				</div>
				<div class="col-9">
					<div>
						<label for="txt_title">Titre *</label>
						<input type="text" name="txt_title" id="txt_title" class="form-control <?php echo (isset($arrErrors['txt_title']))?'is-invalid':'' ?>" >
					</div>
					<div>
						<label for="date">Date realise *</label>
						<input type="date" name="date" id="date" class="form-control">
					</div>
					<div class="row d-flex flex-row">
						<div class="col-6"><div>
							<label for="actor">Acteur 1*</label>
							<input type="text" name="actor" id="actor" class="form-control">
						</div>
						<div>
							<label for="actor">Acteur 2</label>
							<input type="text" name="actor" id="actor" class="form-control">
						</div>
						<div class="col-6">
							<div>
								<label for="actor">Acteur 3</label>
								<input type="text" name="actor" id="actor" class="form-control">
							</div>
							<div>
								<label for="actor">Acteur 4</label>
								<input type="text" name="actor" id="actor" class="form-control">
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
				<div>
					<input class="form-control btn btn-primary" type="submit"  value="Soumettre ce film">
				</div>
		</form>
	</div>

<?php 
	include_once('footer.php')
?>