<?php 
    /**
	* Classe d'un acteur
	* @author Arlind Halimi
	*/
    require_once('mother_entity.php');
    class Actor extends MotherEntity {

        public function __construct() {
            parent::__construct();
        }

        private $_id;
        private $_first_name;
        private $_last_name;
        private $_picture;


        /**
		* Récupération du First Name
		* @return string First Name
		*/
        public function getFirstName(){
            return $this->_first_name;
        }
        /**
		* Mise à jour du First Name
		* @param string First Name
		*/
        public function setFirstName(string $strFirstname){
            $this->_first_name = $strFirstname;
        }

        /**
		* Récupération du Last Name
		* @return string Last Name
		*/
        public function getFirstName(){
            return $this->_last_name;
        }
        /**
		* Mise à jour du Last Name
		* @param string Last Name
		*/
        public function setFirstName(string $strLastname){
            $this->_last_name = $strLastname;
        }

    }