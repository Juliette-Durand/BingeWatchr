<?php
    /**
     * Controleur enfant de MotherController pour la actor
     * @author Arlind Halimi
     * @date 04/02/2025 
     */

    require_once("mother_controller.php");

    class ActorCtrl extends MotherCtrl{

        public function __construct(){
            parent::__construct();
            
        }

        /**
        * Page form actor pour l'ajout d'un acteur
        * @author Arlind Halimi
        * @date 10/02/2025 
        */
        public function form_actor(){
            // Inclusion du ficher model et entity
            require_once("models/actor_model.php");
            require_once("entities/acteur_entity.php");

            $objActorModel      = new ActorModel();
            $objActorEntity     = new ActorEntity(); 

            // Variables d'affichage
            /* Ce qui sert de h1 et/ou de nom dans le titre de la page */
            $this->_arrData['strTitle'] =  "Ajouter un Acteur";
            // Variables fonctionnelles
            $this->_arrData['refPage']  =  "form_actor";

            $strName    = $_POST['first_name']??"";
            $strPrenom  = $_POST['last_name']??"";
            $strImage   = $_FILES['fichier']['name']??"";
            $strImage   = strtolower($strImage);

            // $arrErrors = array();
              // Rederige si l'utilisateur n'est pas conecte
            if( !isset($_SESSION['user']) ){
                header("Location:index.php?ctrl=user&action=login");
                exit;
            }

            if(count($_POST) > 0){    
                $objActorEntity->hydrate($_POST);
                $objActorEntity->setPicture($strImage);
                if($strName == ""){
                    $this->_arrErrors['first_name'] = "Le champs 'nom' est obligatoire";
                }
                if($strPrenom == ""){
                    $this->_arrErrors['last_name'] = "Le champs 'prénom' est obligatoire";
                }
                if($strImage == ""){
                    $this->_arrErrors['fichier'] = "Le champs 'image' est obligatoire";
                }
        
                // Vérification du fichier
                // check if file is exist
                $arrFichier = $_FILES['fichier']; // Récupération du tableau de l'élément 'fichier'
                if ($arrFichier['error'] == 4){
                    $this->_arrErrors['fichier'] = "Le image est obligatoire";
                }else{
                    if($arrFichier['error'] != 0){
                        $this->_arrErrors['fichier'] = "Le fichier a rencontré un problème lors de l'upload";
                    }elseif($arrFichier['type'] != 'image/jpeg'){
                        $this->_arrErrors['fichier'] = "Le fichier doit être au format jpg";
                    } elseif (($arrFichier['size'] > 1024*1024) ) {
                        $this->_arrErrors['fichier'] = "Le fichier ne doit pas dépasser 1Mo";
                    }
                    
                }

                if (!isset($this->_arrErrors['fichier'])){
                    // Fichier temporaire = source
                    $strSource = $_FILES['fichier']['tmp_name'];
                    // destination de fichier
                    
                    $strDest	= "assets\img\actor\ ".$strImage;
                    // On déplace le fichier
                    if (!move_uploaded_file($strSource, $strDest)){
                        $this->_arrErrors['fichier'] = "Le fichier ne s'est pas correctement téléchargé";
                    }
                }

                // Si aucune erreur, traitement 	
                if (count($this->_arrErrors) === 0){
                    // => Formulaire OK
                    // Appel une métgid dans le modéle, avec en paramétre l'objet
                    $boolOK = $objActorModel->addActor($objActorEntity);

                    //Informer l'utilisateur si einsertion ok/pas ok
                    if($boolOK){
                        $_SESSION['success'] 	= "L'insertion est passée avac succes.";
                        header( "Location:index.php?ctrl=movie&action=form_movie", true);
                        exit();
                    }else{
                        $this->_arrErrors[]="l'insertion s'est mal passée";
                    }
                    header( "Location:index.php?ctrl=movie&action=form_movie", true);
                }
            }
            // $this->_arrData['arrErrors'] = $arrErrors;
            $this->_arrData['strName']   = $strName ;
            $this->_arrData['strPrenom'] = $strPrenom;
            $this->_arrData['strImage']  = $strImage;

            $this->display("form_actor");
        }
    }
