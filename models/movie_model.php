<?php
    require_once("mother_model.php");

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

        public string   $strKeyword     = ""; /**< Variable pour la recherche par mots-clés initialisée à chaîne de caractères vide si ce n'est pas renseigné */
        public string 	$strStartDate 	= ""; /**< Variable pour la recherche par date de début initialisée à chaîne de caractères vide si ce n'est pas renseigné */
		public string 	$strEndDate 	= ""; /**< Variable pour la recherche par date de fin initialisée à chaîne de caractères vide si ce n'est pas renseigné */
        public int      $intStartTime   = 0; /**< Variable pour la recherche par durée du film (debut) initialisée à 0 si ce n'est pas renseigné */
        public int      $intEndTime     = 0; /**< Variable pour la recherche par durée du film (fin) initialisée à 0 si ce n'est pas renseigné */
        public array    $arrCategory    = []; /**< Variable pour le tableau des catégories initialisée à tableau vide */
        public int 	    $intCategory = 0;

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
        public function findMovie(int $intId) : array|false {
            $strQueryOneMovie = "SELECT movie.* 
                                FROM movie
                                WHERE movie_id = ".$intId."
                                ORDER BY movie_name ASC";
                            
                            
            $arrOneMovie = $this->_db->query($strQueryOneMovie)->fetch();
            return $arrOneMovie;
        }
  
        /** 
        * Récupération des 6 derniers films à afficher 
        * @param bool $boolDisplay Booléen qui indique si le champs movie_display est NULL ou non
        * @return array tableau des films 
        */
        public function movieList(bool $boolDisplay = true):array {
            $strQuery		=   "SELECT movie_name, movie_poster, movie_id  
                            FROM movie";  
            if ($boolDisplay){
                $strQuery		.= " WHERE movie_display IS NOT NULL
                                        AND movie_display < DATE_ADD(movie_display, INTERVAL 4 WEEK)
                                        ORDER BY movie_display DESC";
            } else {
            $strQuery		.= " ORDER BY movie_creation_date DESC";
            }
            $strQuery		.= " LIMIT 6 OFFSET 0;";
            $arrMovieDisplay	= $this->_db->query($strQuery)->fetchAll();
            return $arrMovieDisplay;
        }

        /** 
        * Méthode pour la recherche de films par filtre avancé 
        * @return array tableau des films après exécution de la requête
        */
        public function advSearchMovie(bool $boolDisplay = false):array {
            $strQuery = "SELECT DISTINCT movie_name, movie_poster, movie_id
                        FROM movie
                            LEFT OUTER JOIN belong ON bel_movie_id = movie_id 
                            LEFT OUTER JOIN category ON cat_id = bel_cat_id";

            $strWhere = " WHERE";
            $arrCat = $_POST['cat']??[];  

            // Vérifier si des mots-clés sont renseignés
            if($this->strKeyword != "") {
                $strQuery .= $strWhere." movie_name LIKE '%".$this->strKeyword."%'";
                $strWhere = " AND";
            }
            
            // Vérifier si des catégories sont cochées 
            if(count($arrCat) > 0) {
                $strQuery .= $strWhere." bel_cat_id IN (".implode(",", $arrCat).")";
                $strWhere = " AND";
            }    
            
            // Vérifier si les dates sont renseignées
            if($this->strStartDate != "" && $this->strEndDate != "") {
                $strQuery .= $strWhere." movie_release BETWEEN '".$this->strStartDate."' AND '".$this->strEndDate."'";
                $strWhere = " AND";
            }

            // Vérifier si la durée est renseignée 
            if($this->intStartTime != 0 || $this->intEndTime != 0) {
                $strQuery .= $strWhere." TIME_TO_SEC(movie_duration)/60 BETWEEN ".$this->intStartTime." AND ".$this->intEndTime;
            }

            // Vérifier si le bool est false -> Afficher tous les films à l'affiche
            if($boolDisplay == true) {
                $strQuery		.= $strWhere." movie_display IS NOT NULL";
            }

            $strQuery .= " ORDER BY movie_creation_date DESC";
            $arrAdvMovie = $this->_db->query($strQuery)->fetchAll();
            return $arrAdvMovie;
        } 

        /**
         * Public function addMovie (string $strTitle, string $strTitle, string $strDate, string $strPhoto, string $strDuration)
         * @return boole ajoute un movie avec les informations fournies
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
        * Public function playActor Insert un actor et movie dans tableau play
        * @return boole 
        */
        
        public function playActor($intActor) : bool{
            try{
                $strQuery = "INSERT INTO 
                    play (play_actor_id, play_movie_id) 
                    VALUES (:play_actor_id, :play_movie_id)"; 

                $lastMovieId = $this->_db->lastInsertId();  // prend le dernier ID de movie
               
                $prep = $this->_db->prepare($strQuery); 
        
                $prep->bindValue(":play_actor_id",    $intActor, PDO::PARAM_INT);
                $prep->bindValue(":play_movie_id",    $lastMovieId, PDO::PARAM_INT);

                $prep->execute();
            }catch(PDOExeption $e){
                return false;
            }
            return true;
        }

        /**
         * Function pour select id de category
         * @return array des id de category avec le nom de la category
        */
        public function infoCategory() : array{
            $strQuery      = "SELECT cat_id, cat_name 
                                FROM category
                                ORDER BY cat_name ASC;";

            $arrActors = $this->_db->query($strQuery)->fetchAll();

            return $arrActors;
        }
        
        /**
        * Function categoryMovie insert dan table belong quel film dans quel categoy
        * @return boole
        */
        public function categoryMovie($idCategory) : bool{
            try{
                $strQuery = "INSERT INTO 
                
                    belong (bel_cat_id, bel_movie_id) /* id de category et dernier id de movie */
                    VALUES (:bel_cat_id, :bel_movie_id)"; 
        
                $lastMovieId = $this->_db->query("SELECT MAX(movie_id) AS last_movie_id FROM movie")->fetchColumn(); // prend le dernier ID de movie
                //$lastMovieId = $this->_db->lastInsertId();  
        
                $prep = $this->_db->prepare($strQuery); 
                
                $prep->bindValue(":bel_cat_id",     $idCategory, PDO::PARAM_INT);
                $prep->bindValue(":bel_movie_id",   $lastMovieId, PDO::PARAM_INT);
        
                $prep->execute();
            }catch(PDOExeption $e){
                return false;
            }
            return true;
        }


        /**
         * Requête pour dernier ID d'un film
         * @return array $intOneMovie Tableau des movies de la bdd
         */
        public function lastMovieId() : array{
            $strQueryOneMovie = "SELECT movie_id FROM movie 
                                    ORDER BY movie_id DESC
                                    LIMIT 1";
            
            $intOneMovie = $this->_db->query($strQueryOneMovie)->fetch();
            return $intOneMovie;
        }            
    }