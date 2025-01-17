
<!DOCTYPE html>
<html lang="fr">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Christel Ehrhart">
	<meta charset=UTF-8>
    <title>Lien HTML - PHP</title>

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <!-- Favicons -->
	<link rel="icon" href="assets/images/logo.jpg">
	<meta name="theme-color" content="#712cf9">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
	<!-- Custom styles for this template -->
    <link href="assets/css/custom.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/blog.css" rel="stylesheet">
	
	<script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script> 

	<!-- Place the first <script> tag in your HTML's <head> -->
	<script src="https://cdn.tiny.cloud/1/n15c921ybu703te35sevgl27akdj95fi6fhhcg7ya35h3op9/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
  </head>
  <body>
  <?php
	//var_dump($_GET);
	var_dump($_POST);
	//var_dump($_FILES);
	
	// Version if
	/*if (isset($_POST['simple'])){
		$strSimple = $_POST['simple'];
	}else{
		$strSimple = "";
	}*/
	
	// Version ecriture ternaire
	//$strSimple = (isset($_POST['simple']))?$_POST['simple']:"";
	
	// Récupérer les informations du $_POST
	// ?? Version PHP 7 (équivalent isset) => Valeur par défaut si l'indice n'existe pas dans le $_POST
	$strSimple 		= $_POST['simple']??"";
	$strActeur 		= $_POST['acteur']??"";
	var_dump($strActeur);
	$strDate 		= $_POST['date']??"";
	$strLignes		= $_POST['lignes']??"";
	$strNotes		= $_POST['notes']??"";
	$intNumber		= $_POST['number']??"";
	$intSelect		= $_POST['choix_select']??"";
	$intUnique		= $_POST['choix_unique']??3;
	$arrMultiple	= $_POST['choix_multiple']??[]; // [] pour définir un tableau vide par défaut
	
	// Enlever les espaces / mise en majuscule / en minuscule
	$strSimple 		= strtolower(trim($strSimple));
	$strLignes 		= trim($strLignes);
	
	// Initialisation du tableau vide
	$arrErrors	= array();
	// Le formulaire est envoyé
	if (count($_POST) > 0){

		// Vérifier le contenu de $strSimple
		if ($strSimple == ""){
			$arrErrors['simple'] = "La zone de texte simple est obligatoire";
		}
		if($strActeur == ""){
			$arrErrors['acteur'] = "Le nom de l'acteur est obligatoire";
		}
		if($strDate == ""){
			$arrErrors['date'] = "Le date est obligatoire";
		}


		
		// Vérifier le contenu de $strLignes
		if ($strLignes == ""){
			$arrErrors['lignes'] = "La zone de texte sur plusieurs lignes est obligatoire";
		}
		// Vérifier le contenu de $strLignes
		if ($strLignes == ""){
			$arrErrors['notes'] = "La zone de texte sur plusieurs lignes est obligatoire";
		}
		// Vérifier le contenu de $intNumber
		if ($intNumber == ""){
			$arrErrors['nombre'] = "La zone de nombre est obligatoire";
		}
		// Vérifier le contenu de $intSelect
		if ($intSelect == ""){
			$arrErrors['select'] = "Le select est obligatoire";
		}
		// Vérifier si choix_unique est présent dans $_POST
		if (!isset($_POST['choix_unique'])){
			$arrErrors['unique'] = "Le choix unique est obligatoire";
		}
		// Vérifier si choix_multiple est présent dans $_POST
		/*if (!isset($_POST['choix_multiple'])){
			$arrErrors[] = "Le choix multiple est obligatoire";
		}*/
		if (count($arrMultiple) == 0){
			$arrErrors['multiple'] = "Le choix multiple est obligatoire";
		}elseif (count($arrMultiple) < 2){ // si besoin
			$arrErrors['multiple'] = "Vous devez choisir 2 cases";
		}	

		// Vérifier le fichier uploadé (error = 0 + type de fichier  + copie qui a fonctionné)
		$arrFichier	= $_FILES['fichier']; // on utilise une variable pour éviter de rappeler le name de l'input
		if ($arrFichier['error'] == 4){
			$arrErrors['fichier'] = "Le fichier est obligatoire";
		}else{
			if ($arrFichier['error'] != 0){
				$arrErrors['fichier'] = "Le fichier a rencontré un pb";
			}elseif ($arrFichier['type'] != 'image/jpeg'){
				$arrErrors['fichier'] = "Uniquement les JPG ou JPEG sont acceptés";
			}elseif ($arrFichier['size'] > 5000000){
				$arrErrors['fichier'] = "Le fichier ne doit pas dépasser 5Mo";
			}
		}
		var_dump($_FILES);
		//if (count($arrErrors) == 0){
		if (!isset($arrErrors['fichier'])){
			// fichier temporaire = source
			$strSource	= $_FILES['fichier']['tmp_name'];
			// destination du fichier
			$strDest	= "assets/img/uploads/".$_FILES['fichier']['name'];
			// On déplace le fichier
			if (!move_uploaded_file($strSource, $strDest)){
				$arrErrors['fichier'] = "Le fichier ne s'est pas correctement téléchargé";
			}
		}
		
		if (count($arrErrors) == 0){
			// => Formulaire OK
			// => exemple Insertion en BDD
		}
		
	}
	
