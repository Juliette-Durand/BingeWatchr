<?php 
    /**
	* Classe d'un acteur
	* @author Arlind Halimi
	*/
    require_once('mother_entity.php');
    class ActorEntity extends MotherEntity {

        public function __construct() {
            parent::__construct();
            $this->_prefixe = 'actor';
        }

        private $_first_name;
        private $_last_name;
        private $_picture;

        /**
		* Récupération du First Name
		* @return string First Name
		*/
        public function getFirst_name(){
            return $this->_first_name;
        }
        /**
		* Mise à jour du First Name
		* @param string $strFirstname First Name
		*/
        public function setFirst_name(string $strFirstname){
            $this->_first_name = $strFirstname;
        }

        /**
		* Récupération du Last Name
		* @return string Last Name
		*/
        public function getLast_name(){

            return $this->_last_name;
        }
        /**
		* Mise à jour du Last Name
		* @param string $strLastname Last Name
		*/
        public function setLast_name(string $strLastname){
            $this->_last_name = $strLastname;
        }
        /**
		* Récupération du Picture d'acteur
		* @return string Picture d'acteur
		*/
        public function getPicture(){
            return $this->_picture;
        }
        /**
		* Mise à jour du Picture d'acteur
		* @param string $strPicture Picture d'acteur
		*/
        public function setPicture(string $strPicture){
            $this->_picture = $strPicture;
        }


    }