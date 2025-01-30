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
	require_once("models/actor_model.php");
	require_once("entities/acteur_entity.php");
	
	
	// Instanciation
	$objMovie		= new MovieModel();
	$objMovieEntity	= new MovieEntity();
	$objActorEntity = new ActorEntity();
	$objActorModel 	= new ActorModel();
	
	// Merr të gjithë aktorët
	$arrActor = $objActorModel->findAllActors();

	// Movie
	//$arrMovie 	= $objMovie->findMovie();
	
	//foreach ($arrMovie as $arrDetMovie){
		//$objMovie = new MovieEntity();
		//$objMovie->hydrate($arrDetMovie);
	//}

	// Récupérer les informations du $_POST
	// ?? Version PHP 7 (équivalent isset) => Valeur par défaut si l'indice n'existe pas dans le $_POST
	$strPhoto 		= $_FILES['fichier']["name"]??"";
	$strPhoto		= strtolower($strPhoto);
	$strTitle 		= $_POST['name']??"";
	$strDate 		= $_POST['release']??"";
	// $strActor_ob	= $_POST['actor_ob']??"";
	// $strActor_2		= $_POST['actor_2']??"";
	// $strActor_3		= $_POST['actor_3']??"";
	// $strActor_4		= $_POST['actor_4']??"";
	$strSynopsis	= $_POST['desc']??"";
	$strNotes 		= $_POST['notes']??"";
	$strDuration	= $_POST['duration']??"";
	$strMovieDisplay = $_POST['display']??"";

	

	//var_dump($objMovie);
	//var_dump($arrMovie);
	//var_dump($_FILES);
	//var_dump($_POST);
	


	// Initialisation du tableau vide
	$arrErrors = array();

	if(count($_POST) > 0){
		$objMovieEntity->hydrate($_POST);
		$objMovieEntity->setPoster($strPhoto);
		// Vérification du formulaire
		// if($strPhoto == ""){
		// 	$arrErrors['fichier'] = "Image est obligatoire";
		// }
		if($strTitle == ""){
			$arrErrors['name'] = "Title est obligatoire";
		}
		//if($strActor_ob == ""){
		//	$arrErrors['actor_ob'] = "Le nom de l'acteur est obligatoire";
		//}
		if($strDate == ""){
			$arrErrors['release'] = "Le date est obligatoire";
		}
		if ($strSynopsis == ""){
			$arrErrors['desc'] = "La zone de texte synopsis est obligatoire";
		}
		if ($strNotes == ""){
			$arrErrors['notes'] = "La zone de texte notes est obligatoire";
		}
		
		
		// Vérification du fichier
		// check if file is exist
		
		
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
			
			$strDest	= "assets\img\movies\movie_posters\ ".$strPhoto;
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
		if (count($arrErrors) === 0){
			// => Formulaire OK
			// Appel une métgid dans le modéle, avec en paramétre l'objet
			var_dump($objMovieEntity);
			$boolOK = $objMovie->addMovie($objMovieEntity);

			//Informer l'utilisateur si einsertion ok/pas ok
			if($boolOK){
				var_dump('ok');
			}else{
				$arrErrors[]="l'insertion s'est mal passée";
			}
			
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
							<label for="name">Titre *</label>
							<input type="text" name="name" id="name" value="<?php echo($strTitle); ?>"  class="form-control <?php echo (isset($arrErrors['name']))?'is-invalid':''; ?>" >
						</div>
						<div>
							<label for="release">Date realise *</label>
							<input type="date" name="release" id="release" class="form-control <?php echo (isset($arrErrors['release']))?'is-invalid':''; ?>" value="<?php echo($strDate); ?>">
						</div>
						<div>
							<label for="display">Date mise a l'affiche</label>
							<input type="date" name="display" id="display" class="form-control <?php echo (isset($arrErrors['date']))?'is-invalid':''; ?>" value="<?php echo($strMovieDisplay); ?>">
						</div>
						<div>
							<label for="duration">Duration</label>
							<input type="time" name="duration" id="duration" class="form-control <?php echo (isset($arrErrors['duration']))?'is-invalid':''; ?>" value="<?php echo($strDuration); ?>">
						</div>
					</div>
					<div class="row">
						<div class="col-6">
							<div>
								<label for="actor">Actor</label>
								<select id="actor" name="actor"  class="form-control">
									<option value="0" <?php echo(($objActorModel->intActor == 0)?"selected":"");?> >--</option>
									
									<?php foreach ($arrActor as $arrDetActor) { 
										$objActorEntity->hydrate($arrDetActor);
										var_dump($objActorEntity);
									?> 
									
									<option value="<?php echo($objActorEntity->getId()); //=> Utiliser le getter ?>" 
											<?php echo(($objActorModel->intActor == $objActorEntity->getId())?"selected":"");?> >
										<?php echo($objActorEntity->getFirst_name()." ". $objActorEntity->getLast_name()); ?> 
									</option>
									<?php }	?>

								</select>
								
								
							</div>
						
						</div>
						<div class="col-6">
							<label for="new actor">Ajoute un actor</label> 
							<a href='#' class="form-control btn btn-primary"  value="Ajoute un actor">Ajoute un actor </a>
						</div>
						
					</div> 
				</div>
				
				<div class="row">
					<div class="col-md-6">
						<label>Zone de texte synopsis*:</label>
						<textarea name="desc" class="form-control <?php echo (isset($arrErrors['desc']))?'is-invalid':''; ?>" id="" value="<?php echo($strSynopsis) ?>"></textarea>
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