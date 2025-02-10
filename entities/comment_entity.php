<?php 
    /**
	* Classe d'un comment
	* @author Arlind Halimi
    * date : 07/02/2025
	*/
    require_once('mother_entity.php');
    class CommentEntity extends MotherEntity {

        public function __construct() {
            parent::__construct();
            $this->_prefixe = 'comm';
        }
        
        private $_title;
        private $_content;
        private $_date;
        private $_user_id;
        private $_movie_id;

        /**
		* Récupération du titre de comment
		* @return string titre de comment
		*/
        public function getTitle(){
            return $this->_title;
        }
        /**
		* Mise à jour du titre de comment
		* @param string $strTitle titre de comment
		*/
        public function setTitle(string $strTitle){
            $this->_title = $strTitle;
        }

        /**
		* Récupération du content de comment
		* @return string content de comment
		*/
        public function getContent(){
            return $this->_content;
        }
        /**
		* Mise à jour du content de comment
		* @param string $strComment content de comment
		*/
        public function setContent(string $strComment){
            $this->_content = $strComment;
        }

        /**
		* Récupération date du content
		* @return string date du content
		*/
        public function getDate(){
            return $this->_date;
        }
        /**
		* Mise à jour date du content
		* @param string $strDate date du content
		*/
        public function setDate(string $strDate){
            $this->_date = $strDate;
        }

        
        /**
		* Récupération user id
		* @return string user id
		*/
        public function getUser_id(){
            return $this->_user_id;
        }
        /**
		* Mise à jour du user id
		* @param string $strUser_id user id
		*/
        public function setUser_id(string $strUser_id){
            $this->_user_id = $strUser_id;
        }

        /**
		* Récupération du film id
		* @return string film id
		*/
        public function getMovie_id(){
            return $this->_movie_id;
        }
        /**
		* Mise à jour du film id
		* @param string $strMovie_id film id
		*/
        public function setMovie_id(string $strMovie_id){
            $this->_movie_id = $strMovie_id;
        }
    }