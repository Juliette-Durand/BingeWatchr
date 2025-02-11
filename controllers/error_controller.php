<?php
    /**
     * Controleur enfant de MotherController pour la gestion des erreurs
     * @author Juliette Durand
     * Créé le 07/02/2025 - Dernière modification le 07/02/2025 par Juliette Durand
     */

    require_once("mother_controller.php");
    
    class ErrorCtrl extends MotherCtrl{
        /**
         * Constructeur de la classe
         */
        public function __construct(){
            parent::__construct();
        }

        /**
         * Page d'erreur 403 - L'utilisateur n'a pas les droits pour accéder à cette page
         */
        public function error403(){
            /* Ce qui sert de h1 et/ou de nom dans le titre de la page */
            $this->_arrData['strTitle'] =   "Erreur 403";
            
            // Variables fonctionnelles
            $this->_arrData['refPage']  =   "error403";

            $this->display('error403');
        }

        /**
         * Page d'erreur 404 - La page est introuvable
         */
        public function error404(){
            /* Ce qui sert de h1 et/ou de nom dans le titre de la page */
            $this->_arrData['strTitle'] =   "Erreur 404";
            
            // Variables fonctionnelles
            $this->_arrData['refPage']  =   "error404";

            $this->display('error404');
        }
    }