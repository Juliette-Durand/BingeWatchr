<?php
	/**
	* Classe de gestion de la base de données pour les utilisateurs
	* @author Arlind Halimi et Hugo
  * modifiée par Hugo le 31/01/2025
	*/

    /**
     * require pour mother model
     */
    require_once("mother_model.php");
    require_once("entities/movie_entity.php");
    
    class MovieModel extends MotherModel{

        // Attributs pour la recherche
        public string $strKeyword = "";
        public int 	$intCategory = 0;

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
            $strQueryMovie  	= "	SELECT movie.*
                                FROM movie
                                ORDER BY movie_name ASC;";
            //var_dump($strQueryMovie);
			/* Je récupère le résultat de ma requête d'utilisateurs */
            $arrMovie  = $this->_db->query($strQueryMovie)->fetchAll();

            return $arrMovie;
        }
        /**
         *  Requête pour trouve un film specifique avec id
         * @return array $arrOneMovie Tableau des movies de la bdd
         */
        public function findMovie(int $intId) : array {
            $strQueryOneMovie = "SELECT movie.* 
                                FROM movie
                                WHERE movie_id = ".$intId."
                                ORDER BY movie_name ASC";
                            
                            
            $arrOneMovie = $this->_db->query($strQueryOneMovie)->fetch();
            return $arrOneMovie;
        }

        /*
        * Récupération des 6 derniers films sortis 
        * @return array $arrMovieDisplay
        */
        public function movieList(bool $boolDisplay = true):array {
            $strQuery		=   "SELECT movie_name, movie_poster, movie_id  
                            FROM movie
                            WHERE  movie_name LIKE '%".$this->strKeyword."%'";
            if ($boolDisplay){
                $strQuery		.= " AND movie_display IS NOT NULL
                                    ORDER BY movie_display DESC";
            } else {
            $strQuery		.= " ORDER BY movie_creation_date DESC";
            }
            $strQuery		.= " LIMIT 6 OFFSET 0;";
                            //var_dump($strQuery);
            $arrMovieDisplay	= $this->_db->query($strQuery)->fetchAll();
            return $arrMovieDisplay;
        }

        /*
        * Récupération des 6 derniers films ajoutés 
        * @return array $arrMovieRecentAdd
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
         * @return boole
         */
        public function addMovie($objMovieEntity) : bool{
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

                //var_dump($prep->debugDumpParams());
                $prep->execute();
            }catch(PDOExeption $e){
                return false;
            }
            return true;
        } 
        /**
        *   Public function playActor ()
        * @return boole
        */
        public function playActor($intActor) : bool{
            try{
                $strQuery = "INSERT INTO 
                    play (play_actor_id, play_movie_id) 
                    VALUES (:play_actor_id, :play_movie_id)"; 

                $lastMovieId = $this->_db->lastInsertId();  // prend le dernier ID de movie
                //$intActor = $_POST['actor'];                // prendre l'ID de l'acteur de $_POST['actor']

                $prep = $this->_db->prepare($strQuery); 
        
                $prep->bindValue(":play_actor_id",    $intActor, PDO::PARAM_STR);
                $prep->bindValue(":play_movie_id",    $lastMovieId, PDO::PARAM_STR);

                $prep->execute();
            }catch(PDOExeption $e){
                return false;
            }
            return true;
        }
       
       
        /**
         * Function pour select id de category
         * @return int 
        */
        public function infoCategory(){
            $strQuery      = "SELECT cat_id, cat_name 
                                FROM category;";

            $arrActors = $this->_db->query($strQuery)->fetchAll();

            return $arrActors;
        }
        
        /**
        *   Public function categoryMovie ()
        * @return boole
        */
        public function categoryMovie($intCategory) : bool{
            try{
                $strQuery = "INSERT INTO 
                    play (bel_cat_id, bel_movie_id) 
                    VALUES (:bel_cat_id, :bel_movie_id)"; 

                $lastCategoryMovie = $this->_db->lastInsertId();  // prend le dernier ID de movie
                //$intActor = $_POST['actor'];                // prendre l'ID de l'acteur de $_POST['actor']

                $prep = $this->_db->prepare($strQuery); 
        
                $prep->bindValue(":bel_cat_id",     $intActor, PDO::PARAM_STR);
                $prep->bindValue(":bel_movie_id",   $lastCategoryMovie, PDO::PARAM_STR);

                $prep->execute();
            }catch(PDOExeption $e){
                return false;
            }
            return true;
        }


        /**
         * Function pour edit movie
         * OPTIONEL
         */
        public function editMovie(){
            /* $strQuery = "UPDATE movie
                        SET movie_poster='les_tuches.jpg', movie_name='Juan', movie_desc='Juan is one of the best', movie_release='2025-01-01'
                        WHERE movie_id=51;";

            $prep = $this->_db->prepare($$strQuery);

            $prep->execute();
            */
        }
            
    }