<?php
    /**
     * Controleur enfant de MotherController pour les pages sans thème spécifique
     * @author Juliette DUrand
     * Date : 27/02/2025 
     */

    require_once("mother_controller.php");

    class PageCtrl extends MotherCtrl{

        public function __construct(){
            parent::__construct();
            
        }

        /**
        * Page Politique de confidentialité
        */
        public function politics(){
            // Variables d'affichage
            /* Ce qui sert de h1 et/ou de nom dans le titre de la page */
            $this->_arrData['strTitle'] =   "Politique de confidentialité";
            
            // Variables fonctionnelles
            $this->_arrData['refPage']  =   "politics";

            $this->display("politics");
        }

        /**
        * Page Mentions légales
        */
        public function mentions(){
            // Variables d'affichage
            /* Ce qui sert de h1 et/ou de nom dans le titre de la page */
            $this->_arrData['strTitle'] =   "Mentions légales";
            
            // Variables fonctionnelles
            $this->_arrData['refPage']  =   "mentions";

            $this->display("mentions");
        }
    }
