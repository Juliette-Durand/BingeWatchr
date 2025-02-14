<?php
    /**
     * Controleur parent de tous les autres controleurs
     * @author Juliette Durand
     */

    class MotherCtrl{
        
        protected array $_arrData = array(); /**< Tableau clé/valeur regroupant les données retournées par les controllers et utilisées dans les views */
        protected string $_strSuccess 	= "";
        /**
         * Constructeur de la classe
         */
        public function __construct(){
        }

        /**
         * Méthode permettant d'afficher chaque page avec head, contenu et footer en remplissant les données du tableau arrData
         * @param string $strView
         */
        public function display(string $strView){
            foreach($this->_arrData as $key=>$value){
                $$key   =   $value;
            }
            $strSuccess = $_SESSION['success']??"";
            unset($_SESSION['success']);
            if(isset($_SESSION['success'])){
            }
            include_once("views/_partial/head.php");
            include_once("views/".$strView.".php");
            include_once("views/_partial/footer.php");
        }
    }