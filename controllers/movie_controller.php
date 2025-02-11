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
         
         /*
         * Méthode pour l'affichage de la page principale
         * @return l'affichage de la page d'accueil
         */
         public function home() {
            
            require_once("entities/movie_entity.php");
            require_once("models/movie_model.php");
            

            // object pour Movie Model
            $objMovieModel = new MovieModel();

            //Utilisation (création d'un tableau contenant les infos de la requête)
            $arrMovie         = $objMovieModel->movieList();
            $arrRecentMovie   = $objMovieModel->movieList(false);

            // Transmission des variables dans la vue
            $this->_arrData['arrMovie'] = $arrMovie;
            $this->_arrData['arrRecentMovie'] = $arrRecentMovie;

            $this->display('home');
         }  
         
         /*
         * Méthode pour l'affichage de la page contenant tous les films de la BDD
         * @return l'affichage de la page 
         */
         public function allMovies() {

            require_once("entities/movie_entity.php");
            require_once("models/movie_model.php");
            require_once("entities/category_entity.php");
            require_once("models/category_model.php");

            // object pour Movie Model
            $objMovieModel                = new MovieModel();
            $objCatModel                  = new CategoryModel();
            $objMovieModel->strKeyword    = $_POST['keywords']??"";
            $objMovieModel->strStartDate  = $_POST['startdate']??"";
            $objMovieModel->strEndDate    = $_POST['enddate']??"";
            $objMovieModel->intStartTime  = $_POST['minduration']??0;
            $objMovieModel->intEndTime    = $_POST['maxduration']??0;
            $objMovieModel->arrCategory   = $_POST['cat']??[];

            //Utilisation
            $arrCat           = $objCatModel->findCategory();
            $arrAdvMovie      = $objMovieModel->advSearchMovie();

            // Transmission des variables dans la vue
            $this->_arrData['objMovieModel'] = $objMovieModel;
            $this->_arrData['arrCat']        = $arrCat;
            $this->_arrData['arrAdvMovie']   = $arrAdvMovie; 

            $this->display('all_movies');
         }
     }