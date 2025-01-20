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

	<div class="container pt-5 m-5">
		<div class="row">
			<div class="col-3">
				
				
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
			</div>
		</div>
	</div>



<?php 
	include_once('footer.php')
?>