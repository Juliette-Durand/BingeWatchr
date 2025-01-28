<?php
    /**
     * Controleur enfant de MotherController pour la gestion utilisateur
     * @author Juliette Durand
     */
    require_once("mother_controller.php");
    
    class UserCtrl extends MotherCtrl{

        public function __construct(){
            parent::__construct();
        }
    }