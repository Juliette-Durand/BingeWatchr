<?php
	/**
	* Classe de gestion de la base de données pour les utilisateurs
	* @author Arlind Halimi
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
            $strQueryMovi 	= "	SELECT *
                                FROM movie
                                ORDER BY movie_namee ASC;";
            var_dump($strQueryMovi);

			/* Je récupère le résultat de ma requête d'utilisateurs */
            $arrMovie  = $this->_db->query($strQueryMovie)->fetchAll();

            return $arrMovie;
        }
        /* Requête pour trouve un film specifique */
        public function findMovie() : array{
            $strQueryOneMovie ="SELECT * 
                                FROM movie 
                                WHERE movie_name = 'Les tuches' 
                                ORDER BY movie_name ASC, movie_release ASC"; 

            /** Le variable $arrOneMovie récupère le résultat de requête $strQueryOneMovie */
            $arrOneMovie = $this->_db->query($strQueryOneMovie)->fetchAll();

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
                    $strQuery		.= " AND movie_display IS NOT NULL";

                }

                $strQuery		.= " ORDER BY movie_display DESC
                                LIMIT 6 OFFSET 0;";
                                //var_dump($strQuery);
                $arrMovieDisplay	= $this->_db->query($strQuery)->fetchAll();
                return $arrMovieDisplay;
            }
    }