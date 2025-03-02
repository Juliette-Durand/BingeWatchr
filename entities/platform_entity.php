<?php
	/**
	* Classe d'un article
	* @author Arlind Halimi
	*/
    require_once('mother_entity.php');

	class PlatformEntity extends MotherEntity{

        /**
		* Constructeur de la classe
		*/
		public function __construct(){
		    parent::__construct();
		}
        
        private $_name;
        private $_link;
        private $_logo;

        
        /**
		* Récupération du Name
		* @return string Name
		*/
        public function getName(){
            return $this->_name;
        }
        /**
		* Mise à jour du Name
		* @param string $strName
		*/
        public function setName(string $strName){
            $this->_name = $strName;
        }

        /**
		* Récupération du Link
		* @return string Link
		*/
        public function getLink(){
            return $this->_link;
        }
        /**
		* Mise à jour du Link
		* @param string $strLink
		*/
        public function setLink(string $strLink){
            $this->_link = $strLink;
        }

          /**
		* Récupération du Link
		* @return string Link
		*/
        public function getLogo(){
            return $this->_logo;
        }
        /**
		* Mise à jour du Link
		* @param string $strLogo
		*/
        public function setLogo(string $strLogo){
            $this->_logo = $strLogo;
        }


    }