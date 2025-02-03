<?php
    /**
	* Classe de formulaire pour ajoute nouve actor
	* @author Arlind Halimi
	*/
	// Variable fonctionalles 
	$refPage="formuler_actor";
	
	// Variables d'affichage
	$strTitle="Ajoute nouveau actor";

    // Inclusion du ficher model et entity
    require_once("models/actor_model.php");
    require_once("entities/acteur_entity.php");

    $objActorEntity = new ActorEntity();
	$objActorModel 	= new ActorModel();
    

    $strName    = $_POST['first_name']??"";
    $strPrenom  = $_POST['last_name']??"";
    $strImage   = $_FILES['fichier']['name']??"";
    $strImage   = strtolower($strImage);


    $arrErrors = array();

    if(count($_POST) > 0){
        $objActorEntity->hydrate($_POST);
        $objActorEntity->setPicture($strImage);
        if($strName == ""){
            $arrErrors['first_name'] = "Le champs 'nom' est obligatoire";
        }
        if($strPrenom == ""){
            $arrErrors['last_name'] = "Le champs 'pénom' est obligatoire";
        }
        if($strImage == ""){
            $arrErrors['fichier'] = "Le champs 'image' est obligatoire";
        }
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
			
			$strDest	= "assets\img\actor\ ".$strImage;
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
			var_dump($objActorEntity);
			$boolOK = $objActorModel->addActor($objActorEntity);

			//Informer l'utilisateur si einsertion ok/pas ok
			if($boolOK){
				var_dump('ok');
			}else{
				$arrErrors[]="l'insertion s'est mal passée";
			}
			
			// => exemple Insertion en BDD
		}

    var_dump($_POST);
    var_dump($_FILES);
    include_once("head.php");
?>
<div class="container">
    <form  method="post" id="movie_form" enctype="multipart/form-data">
        <label> Nom de d'actor : *</label>
        <input  class="form-control <?php echo (isset($arrErrors['first_name']))?'is-invalid':'';  ?>" type="text" id="first_name" name="first_name">
        <label> Prénom d'actor : *</label>
        <input  class="form-control <?php echo (isset($arrErrors['last_name']))?'is-invalid':'';  ?>" type="text" name="last_name" id="last_name">
        <label>Actor Image * : <small class="secondPlan"> (5Mo max)</small></label>
        <input class="form-control <?php echo (isset($arrErrors['fichier']))?'is-invalid':'';  ?>" value="<?php //echo($strPhoto) ?>" name="fichier" type="file">
        
        <input class="form-control btn btn-primary" type="submit"  value="Soumettre cet acteur">	
    </form>
</div>