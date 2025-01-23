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
		* @param string First Name
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
		* @param string Last Name
		*/
        public function setLast_name(string $strLastname){
            $this->_last_name = $strLastname;
        }

    }