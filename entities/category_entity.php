<?php 
    /**
	* Classe d'un category
	* @author Arlind Halimi
	*/
    require_once('mother_entity.php');

    class CategoryEntity extends MotherEntity {

        private $_name;
        
        /**
		* Constructeur de la classe
		*/
		public function __construct(){
			parent::__construct();
		}

        /**
         * Class have the name on Category_entity and on Movie_entity
         * Can we use like this or to add in Mother_Entity
         */

        /**
		* Récupération du Name
		* @return string Name
		*/
        public function getName(){
            return $this->_name;
        }
        /**
		* Mise à jour du Name
		* @param string Name
		*/
        public function setName(string $strName){
            $this->_name = $strName;
        }
    }