<?php
    /**
     * Controleur enfant de MotherController pour la gestion utilisateur
     * @author Juliette Durand
     * Créé le 28/01/2025 - Dernière modification le 28/01/2025 par Juliette Durand
     */

    require_once("mother_controller.php");
    
    class UserCtrl extends MotherCtrl{

        private object $_objUserModel; /**< Object User utilisé dans tous les controllers, instancié en UserModel et qui sert à l'exécution des requêtes */

        /**
         * Constructeur de la classe
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
            // Suppression de l'erreur concernant la suppression du compte si elle existe
            if(isset($_SESSION['account_deletion'])){
                unset($_SESSION['account_deletion']);
                unset($_SESSION['boolAccountDeletion']);
            }
            
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
            //var_dump($_SESSION);
            // Variables d'affichage
            // Ce qui sert de h1 et/ou de nom dans le titre de la page
            $this->_arrData['strTitle'] =   "Mon compte";
            // Variables fonctionnelles
            $this->_arrData['refPage']  =   "my_account";
            
            // Récupération des données en sessions de user
            $arrUser	= $this->_objUserModel->findUser($_SESSION['user']->getId());

            $objUser = new UserEntity();
            $objUser->hydrate($arrUser);

            $arrErrors    = array();
			// Si des données sont envoyées -> les données ont potentiellement été modifiées
			// Je réhydrate avec les nouvelles données
			if(count($_POST)>0){
                $boolAvatar   =   false;
                // Modification de l'avatar
                if($_FILES['avatar']['error']!=4){
                    $boolAvatar   =   true;
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

                //var_dump($_POST);
                $strOldPwd  =   $_POST['old_pwd']??"";
                $strNewPwd  =   $_POST['new_pwd']??"";
                $strConfPwd  =   $_POST['confirm_pwd']??"";

                $boolPwd = false;
                if ($strOldPwd != ""){
                    if ($strOldPwd != $objUser->getPassword()){
                        // Vérifie que le mot de passe renseigné correspond à celui en bdd
                        $arrErrors['old_pwd']  =   "Le mot de passe renseigné ne correspond pas au mot de passe actuel";
                    } else {
                        $boolPwd = true;
                        if ($objUser->getPassword() != ""){
                            // Vérifie que le mot de passe contient au moins 8 caractères
                            if (strlen($strNewPwd)<8){
                                $arrErrors['new_pwd'][]= "au minimum 8 caractères";
                            }
                            // Vérifie que le mot de passe contient un chiffre
                            if (!preg_match("#[0-9]#", $strNewPwd)){
                                $arrErrors['new_pwd'][]= "au moins un chiffre";
                            }
                            // Vérifie que le mot de passe contient une lettre majuscule
                            if (!preg_match("#[A-Z]#", $strNewPwd)){
                                $arrErrors['new_pwd'][]= "au moins une lettre majuscule";
                            }
                            // Vérifie que le mot de passe contient une lettre minuscule
                            if (!preg_match("#[a-z]#", $strNewPwd)){
                                $arrErrors['new_pwd'][]= "au moins une lettre minuscule";
                            }
                            // Vérifie que le mot de passe contient un caractère spécial
                            if (!preg_match("#\W#", $strNewPwd)){
                                $arrErrors['new_pwd'][]= "au moins un caractère spécial";
                            }
                            
                            if (!isset($arrErrors['conf_pwd'])){
                                // Si tout est ok pour le mot de passe, on s'occupe la confirmation
                                if ($strConfPwd == ""){
                                    // Vérifie que le champ confirmation de mot de passe est renseigné
                                    $arrErrors['conf_pwd']	= "Le champ de la confirmation de mot de passe doit être renseigné";
                                
                                } else if ($strNewPwd != $strConfPwd) {
                                    // Vérifie que les mots de passe correspondent
                                    $arrErrors['conf_pwd']	= "La confirmation de mot de passe ne correspond pas à celui renseigné";
                                }
                            }
                            
                        }
                    }
                }

                if(count($arrErrors) == 0){
                    $objUser->hydrate($_POST);
                    $objUser->setId($_SESSION['user']->getId());
                    if ($boolAvatar){
                        $objUser->setAvatar($_FILES['avatar']['name']);
                    }
                    if ($boolPwd){
                        $objUser->setPassword($_POST['new_pwd']);
                    }
                    $boolChange = false;
                    // Exécution de la méthode de mise à jour des données
                    // Récupération du résultat de la requête PDO
                    $boolChange	= $this->_objUserModel->changeInfos($objUser, $boolPwd);
                    $this->_arrData['boolChange']	=	$boolChange;
                    // Affectation des modifications dans la session
                    $_SESSION['user']   =   $objUser;
                }
 
			}
			
            $this->_arrData['arrErrors']	=  $arrErrors;
            $this->_arrData['objUser']		=  $objUser;

            // Appel de la méthode display (MotherCtrl)
            $this->display('my_account');

            // Suppression de l'erreur concernant la suppression du compte si elle existe
            if(isset($_SESSION['account_deletion'])){
                unset($_SESSION['account_deletion']);
            }
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

        /**
         * Suppression du compte utilisateur
         */
        public function delete_account(){
            // Variables d'affichage
            // Ce qui sert de h1 et/ou de nom dans le titre de la page
            $this->_arrData['strTitle'] =   "Supprimer mon compte";
            // Variables fonctionnelles
            $this->_arrData['refPage']  =   "delete_account";

            $_SESSION['boolAccountDeletion'] = true;

            // Appel de la méthode display (MotherCtrl)
            $this->display('delete_account');
        }

        /**
         * Confirmation de suppression du compte utilisateur
         */
        public function confirm_delete_account(){

            // Récupération du l'url de la page de référence
            $strServReferer    =   $_SERVER['HTTP_REFERER']??"";

            // Vérifie que l'utilisateur est bien passé par la page de confirmation de suppression de compte (booleen + url de référence)
            if((isset($_SESSION['boolAccountDeletion'])) && (str_contains($strServReferer, 'action=delete_account'))){
                var_dump("Ok");
                // Récupération de la requête de suppression du compte via l'id en session
                $boolQuery	= $this->_objUserModel->deleteAccount($_SESSION['user']->getId());

                // Vérifie le résultat de la requête
                if($boolQuery === true){
                    // Destruction de la session utilisateur
                    unset($_SESSION['user']);
                    // Génération d'une validation en session
                    $_SESSION['account_deletion']['success']  =   "Le compte a bien été supprimé";
                    // Redirection
                    header("Location:future_index.php?ctrl=user&action=login");
                } else {
                    $_SESSION['account_deletion']['error']  =   "Erreur lors de la suppression du compte. Veuillez réessayer plus tard";
                    // Redirection
                    header("Location:future_index.php?ctrl=user&action=my_account");
                }

            } else {
                // L'utilisateur a court-circuité le chemin de suppression du compte
                // Génération d'une erreur en session
                $_SESSION['account_deletion']['error']  =   "Tentative de suppression échouée";
                // Redirection
                header("Location:future_index.php?ctrl=user&action=my_account");
            }
            
        }
    }