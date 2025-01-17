<?php 
    /**
	* Classe d'un acteur
	* @author Arlind Halimi
	*/
    require_once('mother_entity.php');

    class ActorEntity extends MotherEntity {

        /**
		* Constructeur de la classe
		*/
		public function __construct(){
			parent::__construct();
		}

        private $_first_name;
        private $_last_name;
        private $_picture;


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
		* Récupération du Last Name
		* @return string Last Name
		*/
        public function getLastname(){
            return $this->_last_name;
        }
        /**
		* Mise à jour du Last Name
		* @param string Last Name
		*/
        public function setLastname(string $strLastname){
            $this->_last_name = $strLastname;
        }

        /**
		* Récupération du picture
		* @return string picture
		*/
        public function getPicture(){
            return $this->_picture;
        }
        /**
		* Mise à jour du picture
		* @param string picture
		*/
        public function setPicture(string $strPicture){
            $this->_picture = $strPicture;
        }
    }