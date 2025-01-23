<?php 
    /**
    * Classe d'un acteur
    * @author Arlind Halimi
    */


    require_once('mother_entity.php');

    class Actor extends MotherEntity {

        /**
         * Constructeur de la classe
         */
        public function __construct() {
            parent::__construct();
        }

        /**
         * Récupération de tous les acteurs
         * @return array Tableau des acteurs
         */
        public function findAllActors() {
            $strQuery       = "SELECT * 
                                FROM actor
                                ORDER BY actor_last_name ASC;";

            $arrActors = $this->_db->query($strQuery)->fetchAll();

            return $arrActors;
        }

        /**
         * Récupération d'un acteur spécifique
         * @return array Tableau de l'acteur
         */
        
        public function findActor($id){
            $strQueryOneActor       = "SELECT * 
                                FROM actor
                                WHERE actor_id = :id";

            $arrParams = array("id" => $id);

            $arrActor = $this->_db->query($strQueryOneActor, $arrParams)->fetch();

            return $arrActor;
        }

    }