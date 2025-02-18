<?php
    /**
     * Controleur enfant de MotherController pour la gestion utilisateur
     * @author Juliette Durand
     * Créé le 28/01/2025 - Dernière modification le 11/02/2025 par Juliette Durand
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
            // Redirection si l'utilisateur est déjà connecté
            if(isset($_SESSION['user'])){
                header("Location:future_index.php?ctrl=user&action=my_account");
            }
            
            // Variables d'affichage
            /* Ce qui sert de h1 et/ou de nom dans le titre de la page */
            $this->_arrData['strTitle'] =   "Se connecter";
            
            // Variables fonctionnelles
            $this->_arrData['refPage']  =   "login";


            // Récupération des données du formulaire dans le POST
            $strMail       =   $_POST['mail']??"";
            $strPassword    =   $_POST['password']??"";

            // Création d'un tableau d'erreurs
            $arrErrors  =   array();

            if(count($_POST) > 0){
                // Vérification de l'adresse email
                if ($strMail == "") {
                    $arrErrors['email'] =   "L'adresse email est obligatoire";
                } else if (!filter_var($strMail, FILTER_VALIDATE_EMAIL)){
                    $arrErrors['email'] =   "L'adresse email renseignée n'est pas valide";
                }

                // Vérification du mot de passe
                if ($_POST['password'] == "") {
                    $arrErrors['password'] = "Le mot de passe est obligatoire";
                }

                if(count($arrErrors) == 0){
                    // On utilise le modèle pour effectuer la requête dans la base de donnée
                    $arrUser        =   $this->_objUserModel->loginUser($strMail, $strPassword);

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
            $this->_arrData['strMail']    =   $strMail;

            
            $this->display('login');
            
            // Suppression de l'erreur concernant la suppression du compte si elle existe
            if(isset($_SESSION['account_deletion'])){
                unset($_SESSION['account_deletion']);
                unset($_SESSION['boolAccountDeletion']);
            }
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
            // Redirection si l'utilisateur n'est pas connecté
            if(!isset($_SESSION['user'])){
                header("Location:future_index.php?ctrl=user&action=login");
            }
            
            // Variables d'affichage
            // Ce qui sert de h1 et/ou de nom dans le titre de la page
            $this->_arrData['strTitle'] =   "Mon compte";
            // Variables fonctionnelles
            $this->_arrData['refPage']  =   "my_account";
            
            // Récupération des données en sessions de user
            $arrUser	= $this->_objUserModel->displayUser($_SESSION['user']->getId());

            $objUser = new UserEntity();
            $objUser->hydrate($arrUser);

            // Récupération de l'adresse email dans une variable pour comparaison
            $strOldMail   =   $objUser->getMail();

            $arrErrors    = array();
			// Si des données sont envoyées -> les données ont potentiellement été modifiées
			// Je réhydrate avec les nouvelles données
			if(count($_POST)>0){
                // Récupération de l'adresse email envoyée dans le formulaire
                $strNewMail    =   $_POST['mail'];


                if($strNewMail != $strOldMail){
                    // Vérification de l'adresse email
                    if ($strNewMail == "") {
                        $arrErrors['email'] =   "L'adresse email est obligatoire";
                    } else if (!filter_var($strNewMail, FILTER_VALIDATE_EMAIL)){
                        $arrErrors['email'] =   "L'adresse email renseignée n'est pas valide";
                    } else {
                        $boolMail   =   $this->_objUserModel->verifMail($strNewMail);
                        if ($boolMail === true){
                            $arrErrors['email'] =   "Cette adresse email est déjà utilisée";
                        }
                    }
                }

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
                            
                            if (!isset($arrErrors['new_pwd'])){
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
            // Vérifie que la page est accessible uniquement en session et par un admin/modo
            if(!isset($_SESSION['user'])){
                header("Location:future_index.php?ctrl=user&action=login");
            } else if ($_SESSION['user']->getRole() == 'user'){
                header("Location:future_index.php?ctrl=error&action=error403");
            }

            // Variables d'affichage
            // Ce qui sert de h1 et/ou de nom dans le titre de la page
            $this->_arrData['strTitle'] =   "Gestion des utilisateurs";
            // Variables fonctionnelles
            $this->_arrData['refPage']  =   "user_role_manage";
            
            $strKeyword =   $_POST['keyWord']??"";
            $this->_arrData['strKeyword'] =   trim($strKeyword);

             // Recherche d'un utilisateur par son pseudo ou prénom ou nom
             if((count($_POST)>0) && (isset($_POST['search']))){
            }

            // Modification d'un rôle utilisateur
            if((count($_POST)>0) && (!isset($_POST['search']))){
                $strUserId    =   $_POST['user']??"";
                $strRole    =   $_POST['role']??"";
                
                // Vérifie que l'utilisateur en session a les droits de modifications
                if($_SESSION['user']->getRole() != 'admin'){
                    header("Location:future_index.php?ctrl=movie&action=home");
                } else {
                    $boolQuery = $this->_objUserModel->updateRole($strRole, $strUserId);
                }
            }

            // Utilisation
            $arrUser	= $this->_objUserModel->findAll($strKeyword);
            $this->_arrData['arrUser']  =   $arrUser;
            
            // Appel de la méthode display (MotherCtrl)
            $this->display('user_role_manage');

            // Suppression de l'erreur concernant la suppression du compte si elle existe
            if(isset($_SESSION['account_deletion'])){
                unset($_SESSION['account_deletion']);
                unset($_SESSION['boolAccountDeletion']);
            }
        }

        /**
         * Suppression du compte utilisateur
         */
        public function delete_account(){
            // Récupération de l'id en URL
            $strId  =   $_GET['id']??"";

            // Vérifie que l'utilisateur est connecté, sinon redirection
            if(!isset($_SESSION['user'])){
                header("Location:future_index.php?ctrl=user&action=login");
            }

            // Vérification de la valeur de l'id en URL
            if($strId == ""){
                // L'id est vide
                header("Location:future_index.php?ctrl=error&action=error404");
            } else {
                if($strId == $_SESSION['user']->getId()){
                    // L'id dans l'url est celui de l'utilisateur connecté
                    $this->_arrData['strTitle'] =   "Supprimer mon compte";
                } else {
                    if($_SESSION['user']->getRole() == "user"){
                        // Le rôle de l'utilisateur n'est pas admin
                        header("Location:future_index.php?ctrl=error&action=error403");
                    }

                    $arrUserRole = $this->_objUserModel->checkRole($_GET['id']);
                    var_dump($arrUserRole['role']);

                    if (($arrUserRole['role'] == $_SESSION['user']->getRole()) || ($arrUserRole['role'] == 'admin')) {
                        // L'utilisateur est redirigé si il tente de supprimé un utilisateur ayant le même rôle que lui ou supérieur
                        header("Location:future_index.php?ctrl=error&action=error403");
                    }

                    $this->_arrData['strTitle'] =   "Supprimer le compte d'un utilisateur";
                }
            }

            // Mise en session d'un booléen pour confirmer que l'utilisateur est passé par la page de confirmation
            $_SESSION['boolAccountDeletion']        = true;
            // Mise en session de l'id de l'utilisateur à supprimer
            $_SESSION['account_deletion']['user']   = $strId;

            // Récupération de l'avatar de l'utilisateur supprimé
            $arrUserAvatar  =  $this->_objUserModel->displayAvatar($_GET['id']);
            $this->_arrData['strUserAvatar'] = $arrUserAvatar['user_avatar'];
            $this->display('delete_account');
        }

        /**
         * Confirmation de suppression du compte utilisateur
         */
        public function confirm_delete_account(){
            // Récupération du l'url de la page de référence
            $strServReferer    =   $_SERVER['HTTP_REFERER']??"";

            // Vérifie que l'utilisateur est bien passé par la page de confirmation de suppression de compte (booleen + url de référence)
            if ((isset($_SESSION['boolAccountDeletion'])) && (isset($_SESSION['account_deletion']['user'])) && (str_contains($strServReferer,'action=delete_account'))){
                $boolDeletionQuery  =   $this->_objUserModel->deleteAccount($_SESSION['account_deletion']['user']);
            } else {
                $_SESSION['account_deletion']['error']  =   "Echec lors de la suppression du compte";
            }

            // Récupération du résultat de la requête
            if($boolDeletionQuery === true){
                // La requête s'est bien passée
                $_SESSION['account_deletion']['success']  =   "Le compte a bien été supprimé";
                
                // Si l'utilisateur supprimé est l'utilisateur en session -> désactivation de la session et redirection vers login
                if($_SESSION['account_deletion']['user'] == $_SESSION['user']->getId()){
                    unset($_SESSION['user']);
                    header("Location:future_index.php?ctrl=user&action=login");
                    die;
                }
            } else {
                // La requête a rencontré un problème
                $_SESSION['account_deletion']['error']  =   "Echec lors de la suppression du compte. Veuillez réessayer plus tard";
                
                // Si l'utilisateur supprimé est l'utilisateur en session -> redirection vers la page mon compte
                if($_SESSION['account_deletion']['user'] == $_SESSION['user']->getId()){
                    header("Location:future_index.php?ctrl=user&action=my_account");
                    die;
                }
            }
            die;
            // Redirection vers la page de gestion des utilisateurs
            header("Location:future_index.php?ctrl=user&action=user_role_manage");
        }

        /**
         * Création d'un compte
         */
        public function create_account(){
            // Variables d'affichage
            // Ce qui sert de h1 et/ou de nom dans le titre de la page
            $this->_arrData['strTitle'] =   "Créer mon compte";
            // Variables fonctionnelles
            $this->_arrData['refPage']  =   "create_account";
            
            $objUser = new UserEntity();

            if(isset($_SESSION['user'])){
                header("Location:future_index.php?ctrl=user&action=my_account");
                die;
            }
            
            var_dump($_POST);
            $strConfPwd  = $_POST['confirm_pwd']??"";
            $boolAvatar = false;

            $arrErrors = array();
            if(count($_POST)>0){
                $objUser->hydrate($_POST);
                var_dump($objUser);

                // Vérification de l'ID
                if($objUser->getId() == ""){
                    $arrErrors['pseudo']    =   'Le champ "Pseudo" est obligatoire';
                } else {
                    $boolId   =   $this->_objUserModel->verifId($objUser->getId());
                    if ($boolId === true){
                        $arrErrors['pseudo'] =   "Ce pseudo est déjà utilisé";
                    }
                }
                // Vérification du prénom
                if($objUser->getFirst_name() == ""){
                    $arrErrors['prenom']    =   'Le champ "Prénom" est obligatoire';
                }
                // Vérification du nom
                if($objUser->getLast_name() == ""){
                    $arrErrors['nom']       =   'Le champ "Nom" est obligatoire';
                }
                // Vérification de l'email
                if($objUser->getMail() == ""){
                    $arrErrors['email']     =   'Le champ "Adresse email" est obligatoire';
                } else if (!filter_var($objUser->getMail(), FILTER_VALIDATE_EMAIL)){
                    $arrErrors['email']     =   "L'adresse email renseignée n'est pas valide";
                } else {
                    $boolMail   =   $this->_objUserModel->verifMail($objUser->getMail());
                    if ($boolMail === true){
                        $arrErrors['email'] =   "Cette adresse email est déjà utilisée";
                    }
                }

                // Vérification du mot de passe
                if ($objUser->getPassword() == ""){
                    $arrErrors['pwd']     =   'Le champ "mot de passe" est obligatoire';
                } else {
                    // Vérifie que le mot de passe contient au moins 8 caractères
                    if (strlen($objUser->getPassword())<8){
                        $boolErrorPwd = true;
                        $arrErrorsPwd[]= "au minimum 8 caractères";
                    }
                    // Vérifie que le mot de passe contient un chiffre
                    if (!preg_match("#[0-9]#", $objUser->getPassword())){
                        $boolErrorPwd = true;
                        $arrErrorsPwd[]= "au moins un chiffre";
                    }
                    // Vérifie que le mot de passe contient une lettre majuscule
                    if (!preg_match("#[A-Z]#", $objUser->getPassword())){
                        $boolErrorPwd = true;
                        $arrErrorsPwd[]= "au moins une lettre majuscule";
                    }
                    // Vérifie que le mot de passe contient une lettre minuscule
                    if (!preg_match("#[a-z]#", $objUser->getPassword())){
                        $boolErrorPwd = true;
                        $arrErrorsPwd[]= "au moins une lettre minuscule";
                    }
                    // Vérifie que le mot de passe contient un caractère spécial
                    if (!preg_match("#\W#", $objUser->getPassword())){
                        $boolErrorPwd = true;
                        $arrErrorsPwd[]= "au moins un caractère spécial";
                    }
                    // Si le mot de passe ne respecte pas une des conditions, un booléen est renvoyé
                    if((isset($boolErrorPwd)) && ($boolErrorPwd === true)){
                        $this->_arrData['arrErrorsPwd']	=  $arrErrorsPwd;
                        $arrErrors['pwd']     =   'Le mot de passe ne respecte pas les critères';
                    }
                    
                    if (!isset($arrErrors['pwd'])){
                        // Si tout est ok pour le mot de passe, on s'occupe la confirmation
                        if ($strConfPwd == ""){
                            // Vérifie que le champ confirmation de mot de passe est renseigné
                            $arrErrors['conf_pwd']	= 'Le champ "Confirmation mot de passe" doit être renseigné';
                        
                        } else if ($objUser->getPassword() != $strConfPwd) {
                            // Vérifie que les mots de passe correspondent
                            $arrErrors['conf_pwd']	= "La confirmation de mot de passe ne correspond pas à celui renseigné";
                        }
                    }
                    
                }

                // Vérifie qu'une photo de profil a été importée
                if(count($_FILES)>0){
                    $arrImage = $_FILES['profile_picture'];
                    if($arrImage['error']==0){
                        $boolAvatar = true;
                        $strSource = $arrImage['tmp_name']; // Récupération de l'image

                        // Traitement de l'image importée
                        // Création d'une imageGD
                        switch($arrImage['type']){
                            case "image/webp":
                                $image = imagecreatefromwebp($strSource);
                                break;
                            case "image/jpeg":
                                $image = imagecreatefromjpeg($strSource);
                                break;
                            case "image/png":
                                $image = imagecreatefrompng($strSource);
                                break;
                        }

                        $arrFileExplode	= explode(".", $arrImage['name']);
                        $strFileExt = $arrFileExplode[count($arrFileExplode)-1]; // Récupération de l'extension
                        $strFileName = bin2hex(random_bytes(10)).".webp"; // Génération d'un nom de fichier random
                        $strDest = "assets/img/users/profile_pictures/".$strFileName; // Définition de la destination du fichier et de son nom

                        list($intWidth, $intHeight) = getimagesize($strSource); // Récupération des dimensions de l'image

                        $intShortSize   = 300; // Largeur de l'image finale

                        // Calcul et redimensionnement proportionnel des dimensions de l'image selon l'orientation
                        if ($intWidth < $intHeight){
                            // Format portrait
                            $boolPortrait = true;
                            $intLongSize = round(($intShortSize*$intHeight)/$intWidth); // Produit en croix
                            $objMask = imagecreatetruecolor($intShortSize, $intLongSize); // Conteneur vide portrait;
                            imagecopyresized($objMask, $image, 0, 0, 0, 0, $intShortSize, $intLongSize, $intWidth, $intHeight); // Redimensionnement
                        } else {
                            // Format paysage
                            $boolPortrait = false;
                            $intLongSize = round(($intShortSize*$intWidth)/$intHeight); // Produit en croix
                            $objMask = imagecreatetruecolor($intLongSize, $intShortSize); // Conteneur vide paysage;
                            imagecopyresized($objMask, $image, 0, 0, 0, 0, $intLongSize, $intShortSize, $intWidth, $intHeight); // Redimensionnement
                        }

                        // Calcul du delta entre les dimensions des côtés
                        $intDelta = round(($intLongSize-$intShortSize)/2);

                        // Création d'un nouveau conteneur d'image carré
                        $objNewMask     = imagecreatetruecolor($intShortSize,$intShortSize);

                        if ($boolPortrait){
                            // Format portrait
                            $imageResized   = imagecrop($objMask, ['x' => 0, 'y' => $intDelta, 'width' => $intShortSize, 'height' => $intShortSize]);
                        } else {
                            // Format paysage
                            $imageResized   = imagecrop($objMask, ['x' => $intDelta, 'y' => 0, 'width' => $intShortSize, 'height' => $intShortSize]);
                        }
                        imagewebp($imageResized,$strDest);

                        
                        $objUser->setAvatar($strFileName);
                    }
                }

                if(count($arrErrors) == 0){
                    var_dump("hey");                    
                    $boolCreation   =   $this->_objUserModel->newUser($objUser, $boolAvatar);
                    if ($boolCreation === true){
                        $_SESSION['account_creation']['success'] = "Le compte a bien été créé";
                        header("Location:future_index.php?ctrl=user&action=login");
                    } else {
                        $_SESSION['account_creation']['error'] = "Erreur lors de la création du compte";
                    }
                    var_dump($_SESSION);
                }
            }

            $this->_arrData['arrErrors']	=  $arrErrors;
            $this->_arrData['objUser']		=  $objUser;

            $this->display('create_account');
        }
    }