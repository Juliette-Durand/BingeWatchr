<?php 
    /**
	* Classe d'un comment
	* @author Juliette Durand
    * Créé le : 13/02/2025 - Dernière modification le 13/02/2025
	*/
    require_once('mother_entity.php');
    class PictureEntity extends MotherEntity {

        public function __construct() {
            parent::__construct();
            $this->_prefixe = 'pic';
        }
        
        private string $_file;
        private int $_comment_id;

        /**
		* Récupération du nom de fichier
		* @return string _file
		*/
        public function getFile(){
            return $this->_file;
        }
        /**
		* Mise à jour du nom de fichier
		* @param string $strTitle nom du fichier
		*/
        public function setFile(string $file){
            $this->_file = $file;
        }
        
        /**
		* Récupération de l'id du commentaire
		* @return int _comment_id
		*/
        public function getComment_id(){
            return $this->_comment_id;
        }
        /**
		* Mise à jour de l'id du commentaire
		* @param int $intComm id du commentaire
		*/
        public function setComment_id(int $intComm){
            $this->_comment_id = $intComm;
        }
    }