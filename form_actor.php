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
    $strImage   = $_FILES['fichier']??"";


    $arrErrors = array();

    if(count($_POST)>0){
        $objActorEntity->hydrate($_POST);
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