<?php
    /**
     * Controleur enfant de MotherController pour la gestion des commentaires
     * @author Juliette Durand
     * Créé le 17/02/2025 - Dernière modification le 17/02/2025 par Juliette Durand
     */

    require_once("mother_controller.php");
    
    class CommentCtrl extends MotherCtrl{
        /**
         * Constructeur de la classe
         */
        public function __construct(){
            parent::__construct();
        }

        /**
         * Page d'erreur 403 - L'utilisateur n'a pas les droits pour accéder à cette page
         */
        public function comment_manage(){
            /* Ce qui sert de h1 et/ou de nom dans le titre de la page */
            $this->_arrData['strTitle'] =   "Gestion des commentaires";
            
            // Variables fonctionnelles
            $this->_arrData['refPage']  =   "comment_manage";


            $this->display('comment_manage');
        }
    }