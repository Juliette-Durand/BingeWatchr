<?php
    /**
     * Controleur enfant de MotherController pour la gestion des films
     * @author Hugo Gomes
     * Créé le 31/01/2025 par Hugo Gomes
     */

     require_once("mother_controller.php");
    
     class MovieCtrl extends MotherCtrl{

         /**
         * Constructeur
         */
         public function __construct() {
            parent::__construct();  
         }

         public function home() {
            
            require_once("entities/movie_entity.php");
            require_once("models/movie_model.php");

            // object pour Movie Model
            $objMovieModel = new MovieModel();
            $objMovieModel->strKeyword = $_POST['keywords']??"";

            //Utilisation (création d'un tableau contenant les infos de la requête)
            $arrMovie         = $objMovieModel->movieList();
            $arrRecentMovie   = $objMovieModel->movieList(false);

            $this->_arrData['arrMovie'] = $arrMovie;
            $this->_arrData['arrRecentMovie'] = $arrRecentMovie;
            $this->_arrData['objMovieModel'] = $objMovieModel;

            $this->display('home');
         }      
     }