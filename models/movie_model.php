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


        public function findMovie() : array {
            $strQueryOneMovie = "SELECT *  /* Këtu kërkojmë të gjitha kolonat */
                                FROM movie
                                WHERE movie_name = 'Les tuches'
                                ORDER BY movie_name ASC";
                                
            $arrOneMovie = $this->_db->query($strQueryOneMovie)->fetchAll();
            return $arrOneMovie;
        }






        
            /*
            * Récupération des 6 derniers films sortis 
            * @return tableau des films 
            */
            public function movieDisplay():array {
                $strQuery		=   "SELECT movie_name, movie_poster  
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
                $strQuery		=   "SELECT movie_name, movie_poster  
                                FROM movie
                                ORDER BY movie_creation_date DESC
                                LIMIT 6 OFFSET 0;";
                                
            $arrMovieRecentAdd	= $this->_db->query($strQuery)->fetchAll();
            return $arrMovieRecentAdd;
            }

    }