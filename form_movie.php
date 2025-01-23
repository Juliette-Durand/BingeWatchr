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
	$strSynopsis	= $_POST['synopsis']??"";
	$strNotes 		= $_POST['notes']??"";

	//var_dump($objMovie);
	//var_dump($arrMovie);
	var_dump($_FILES);
	var_dump($_POST);


	// Initialisation du tableau vide
	$arrErrors = array();

	if(count($_POST) > 0){
		// Vérification du formulaire
		// if($strPhoto == ""){
		// 	$arrErrors['fichier'] = "Image est obligatoire";
		// }
		if($strTitle == ""){
			$arrErrors['txt_title'] = "Title est obligatoire";
		}
		if($strActor_ob == ""){
			$arrErrors['actor_ob'] = "Le nom de l'acteur est obligatoire";
		}
		if($strDate == ""){
			$arrErrors['date'] = "Le date est obligatoire";
		}
		if ($strSynopsis == ""){
			$arrErrors['synopsis'] = "La zone de texte synopsis est obligatoire";
		}
		if ($strNotes == ""){
			$arrErrors['notes'] = "La zone de texte notes est obligatoire";
		}
		
		
		// Vérification du fichier
		// check if file is exist
		// juju
		
		
		$arrFichier = $_FILES['fichier']; // Récupération du tableau de l'élément 'fichier'
		if ($arrFichier['error'] == 4){
			$arrErrors['fichier'] = "Le image est obligatoire";
		}else{
			if($arrFichier['error'] != 0){
				$arrErrors['fichier'] = "Le fichier a rencontré un problème lors de l'upload";
			}elseif($arrFichier['type'] != 'image/jpeg'){
				$arrErrors['fichier'] = "Le fichier doit être au format jpg";}	
			elseif ($arrFichier['size'] > 5 * 1024 * 1024) {
				$arrErrors['fichier'] = "Le fichier ne doit pas dépasser 5Mo";
			}
		}
			
			
		if (!isset($arrErrors['fichier'])){
			// Fichier temporaire = source
			$strSource = $_FILES['fichier']['tmp_name'];
			// destination de fichier
			
			$strDest	= "assets\img\movies\movie_pictures\ ".$_FILES['fichier']['name'];
			// On déplace le fichier
			if (!move_uploaded_file($strSource, $strDest)){
				$arrErrors['fichier'] = "Le fichier ne s'est pas correctement téléchargé";
			}
			// $strNomFichier = $arrFichier['name'];
			// $strNomTemporaire = $arrFichier['tmp_name'];
			// $strChemin = "uploads/".$strNomFichier;
			// move_uploaded_file($strNomTemporaire, $strChemin);
		}
		

		// Si aucune erreur, traitement 	
		if (count($arrErrors) == 0){
			// => Formulaire OK
			// => exemple Insertion en BDD
		}
	}


	include_once("head.php");
	?>


	<div class="container"  id="form_movie">
	
		<form action="" method="post" id="movie_form" enctype="multipart/form-data">
			<div class="row g-5 py-3">
				<?php if (count($arrErrors) > 0){ ?>
					<div class="alert alert-danger">
						<?php foreach($arrErrors as $strError){ ?>
							<p><?php echo $strError; ?></p>
						<?php } ?>
					</div>
				<?php } ?>
				<div class="row pt-5"> 
					<div class="col-4">
						<label>Image * : <small class="secondPlan"> (5Mo max)</small></label>
						<input class="form-control <?php echo (isset($arrErrors['fichier']))?'is-invalid':'';  ?>" value="<?php echo($strPhoto) ?>" name="fichier" type="file">
					</div>
					<div class="col-8">
						<div>
							<label for="txt_title">Titre *</label>
							<input type="text" name="txt_title" id="txt_title" value="<?php echo($strTitle); ?>"  class="form-control <?php echo (isset($arrErrors['txt_title']))?'is-invalid':''; ?>" >
						</div>
						<div>
							<label for="date">Date realise *</label>
							<input type="date" name="date" id="date" class="form-control <?php echo (isset($arrErrors['date']))?'is-invalid':''; ?>" value="<?php echo($strDate); ?>">
						</div>
					</div>
					<div class="row">
						<div class="col-6">
							<div>
								<label for="actor">Acteur 1*</label>
								<input type="text" name="actor_ob" id="actor" class="form-control <?php echo (isset($arrErrors['actor_ob']))?'is-invalid':''; ?>" value="<?php echo($strActor_ob); ?>">
							</div>
							<div>
								<label for="actor">Acteur 2</label>
								<input type="text" name="actor_2" id="actor" class="form-control" value="<?php echo($strActor_2); ?>">
							</div>
						</div>
						<div class="col-6">
							<div>
								<label for="actor">Acteur 3</label>
								<input type="text" name="actor_3" id="actor" class="form-control" value="<?php echo($strActor_3); ?>">
							</div>
							<div>
								<label for="actor">Acteur 4</label>
								<input type="text" name="actor_4" id="actor" class="form-control" value="<?php echo($strActor_4); ?>">
							</div>
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-6">
						<label>Zone de texte synopsis*:</label>
						<textarea name="synopsis" class="form-control <?php echo (isset($arrErrors['synopsis']))?'is-invalid':''; ?>" id="" value="<?php echo($strSynopsis) ?>"></textarea>
					</div>
					<div class="col-md-6">
						<label>Zone de texte Notes*:</label>
						<textarea name="notes" class="form-control <?php echo (isset($arrErrors['notes']))?'is-invalid':''; ?>" id="" value="<?php echo($strNotes) ?>"></textarea>
					</div>
				</div>
				<div class="row mt-3">
					<div class="col-3">
						<input class="form-control btn btn-primary" type="submit"  value="Soumettre ce film">
					</div>
				</div>
		</form>
	</div>

<?php 
	include_once('footer.php')
?>