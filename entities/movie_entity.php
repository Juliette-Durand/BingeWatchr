<?php 
    /**
	* Classe d'un Movie
	* @author Arlind Halimi
	*/
    require_once('mother_entity.php');
    
    class Movie extends MotherEntity{

        public function __construct() {
            parent::__construct();
        }
        
        private $_id;
        private $_name;
        private $_desc;
        private $_release;
        private $_create_date;
        private $_poster;
        private $_pegi;
        private $_display;
        private $_duration;

       

        /**
		* Récupération du First Name
		* @return string First Name
		*/
        public function getFirstname(){
            return $this->_first_name;
        }
        /**
		* Mise à jour du First Name
		* @param string First Name
		*/
        public function setFirstname(string $strFirstname){
            $this->_first_name = $strFirstname;
        }

        /**
		* Récupération du Desctiption
		* @return string Desctiption
		*/
        public function getDesc(){
            return $this->_desc;
        }
        /**
		* Mise à jour du Desctiption
		* @param string Desctiption
		*/
        public function setDesc(string $strDesc){
            $this->_desc = $strDesc;
        }

         /**
		* Récupération du date de Realise
		* @return string date de Realise
		*/
        public function getRealise(){
            return $this->_release;
        }
        /**
		* Mise à jour du date de Realise
		* @param string date de Realise
		*/
        public function setRealise(string $strRelease){
            $this->_release = $strDesc;
        }

        /**
		* Récupération du date de Realise
		* @return string date de Realise
		*/
        public function getCreatedaten(){
            return $this->_create_date;
        }
        /**
		* Mise à jour du date de Realise
		* @param string date de Realise
		*/
        public function setCreatedate(string $strCreateDate){
            $this->_create_date = $strCreateDate;
        }


        /**
		* Récupération du film image
		* @return string film image
		*/
        public function getPostern(){
            return $this->_poster;
        }
        /**
		* Mise à jour du film image
		* @param string film image
		*/
        public function setPoster(string $strPoster){
            $this->_poster = $strPoster;
        }

        /**
		* Récupération du film image
		* @return string film image
		*/
        public function getDesctiption(){
            return $this->_pegi;
        }
        /**
		* Mise à jour du film image
		* @param string film image
		*/
        public function setPegi(string $strPegi){
            $this->_pegi = $strPegi;
        }


    }