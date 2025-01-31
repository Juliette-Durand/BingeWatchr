<?php
    /**
     * Controleur enfant de MotherController pour la gestion utilisateur
     * @author Juliette Durand
     * Créé le 28/01/2025 - Dernière modification le 28/01/2025 par Juliette Durand
     */

    require_once("mother_controller.php");
    
    class UserCtrl extends MotherCtrl{

        private object $_objUserModel;

        /**
         * Constructeur
         */
        public function __construct(){
            parent::__construct();
            require_once("models/user_model.php");
            require_once("entities/user_entity.php");

            $this->_objUserModel   =   new UserModel();
        }

        /**
         * Page de connexion
         */
        public function login(){
            
            // Variables d'affichage
            /* Ce qui sert de h1 et/ou de nom dans le titre de la page */
            $this->_arrData['strTitle'] =   "Se connecter";
            
            // Variables fonctionnelles
            $this->_arrData['refPage']  =   "login";


            // Récupération des données du formulaire dans le POST
            $strEmail       =   $_POST['email']??"";
            $strPassword    =   $_POST['password']??"";

            // Création d'un tableau d'erreurs
            $arrErrors  =   array();

            if(count($_POST) > 0){
                // Vérification de l'adresse email
                if ($strEmail == "") {
                    $arrErrors['email'] =   "L'adresse email est obligatoire";
                } else if (!filter_var($strEmail, FILTER_VALIDATE_EMAIL)){
                    $arrErrors['email'] =   "L'adresse email renseignée n'est pas valide";
                }

                // Vérification du mot de passe
                if ($_POST['password'] == "") {
                    $arrErrors['password'] = "Le mot de passe est obligatoire";
                }

                if(count($arrErrors) == 0){
                    // On utilise le modèle pour effectuer la requête dans la base de donnée
                    $arrUser        =   $this->_objUserModel->loginUser($strEmail, $strPassword);

                    // Si aucun utilisateur correspondant aux identifiants n'a été trouvé dans la base de donnée
                    if($arrUser === false){
                        $arrErrors['connect']   =   "Adresse email ou mot de passe incorrect(e)";
                    } else {
                        // Enregistrement de l'utilisateur en session
                        $objUser    =   new UserEntity();
                        $objUser->hydrate($arrUser);
                        $_SESSION['user']   =   $objUser;
                        header("Location:future_index.php?ctrl=user&action=my_account");
                        //var_dump($_SESSION);
                    }
                }
            }
            $this->_arrData['arrErrors']    =   $arrErrors;
            $this->_arrData['strEmail']    =   $strEmail;

            
            $this->display('login');
        }

        /**
         * Déconnexion de l'utilisateur
         */
        public function logout(){
            // Destruction de la session
            session_destroy();
            // Redirection
            header("Location:future_index.php?ctrl=user&action=login");
        }

        /**
         * Page d'affichage et mise à jour des infos utilisateur
         */
        public function my_account(){
            // Variables d'affichage
            // Ce qui sert de h1 et/ou de nom dans le titre de la page
            $this->_arrData['strTitle'] =   "Mon compte";
            // Variables fonctionnelles
            $this->_arrData['refPage']  =   "my_account";
            
            // Récupération des données en sessions de user
            $arrUser	= $this->_objUserModel->findUser($_SESSION['user']->getId());

            $objUser = new UserEntity();
            $objUser->hydrate($arrUser);

			// Si des données sont envoyées -> les données ont potentiellement été modifiées
			// Je réhydrate avec les nouvelles données
			if(count($_POST)>0){

                $boolFlag   =   false;
                // Modification de l'avatar
                if($_FILES['avatar']['error']!=4){
                    $boolFlag   =   true;
                    // Vérifie les caractéristiques du fichier importé
                    if(($_FILES['avatar']['size']<1000000)&&($_FILES['avatar']['type']=='image/jpeg')){
                        // Récupération de la source
                        $strSource      =   $_FILES['avatar']['tmp_name'];
                        // Définition de la destination
                        $strDestination = 'assets/img/users/profile_pictures/'.$_FILES['avatar']['name'];
                        // Déplacement du fichier dans le dossier prévu à cet effet
                        move_uploaded_file($strSource, $strDestination);

                    // Génération de l'erreur si l'image ne respecte pas les caractéristiques
                    } else if ($_FILES['avatar']['type']!='image/jpeg'){
                            $arrErrors['avatar']    =   "L'image importée doit être au format JPG";
                            $this->_arrData['arrErrors']	=  $arrErrors;
                    } else if ($_FILES['avatar']['size']>1000000){
                        $arrErrors['avatar']    =   "L'image importée doit être inférieure à 1Mo";
                        $this->_arrData['arrErrors']	=  $arrErrors;
                    }
                }
                // Insérer condition pour :
                // Si il y a quelque chose dans le mot de passe,
                // Je vérifie qu'il n'y a pas d'erreur
                // Et que tous les champs sont remplis

                if(!isset($arrErrors)){
                    $objUser->hydrate($_POST);
                    $objUser->setId($_SESSION['user']->getId());
                    if ($boolFlag){
                        $objUser->setAvatar($_FILES['avatar']['name']);
                    }
                }
				//var_dump($objUser);

                // Exécution de la méthode de mise à jour des données
                // Récupération du résultat de la requête PDO
				$boolChange	= $this->_objUserModel->changeInfos($objUser);
                $this->_arrData['boolChange']	=	$boolChange;
			}
			
            $this->_arrData['objUser']		=  $objUser;

            // Appel de la méthode display (MotherCtrl)
            $this->display('my_account');
        }

        /**
         * Page d'affichage de la liste des utilisateurs et de modification de leur rôle
         * Accessible uniquement aux Administrateurs
         */
        public function user_role_manage(){
            // Variables d'affichage
            // Ce qui sert de h1 et/ou de nom dans le titre de la page
            $this->_arrData['strTitle'] =   "Gérer les rôles des utilisateurs";
            // Variables fonctionnelles
            $this->_arrData['refPage']  =   "user_role_manage";
            
            // Utilisation
            $arrUser	= $this->_objUserModel->findAll();
            $this->_arrData['arrUser']  =   $arrUser;
            
            // Appel de la méthode display (MotherCtrl)
            $this->display('user_role_manage');
        }
    }