<?php 
    /**
	* Classe d'un Movie
	* @author Arlind Halimi
	*/
    require_once('mother_entity.php');

    class MovieEntity extends MotherEntity{

        /**
		* Constructeur de la classe
		*/
		public function __construct(){
			parent::__construct();
			$this->_prefixe = 'movie';
		}
        
        private string $_name;
        private string $_desc;
        private string $_release;
        private string $_create_date;
        private string $_poster;
        private $_pegi;
        private $_display;
        private string $_duration;

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
		* @param string $strName
		*/
        public function setName(string $strName){
            $this->_name = $strName;
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
		* @param string $strDesc
		*/
        public function setDesc(string $strDesc){
            $this->_desc = $strDesc;
        }

        /**
		* Récupération du date de Realise
		* @return string date de Realise
		*/
        public function getRelease(){
            return $this->_release;
        }
        /**
		* Mise à jour du date de Realise
		* @param string $strRelease
		*/
        public function setRelease(string $strRelease){
            $this->_release = $strRelease;
        }

        /**
		* Récupération du date de entre de la BDD
		* @return string date de entre de la BDD
		*/
        public function getCreation_date(){
            return $this->_creation_date;
        }
        /**
		* Mise à jour du date de entre de la BDD
		* @param string $strCreateDate
		*/
        public function setCreation_date(string $strCreateDate){
            $this->_creation_date = $strCreateDate;
        }


        /**
		* Récupération du film image
		* @return string film image
		*/
        public function getPoster(){
            return $this->_poster;
        }
        /**
		* Mise à jour du film image
		* @param string $strPoster
		*/
        public function setPoster(string $strPoster){
            $this->_poster = $strPoster;
        }

        /**
		* Récupération du film image
		* @return string film image
		*/
        public function getPegi(){
            return $this->_pegi;
        }
        /**
		* Mise à jour du film image
		* @param string film image
		*/
        public function setPegi(string|null $strPegi = NULL){
            $this->_pegi = $strPegi;
        }
        /**
        * Récupération du display
        * @return string display
        */
        public function getDisplay(){
            return $this->_display;
        }

        /**
        * Mise à jour du display
        * @param string $strDisplay ou NULL
        */
        public function setDisplay(string|null $strDisplay = NULL){
            //if(){}
            $this->_display = $strDisplay;
        }

        /**
		* Récupération du film duration
		* @return string film duration
		*/
        public function getDuration(){
            return $this->_duration;
        }
        /**
		* Mise à jour du film duration
		* @param string $strDuration
		*/
        public function setDuration(string $strDuration){
            $this->_duration = $strDuration;
        }

        /**
         * Récupération de la date de sortie en format français
         * @return string Date / Mois / Année
         */
        public function getDateFr(){
            $strDate = $this->getRelease();
            $strDateFr = date('d/m/Y', strtotime($strDate));
            return $strDateFr;
        } 
    }