<?php 
    /**
    * Classe d'un acteur
    * @author Arlind Halimi
    */


    require_once('mother_model.php');

    class ActorModel extends MotherModel {

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
         * @return string Tableau de l'acteur
         */
        
        public function findActor(int $intId) : array{
            $strQueryOneActor       = "SELECT * FROM actor 
                                        INNER JOIN play ON play_actor_id = actor_id
                                        WHERE play_movie_id = ".$intId."
                                        ORDER BY actor_first_name ASC";

            $arrOneActor = $this->_db->query($strQueryOneActor)->fetchAll();
            return $arrOneActor;

        }
        public function NameSurnameActors(){
            $strQuery      = "SELECT CONCAT (actor_first_name, ' ', actor_last_name) as Actor 
            FROM actor as Actor
            ORDER BY actor_last_name ASC;";

            $arrActors = $this->_db->query($strQuery)->fetchAll();

            return $arrActors;
        }

    }