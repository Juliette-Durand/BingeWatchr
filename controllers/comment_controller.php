<?php
    /**
     * Controleur enfant de MotherController pour la gestion des commentaires
     * @author Juliette Durand
     * Créé le 17/02/2025 - Dernière modification le 25/02/2025 par Juliette Durand
     */

    require_once("mother_controller.php");
    
    class CommentCtrl extends MotherCtrl{

        private object $_objCommentModel; /**< Object Comment utilisé dans tous le controller, instancié en CommentModel et qui sert à l'exécution des requêtes */

        /**
         * Constructeur de la classe
         */
        public function __construct(){
            parent::__construct();
            require_once("models/comment_model.php");
            require_once("entities/comment_entity.php");

            $this->_objCommentModel   =   new CommentModel();
        }

        /**
         * Page de gestion des commentaires - seuls les modérateurs et admin y ont accès
         */
        public function comment_manage(){

            // Vérification des droits
            if((!isset($_SESSION['user'])) || ($_SESSION['user']->getRole() == "user")){
                header("Location:index.php?ctrl=error&action=error403");
                exit();
            }

            require_once("entities/user_entity.php");
            require_once("models/user_model.php");
            require_once("entities/picture_entity.php");
            $objUserModel = new UserModel;

            /* Ce qui sert de h1 et/ou de nom dans le titre de la page */
            $this->_arrData['strTitle'] =   "Gestion des commentaires";
            
            // Variables fonctionnelles
            $this->_arrData['refPage']  =   "comment_manage";

            $arrComment = $this->_objCommentModel->findAllComments();
            // var_dump($arrComment);

            $intId = $_POST['id_comm']??0;
            $strPublishState = $_POST['publish_state']??'Publier';

            if(count($_POST)>0){
                var_dump($_POST);

                if($intId != 0){
                    if($strPublishState == "Publier"){
                        $strNewState = "P";
                    } else {
                        $strNewState = "U";
                    }
                    var_dump($strNewState);
                    $boolPublish = $this->_objCommentModel->publishComment($intId, $strNewState);

                    if($boolPublish === true){
                        var_dump("success");
                        header("Location:index.php?ctrl=comment&action=comment_manage");
                        exit();
                    }
                }
            }


            $arrCommentToDisplay = array();
            foreach($arrComment as $arrDetComment){
                // Commentaire et son contenu
                $objComment = new CommentEntity;
                $objComment->hydrate($arrDetComment);

                // Utilisateur auteur du commentaire
                $arrUser = $objUserModel->displayUser($objComment->getUser_id());
                $objUser = new UserEntity;
                $objUser->hydrate($arrUser);

                // Photos associées au commentaire
                $picturesComment = $this->_objCommentModel->findPictures($objComment->getId());
                // var_dump($picturesComment);

                // Vérifie si des photos sont associées au commentaire
                if($picturesComment !== false){
                    foreach($picturesComment as $picDet){
                        $objPicture = new PictureEntity;
                        $objPicture->hydrate($picDet);
                        $arrPictures[] = $objPicture;
                    }
                    $arrCommentToDisplay[$objComment->getId()]['picture']   =   $arrPictures;
                }

                $arrCommentToDisplay[$objComment->getId()]['comment']   =   $objComment;
                $arrCommentToDisplay[$objComment->getId()]['user']      =   $objUser;
            }

            // Donne les variables à la vue
            $this->_arrData['arrComment'] = $arrCommentToDisplay;

            // AFfichage de la vue
            $this->display('comment_manage');
        }

        /**
         * Page de suppression d'un commentaire selon l'id en URL (Redirection automatique)
         */
        public function delete_comment(){

            // Vérification des droits
            if((!isset($_SESSION['user'])) || ($_SESSION['user']->getRole() == "user")){
                header("Location:index.php?ctrl=error&action=error403");
                exit();
            }

            // Récupération de l'id en URL
            $intId = $_GET['id']??0;
            // Récupération de la provenance de l'utilisateur (dernier url)
            $strServReferer    =   $_SERVER['HTTP_REFERER']??"";
            
            // Vérifie que l'utilisateur est passé par la page de gestion des commentaires
            if(str_contains($strServReferer,'action=comment_manage')){

                // Suppression des photos associées au commentaire
                $boolDelPic = $this->_objCommentModel->deletePictures($intId);
                
                // Si suppression des photos bien réalisée, suppression du commentaire
                if($boolDelPic === true){
                    $boolDelComm = $this->_objCommentModel->deleteComment($intId);

                    // Succès de la suppression du commentaire, redirection vers la page de gestion des commentaires
                    if($boolDelComm === true){
                        $_SESSION['success']	=	"Le commentaire a bien été supprimé";
                    } else {
                        $_SESSION['error']	=	"Erreur lors de la suppression du commentaire, veuillez réessayer plus tard";
                    }
                    header("Location:index.php?ctrl=comment&action=comment_manage");
                    exit();
                }
            }

        }
    }