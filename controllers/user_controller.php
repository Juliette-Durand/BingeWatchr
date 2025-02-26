<?php
    /**
     * Controleur enfant de MotherController pour la gestion utilisateur
     * @author Juliette Durand
     * Créé le 28/01/2025 - Dernière modification le 21/02/2025 par Juliette Durand
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
                header("Location:index.php?ctrl=user&action=my_account");
                exit();
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
            $this->_arrErrors  =   array();

            if(count($_POST) > 0){
                // Vérification de l'adresse email
                if ($strMail == "") {
                    $this->_arrErrors['email'] =   "L'adresse email est obligatoire";
                } else if (!filter_var($strMail, FILTER_VALIDATE_EMAIL)){
                    $this->_arrErrors['email'] =   "L'adresse email renseignée n'est pas valide";
                }

                // Vérification du mot de passe
                if ($_POST['password'] == "") {
                    $this->_arrErrors['password'] = "Le mot de passe est obligatoire";
                }

                if(count($this->_arrErrors) == 0){
                    // On utilise le modèle pour effectuer la requête dans la base de donnée
                    $arrUser        =   $this->_objUserModel->loginUser($strMail, $strPassword);

                    // Si aucun utilisateur correspondant aux identifiants n'a été trouvé dans la base de donnée
                    if($arrUser === false){
                        $this->_arrErrors['connect']   =   "Adresse email ou mot de passe incorrect(e)";
                    } else {
                        // Enregistrement de l'utilisateur en session
                        $objUser    =   new UserEntity();
                        $objUser->hydrate($arrUser);
                        $_SESSION['user']   =   $objUser;
                        header("Location:index.php?ctrl=user&action=my_account");
                        exit();
                        //var_dump($_SESSION);
                    }
                }
            }
            $this->_arrData['arrErrors']    =   $this->_arrErrors;
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
            header("Location:index.php?ctrl=user&action=login");
            exit();
        }

        /**
         * Page d'affichage et mise à jour des infos utilisateur
         */
        public function my_account(){
            // Redirection si l'utilisateur n'est pas connecté
            if(!isset($_SESSION['user'])){
                header("Location:index.php?ctrl=user&action=login");
                exit();
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

			// Si des données sont envoyées -> les données ont potentiellement été modifiées
			// Je réhydrate avec les nouvelles données
			if(count($_POST)>0){
                // Récupération de l'adresse email envoyée dans le formulaire
                $strNewMail    =   $_POST['mail'];


                if($strNewMail != $strOldMail){
                    // Vérification de l'adresse email
                    if ($strNewMail == "") {
                        $this->_arrErrors['email'] =   "L'adresse email est obligatoire";
                    } else if (!filter_var($strNewMail, FILTER_VALIDATE_EMAIL)){
                        $this->_arrErrors['email'] =   "L'adresse email renseignée n'est pas valide";
                    } else {
                        $boolMail   =   $this->_objUserModel->verifMail($strNewMail);
                        if ($boolMail === true){
                            $this->_arrErrors['email'] =   "Cette adresse email est déjà utilisée";
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
                            $this->_arrErrors['avatar']    =   "L'image importée doit être au format JPG";
                    } else if ($_FILES['avatar']['size']>1000000){
                        $this->_arrErrors['avatar']    =   "L'image importée doit être inférieure à 1Mo";
                    }
                }
                
                $strOldPwd  =   $_POST['old_pwd']??"";
                $strNewPwd  =   $_POST['new_pwd']??"";
                $strConfPwd  =   $_POST['confirm_pwd']??"";

                // Flag de modification de mot de passe
                $boolPwd = false;
                $arrErrorsPwd = array();
                if ($strOldPwd != ""){
                    if (!password_verify($strOldPwd, $objUser->getPassword())){
                        // Vérifie que le mot de passe renseigné correspond à celui en bdd
                        $this->_arrErrors['pwd']  =   "Le mot de passe renseigné ne correspond pas au mot de passe actuel";
                    } else {
                        $boolPwd = true;
                        if ($strNewPwd != ""){
                            // Vérifie que le mot de passe contient au moins 8 caractères
                            if (strlen($strNewPwd)<8){
                                $arrErrorsPwd[]= "au minimum 8 caractères";
                            }
                            // Vérifie que le mot de passe contient un chiffre
                            if (!preg_match("#[0-9]#", $strNewPwd)){
                                $arrErrorsPwd[]= "au moins un chiffre";
                            }
                            // Vérifie que le mot de passe contient une lettre majuscule
                            if (!preg_match("#[A-Z]#", $strNewPwd)){
                                $arrErrorsPwd[]= "au moins une lettre majuscule";
                            }
                            // Vérifie que le mot de passe contient une lettre minuscule
                            if (!preg_match("#[a-z]#", $strNewPwd)){
                                $arrErrorsPwd[]= "au moins une lettre minuscule";
                            }
                            // Vérifie que le mot de passe contient un caractère spécial
                            if (!preg_match("#\W#", $strNewPwd)){
                                $arrErrorsPwd[]= "au moins un caractère spécial";
                            }
                            $this->_arrData['arrErrorsPwd'] = $arrErrorsPwd;
                            
                            if (count($arrErrorsPwd)>0){
                                $this->_arrErrors['pwd'] = "Le nouveau mot de passe ne respecte pas les critères";
                            } else {
                                // Si tout est ok pour le mot de passe, on s'occupe la confirmation
                                if ($strConfPwd == ""){
                                    // Vérifie que le champ confirmation de mot de passe est renseigné
                                    $this->_arrErrors['pwd']	= "Le champ de la confirmation de mot de passe doit être renseigné";
                                
                                } else if ($strNewPwd != $strConfPwd) {
                                    // Vérifie que les mots de passe correspondent
                                    $this->_arrErrors['pwd']	= "La confirmation de mot de passe ne correspond pas au nouveau renseigné";
                                }
                            }
                            
                        }
                    }
                }

                if(count($this->_arrErrors) == 0){
                    $objUser->hydrate($_POST);
                    $objUser->setId($_SESSION['user']->getId());
                    if ($boolAvatar){
                        $objUser->setAvatar($_FILES['avatar']['name']);
                    }
                    if ($boolPwd){
                        $objUser->setPassword($_POST['new_pwd']);
                    }
                    // Exécution de la méthode de mise à jour des données
                    // Récupération du résultat de la requête PDO
                    $boolChange	= $this->_objUserModel->changeInfos($objUser, $boolPwd);
                    if($boolChange === true){
                        $_SESSION['success']	=	"Les modifications ont bien été prises en compte";
                        // Affectation des modifications dans la session
                        $_SESSION['user']   =   $objUser;
                    } else {
                        $_SESSION['error']	=	"Erreur lors de la prise en compte des modifications, veuillez réessayer plus tard";
                    }
                    header("Location:index.php?ctrl=user&action=my_account");
                    exit();
                }
 
			}
			
            $this->_arrData['arrErrors']	=  $this->_arrErrors;
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
                header("Location:index.php?ctrl=user&action=login");
                exit();
            } else if ($_SESSION['user']->getRole() == 'user'){
                header("Location:index.php?ctrl=error&action=error403");
                exit();
            }

            // Variables d'affichage
            // Ce qui sert de h1 et/ou de nom dans le titre de la page
            $this->_arrData['strTitle'] =   "Gestion des utilisateurs";
            // Variables fonctionnelles
            $this->_arrData['refPage']  =   "user_role_manage";
            
            $strKeyword =   $_POST['keyWord']??"";
            $this->_arrData['strKeyword'] =   trim($strKeyword);

            // Modification d'un rôle utilisateur
            if((count($_POST)>0) && (!isset($_POST['search']))){
                $strUserId    =   $_POST['user']??"";
                $strRole    =   $_POST['role']??"";
                
                // Vérifie que l'utilisateur en session a les droits de modifications
                if($_SESSION['user']->getRole() != 'admin'){
                    header("Location:index.php?ctrl=error&action=error403");
                    exit();
                } else {
                    $boolQuery = $this->_objUserModel->updateRole($strRole, $strUserId);
                }
            }

            // Utilisation
            $arrUser	= $this->_objUserModel->findAll($strKeyword);
            $arrUserToDisplay   =   array();
            foreach($arrUser as $arrDetUser){
                $objUser = new UserEntity();
			    $objUser->hydrate($arrDetUser);
                $arrUserToDisplay[] = $objUser;
            }
            $this->_arrData['arrUser']  =   $arrUserToDisplay;
            
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
                header("Location:index.php?ctrl=user&action=login");
                exit();
            }

            // Vérification de la valeur de l'id en URL
            if($strId == ""){
                // L'id est vide
                header("Location:index.php?ctrl=error&action=error404");
                exit();
            } else {
                if($strId == $_SESSION['user']->getId()){
                    // L'id dans l'url est celui de l'utilisateur connecté
                    $this->_arrData['strTitle'] =   "Supprimer mon compte";
                } else {
                    if($_SESSION['user']->getRole() == "user"){
                        // Le rôle de l'utilisateur n'est pas admin
                        header("Location:index.php?ctrl=error&action=error403");
                        exit();
                    }

                    $arrUserRole = $this->_objUserModel->checkRole($_GET['id']);

                    if (($arrUserRole['role'] == $_SESSION['user']->getRole()) || ($arrUserRole['role'] == 'admin')) {
                        // L'utilisateur est redirigé si il tente de supprimé un utilisateur ayant le même rôle que lui ou supérieur
                        header("Location:index.php?ctrl=error&action=error403");
                        exit();
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
            $strUser = $_SESSION['account_deletion']['user'];

            // Vérifie que l'utilisateur est bien passé par la page de confirmation de suppression de compte (booleen + url de référence)
            if ((isset($_SESSION['boolAccountDeletion'])) && (isset($_SESSION['account_deletion']['user'])) && (str_contains($strServReferer,'action=delete_account'))){
                
                // Suppression des commentaires associés à l'utilisateur
                require_once("models/comment_model.php");
                $objCommentModel = new CommentModel();
                require_once("models/picture_model.php");
                $objPictureModel = new PictureModel();
                // Récupération des id de tous les commentaires
                $arrComment = $objCommentModel->getIdComm($strUser);
                foreach($arrComment as $intId){
                    // Suppression des potentielles photos associées
                    $arrPictures = $objPictureModel->findPictures($intId['comm_id']);
                    $objPictureModel->deletePictures($intId['comm_id']);
                    foreach($arrPictures as $strFile){
                        unlink("assets/img/movies/movie_pictures/".$strFile);
                    }
                }
                // Suppression des commentaires
                $objCommentModel->deleteComment($strUser, false);

                // Suppression de l'utilisateur
                $boolDeletionQuery  =   $this->_objUserModel->deleteAccount($strUser);
            } else {
                header("Location:index.php?ctrl=error&action=error403");
                exit();
            }

            // Récupération du résultat de la requête
            if($boolDeletionQuery === true){
                // La requête s'est bien passée
                $_SESSION['success']  =   "Le compte a bien été supprimé";
                
                // Si l'utilisateur supprimé est l'utilisateur en session -> désactivation de la session et redirection vers login
                if($strUser == $_SESSION['user']->getId()){
                    unset($_SESSION['user']);
                    header("Location:index.php?ctrl=user&action=login");
                    exit();
                }
            } else {
                // La requête a rencontré un problème
                $_SESSION['error']  =   "Echec lors de la suppression du compte. Veuillez réessayer plus tard";
                
                // Si l'utilisateur supprimé est l'utilisateur en session -> redirection vers la page mon compte
                if($strUser == $_SESSION['user']->getId()){
                    header("Location:index.php?ctrl=user&action=my_account");
                    exit();
                }
            }
            // Redirection vers la page de gestion des utilisateurs
            header("Location:index.php?ctrl=user&action=user_role_manage");
            exit();
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
                header("Location:index.php?ctrl=user&action=my_account");
                exit();
            }
            
            $strConfPwd  = $_POST['confirm_pwd']??"";
            $boolAvatar = false;

            $this->_arrErrors = array();
            if(count($_POST)>0){
                $objUser->hydrate($_POST);

                // Vérification de l'ID
                if($objUser->getId() == ""){
                    $this->_arrErrors['pseudo']    =   'Le champ "Pseudo" est obligatoire';
                } else if (preg_match("/ /", $objUser->getId())){
                    $this->_arrErrors['pseudo']    =   "Le Pseudo ne peut pas contenir d'espaces";
                }else {
                    $boolId   =   $this->_objUserModel->verifId($objUser->getId());
                    if ($boolId === true){
                        $this->_arrErrors['pseudo'] =   "Ce pseudo est déjà utilisé";
                    }
                }
                // Vérification du prénom
                if($objUser->getFirst_name() == ""){
                    $this->_arrErrors['prenom']    =   'Le champ "Prénom" est obligatoire';
                }
                // Vérification du nom
                if($objUser->getLast_name() == ""){
                    $this->_arrErrors['nom']       =   'Le champ "Nom" est obligatoire';
                }
                // Vérification de l'email
                if($objUser->getMail() == ""){
                    $this->_arrErrors['email']     =   'Le champ "Adresse email" est obligatoire';
                } else if (!filter_var($objUser->getMail(), FILTER_VALIDATE_EMAIL)){
                    $this->_arrErrors['email']     =   "L'adresse email renseignée n'est pas valide";
                } else {
                    $boolMail   =   $this->_objUserModel->verifMail($objUser->getMail());
                    if ($boolMail === true){
                        $this->_arrErrors['email'] =   "Cette adresse email est déjà utilisée";
                    }
                }

                // Vérification du mot de passe
                $arrErrorsPwd = array();
                if ($objUser->getPassword() == ""){
                    $this->_arrErrors['pwd']     =   'Le champ "mot de passe" est obligatoire';
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
                    if(count($arrErrorsPwd)>0){
                        $this->_arrErrors['pwd']     =   'Le mot de passe ne respecte pas les critères';
                    }
                    $this->_arrData['arrErrorsPwd']	=  $arrErrorsPwd;
                    
                    if (!isset($this->_arrErrors['pwd'])){
                        // Si tout est ok pour le mot de passe, on s'occupe la confirmation
                        if ($strConfPwd == ""){
                            // Vérifie que le champ confirmation de mot de passe est renseigné
                            $this->_arrErrors['conf_pwd']	= 'Le champ "Confirmation mot de passe" doit être renseigné';
                        
                        } else if ($objUser->getPassword() != $strConfPwd) {
                            // Vérifie que les mots de passe correspondent
                            $this->_arrErrors['conf_pwd']	= "La confirmation de mot de passe ne correspond pas à celui renseigné";
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

                if(count($this->_arrErrors) == 0){        
                    $boolCreation   =   $this->_objUserModel->newUser($objUser, $boolAvatar);
                    if ($boolCreation === true){
                        $_SESSION['account_creation']['success'] = "Le compte a bien été créé";
                        header("Location:index.php?ctrl=user&action=login");
                        exit();
                    } else {
                        $_SESSION['account_creation']['error'] = "Erreur lors de la création du compte";
                    }
                }
            }

            $this->_arrData['arrErrors']	=  $this->_arrErrors;
            $this->_arrData['objUser']		=  $objUser;

            $this->display('create_account');
        }
        /*
        * Page d'aide aux utilisateurs
        */
        public function help() {
            // Variables d'affichage
            // Ce qui sert de h1 et/ou de nom dans le titre de la page
            $this->_arrData['strTitle'] =   "Aide aux utilisateurs";
            // Variables fonctionnelles
            $this->_arrData['refPage']  =   "help";
  
            $this->display('help');
        }
    }