?>
		<main class="container">
			<header class="blog-header lh-1 py-3">
				<div class="row flex-nowrap justify-content-between align-items-center">
				  <div class="col-1 pt-1">
					<a class="" href="index.php" title="logo">
						<img class="img-fluid" src="assets/images/logo.jpg" alt="logo"/>
					</a>
				  </div>
				  <div class="col-11 text-center">
						<p class="blog-header-logo text-dark" href="#">Faire le lien entre les formulaires HTML et PHP</p>
				  </div>
				</div>
			</header>

			<!-- Content -->
			<div class="row g-5 py-3">
				<div class="col-md-12">
					<h2>Ajoute un film</h2>
					<div class="alert alert-info">
						<p>Les éléments obligatoire sont suivis d'un *</p>
						<p> Les fichiers autorisés sont en PDF</p>
					</div>
					<?php if (count($arrErrors) > 0){ ?>
					<div class="alert alert-danger">
						<?php foreach($arrErrors as $strError){ ?>
							<p><?php echo $strError; ?></p>
						<?php } ?>
					</div>
					<?php } ?>
					<div class="py-4">
						<form method="post" action="" enctype="multipart/form-data">
							<input type="hidden" name="page" value="form" />
							
							<p>
								<label for="txt_simple" >Titre* :</label>
								<input id="txt_simple" name="simple" class="form-control <?php if (isset($arrErrors['simple'])){ echo 'is-invalid'; } ?>" type="text" value="<?php echo($strSimple); ?>" >
								<?php /*if (isset($arrErrors['simple'])){ ?>
								<div class="invalid-feedback d-block">
									<?php echo($arrErrors['simple']); ?>
								</div>
								<?php }*/ ?>
								
							</p>
							<p>
								<label>Date *:</label>
								<input type="date" name="date" class="form-control">
							</p>
							<div class="row">
								<div class="col-10">
									<p>
										<label for="txt_simple" >Acteur* :</label>
										<input id="txt_simple" name="acteur" class="form-control <?php if (isset($arrErrors['acteur'])){ echo 'is-invalid'; } ?>" type="text" value="<?php echo($strActeur); ?>" >
									</p>
								</div>
								<div class="col-2">
									<button>ADD new actor</button>
								</div>
							</div>
							<div class="row">
								<div class="col-6"><p>
								<label>Zone de texte Symepris*:</label>
								<textarea name="lignes" class="form-control <?php echo (isset($arrErrors['lignes']))?'is-invalid':'';  ?>"><?php echo($strLignes); ?></textarea>
							</p></div>
								<div class="col-6">
								<p>
								<label>Zone de texte Notes*:</label>
								<textarea name="notes" class="form-control <?php echo (isset($arrErrors['notes']))?'is-invalid':'';  ?>"><?php echo($strNotes); ?></textarea>
							</p>
								</div>
							</div>
							
							
							
							<p>
								<label>Zone de nombre*:</label>
								<input name="number" class="form-control <?php echo (isset($arrErrors['nombre']))?'is-invalid':'';  ?>" type="number" value="<?php echo($intNumber); ?>" >
							</p>
							<p>
								<label>Select*:</label>
								<select name="choix_select" class="form-control <?php echo (isset($arrErrors['select']))?'is-invalid':'';  ?>">
									<?php
										
										foreach($arrActors as $arrActor){?>
											<option <?php if($intSelect == $objActeur->getId()) { echo "selected"; } ?> value="4">Tortue</option>
										<?php } 
									?>
				
								
									<option value="">--</option>
									<option <?php if($intSelect == 4) { echo "selected"; } ?> value="4">Tortue</option>
									<option <?php if($intSelect == 1) { echo "selected"; } ?> value="1">Chat</option>
									<option <?php if($intSelect == 2) { echo "selected"; } ?> value="2">Chien</option>
									<option <?php if($intSelect == 3) { echo "selected"; } ?> value="3">Elephant</option>
									<option <?php if($intSelect == 5) { echo "selected"; } ?> value="5">Requin</option>
								</select>
							</p>
							<p>
								<label>Choix unique*:</label>
								<input name="choix_unique" <?php if($intUnique == 1) { echo "checked"; } ?> value="1" type="radio" class="form-check-input"> Chat
								<input name="choix_unique" <?php if($intUnique == 2) { echo "checked"; } ?> value="2"  type="radio" class="form-check-input"> Chien
								<input name="choix_unique" <?php if($intUnique == 3) { echo "checked"; } ?> value="3" type="radio" class="form-check-input"> Elephant
							</p>
							<p>
								<label>Choix multiple*:</label>
								<input type="checkbox" name="choix_multiple[]" <?php if(in_array(1, $arrMultiple)){ echo "checked"; } ?> value="1" class="form-check-input <?php echo (isset($arrErrors['multiple']))?'is-invalid':'';  ?>"> Choix 1
								<input type="checkbox" name="choix_multiple[]" <?php if(in_array(2, $arrMultiple)){ echo "checked"; } ?> value="2" class="form-check-input <?php echo (isset($arrErrors['multiple']))?'is-invalid':'';  ?>"> Choix 2
								<input type="checkbox" name="choix_multiple[]" <?php if(in_array(3, $arrMultiple)){ echo "checked"; } ?> value="3" class="form-check-input <?php echo (isset($arrErrors['multiple']))?'is-invalid':'';  ?>"> Choix 3
							</p>
							<p>
								<label>Fichier*:</label>
								<input class="form-control  <?php echo (isset($arrErrors['fichier']))?'is-invalid':'';  ?>" name="fichier" type="file">
							</p>
							<p>
								<input class="form-control btn btn-primary" type="submit" >
							</p>
						</form>
					</div>

				</div>
			</div>

		</main>
		<footer class="blog-footer">
		  <p>Site créé par <a target="_blank" href="https://ce-formation.com/">CE FORMATION</a></p>
		</footer>
		
		<!-- Place the following <script> and <textarea> tags your HTML's <body> -->
		<script>
		//   tinymce.init({
		// 	selector: 'textarea',
		// 	plugins: 'anchor autolink charmap codesample link lists table visualblocks wordcount',
		// 	toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link  | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
		//   });
		</script>

	</body>
</html>
