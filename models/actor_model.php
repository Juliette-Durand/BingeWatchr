<?php 
    /**
    * Classe d'un acteur
    * @author Arlind Halimi
    */


    require_once('mother_model.php');

    class ActorModel extends MotherModel {

        /**
         * Declare variable $intActor
         */
        public int 	$intActor = 0;

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

 
        /**
         * Function pour select firstname et lastname de actor
         * @return array des information de actor id, firstname et lastname
         */
        public function NameSurnameActors():array{
            $strQuery      = "SELECT actor_id, actor_first_name, actor_last_name 
                                FROM actor
                                ORDER BY actor_first_name ASC;";

            $arrActors = $this->_db->query($strQuery)->fetchAll();

            return $arrActors;
        }

        /**
         * Ajoute un actor
         * @return boolean
         */
        public function addActor(object $objActorEntity):bool{
            try{
                $strQuery = " INSERT INTO actor
                    (actor_first_name, actor_last_name, actor_picture)
                    VALUE (:actortName, :actorLast, :actorPicture);";

                    $rqPrep = $this->_db->prepare($strQuery);
                    $rqPrep->bindValue(":actortName",     $objActorEntity->getFirst_name(), PDO::PARAM_STR);
                    $rqPrep->bindValue(":actorLast",      $objActorEntity->getLast_name(), PDO::PARAM_STR);
                    $rqPrep->bindValue(":actorPicture",   $objActorEntity->getPicture(), PDO::PARAM_STR);


                $rqPrep->execute();
            }catch(PDOExeption $e){
                return false;
            }
            return true;
        }
        
        /**
         * Function pour select id de actor
         * @return int 
         */
        public function IdActors(){
            $strQuery      = "SELECT actor_id 
            FROM actor;";

            $arrActors = $this->_db->query($strQuery)->fetchAll();

            return $arrActors;
        }
    
        
    }