<?php
	/**
	* Classe de gestion de la base de données pour les utilisateurs
	* @author Arlind Halimi et Hugo
  * modifiée par Hugo le 31/01/2025
	*/


    require_once("mother_model.php");

    class MovieModel extends MotherModel{

        // Attributs pour la recherche
        public string $strKeyword = "";

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
            * Récupération des 6 derniers films à afficher 
            * @return tableau des films 
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
    }