<?php 
    /**
	* Classe d'un acteur
	* @author Arlind Halimi
	*/
    class MotherEntity{
        public function __construct(){}
        
          /**
		* Récupération du id
		* @return integer id de acteur
		*/
        public function getId(){
            return $this->_id;
        }
        /**
		* Mise à jour du id
		* @param integer id
		*/
        public function setId(int $intId){
            $this->_id = $intId;
        }
    }