<?php
    /**
     * Controleur enfant de MotherController pour la actor
     * @author Arlind Halimi
     * Créé le 04/02/2025 
     */

    require_once("mother_controller.php");

    class ActorCtrl extends MotherCtrl{

        public function __construct(){
            parent::__construct();
            
        }

        public function form_actor(){
            // Inclusion du ficher model et entity
            require_once("models/actor_model.php");
            require_once("entities/acteur_entity.php");

            $objActorModel   =   new ActorModel();

            // Variables d'affichage
            /* Ce qui sert de h1 et/ou de nom dans le titre de la page */
            $this->_arrData['strTitle'] =  "Ajouter un Acteur";

            // Variables fonctionnelles
            $this->_arrData['refPage']  =  "form_actor";

            

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
                }


                // Si aucune erreur, traitement 	
                if (count($arrErrors) === 0){

                    // => Formulaire OK
                    // Appel une métgid dans le modéle, avec en paramétre l'objet
                    var_dump($objActorEntity);
                    $boolOK = $objActorModel->addActor($objActorEntity);

                    //Informer l'utilisateur si einsertion ok/pas ok
                    if($boolOK){
                        //var_dump('ok');
                    }else{
                        $arrErrors[]="l'insertion s'est mal passée";
                    }
                    header( "Location:future_index.php?ctrl=movie&action=form_movie", true);
                    // => exemple Insertion en BDD
                }
            }
            $this->_arrData['arrErrors']  =   $arrErrors;
            $this->display("form_actor");
        }
        
    }
