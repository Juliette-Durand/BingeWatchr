<?php
	/**
	* Classe de gestion de la base de données pour les utilisateurs
	* @author Arlind Halimi
	*/


    require_once("mother_model.php");

    class MovieModel extends MotherModel{

        /**
        * Constructeur de la classe
        */
        public function __construct(){
            parent::__construct();
        }

        /**
        * Récupération de tous les movies
        * @return array Tableau des movies de la bdd
        */
        public function findAll():array{

            /* Requête pour trouve tout les films */
            $strQueryMovie  	= "	SELECT *
                                FROM movie
                                ORDER BY movie_name ASC;";
            var_dump($strQueryMovie);

			/* Je récupère le résultat de ma requête d'utilisateurs */
            $arrMovie  = $this->_db->query($strQueryMovie)->fetchAll();

            return $arrMovie;
        }
        /* Requête pour trouve un film specifique */
        public function findMovie(int $intId) : array {
            $strQueryOneMovie = "SELECT * 
                                FROM movie
                                WHERE movie_id = ".$intId."
                                ORDER BY movie_name ASC";
                                
            $arrOneMovie = $this->_db->query($strQueryOneMovie)->fetch();
            return $arrOneMovie;
        }

            /*
            * Récupération des 6 derniers films sortis 
            * @return tableau des films 
            */
            public function movieDisplay():array {
                $strQuery		=   "SELECT movie_name, movie_poster, movie_id 
                                FROM movie
                                ORDER BY movie_release DESC
                                LIMIT 6 OFFSET 0;";
                                
            $arrMovieDisplay	= $this->_db->query($strQuery)->fetchAll();
            return $arrMovieDisplay;
            }

            /*
            * Récupération des 6 derniers films ajoutés 
            * @return tableau des films 
            */
            public function movieRecentAdd():array {

                $strQuery		=   "SELECT movie_name, movie_poster, movie_id 
                                FROM movie
                                ORDER BY movie_creation_date DESC
                                LIMIT 6 OFFSET 0;";
                                
            $arrMovieRecentAdd	= $this->_db->query($strQuery)->fetchAll();
            return $arrMovieRecentAdd;
            }

            /**
             * Public function addMovie (string $strTitle, string $strTitle, string $strDate, string $strPhoto, string $strDuration)
             */
            public function addMovie($objMovieEntity){
                try{
                    $strQuery = "INSERT INTO movie 
                        (movie_name, movie_desc, movie_release, movie_creation_date, movie_poster, movie_pegi, movie_display, movie_duration)
                        VALUE (:name, :desc, :release, NOW(), :poster, :pegi ,:display,:duration)";

                    $prep = $this->_db->prepare($strQuery);
                    $prep->bindValue(":name",       $objMovieEntity->getName(), PDO::PARAM_STR);
                    $prep->bindValue(":desc",       $objMovieEntity->getDesc(), PDO::PARAM_STR);
                    $prep->bindValue(":release",    $objMovieEntity->getRelease(), PDO::PARAM_STR);
                    $prep->bindValue(":poster",     $objMovieEntity->getPoster(), PDO::PARAM_STR);
                    $prep->bindValue(":pegi",       $objMovieEntity->getPegi(), PDO::PARAM_STR);
                    $prep->bindValue(":display",    $objMovieEntity->getDisplay(), PDO::PARAM_STR);
                    $prep->bindValue(":duration",   $objMovieEntity->getDuration(), PDO::PARAM_STR);

                    var_dump($prep->debugDumpParams());
                    $prep->execute();
                }catch(PDOExeption $e){
                    return false;
                }
                return true;
            } 

            

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
        
    
    }

