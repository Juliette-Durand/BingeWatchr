<?php
    require_once("mother_model.php");
     
	/**
	* Classe de gestion de la base de données pour les photos associées aux commentaires
	* @author Juliette Durand
    * Créée le : 21/02/2025
	*/
    class PictureModel extends MotherModel{
        /**
        * Constructeur de la classe
        */
        public function __construct(){
            parent::__construct();
        }

        /**
         * Compte du nombre de photos déjà associées à un film dans les commentaires
         * @return int nombre de photos au total
         */
        public function countPictures(int $intId):int{
            $strQuery   = " SELECT COUNT(*) AS 'nbPic'
                            FROM picture
                                INNER JOIN comment ON pic_comment_id = comm_id
                                INNER JOIN movie ON comm_movie_id = movie_id
                            WHERE movie_id = ".$intId.";";
            
            /* Récupération d'un tableau ayant une seule colonne contenant le nombre de photos associées au film */
            $arrCount = $this->_db->query($strQuery)->fetch();

            /* Retourne le nombre de photos existantes + le nombre de photos importées */
            return $arrCount['nbPic'];
        }

        /**
         * Insertion des photos en BDD
         * @return bool insertion
         */
        public function addPicture(object $objPicture):bool{
            try{
                $strQuery   = " INSERT INTO picture(pic_file,pic_comment_id)
                                VALUES (:pic_file,:comm_id);";

                $prep = $this->_db->prepare($strQuery); 

                $prep->bindValue(":pic_file",  $objPicture->getFile(), PDO::PARAM_STR);
                $prep->bindValue(":comm_id",   $objPicture->getComment_id(), PDO::PARAM_INT);

                $prep->execute();

            }catch(PDOExeption $e){
                return false;
            }
            return true;
        }

        /**
         * Récupération du tableau de photos associées à un commentaire
         * @return array|bool Tableau des photos, sinon false
         */
        public function findPictures(int $intComment):array|bool{
            $strQuery   = " SELECT pic_file
                            FROM picture
                            WHERE pic_comment_id = ".$intComment.";";

            /* Récupération du tableau des photos associées au commentaire */
            $arrPictures = $this->_db->query($strQuery)->fetchAll();

            if(count($arrPictures)>0){
                return $arrPictures;
            } else {
                return false;
            }
        }

        /**
         * Suppression de toutes les photos liées à un commentaire
         * @return bool résultat de la suppression
         */
        public function deletePictures(int $intComment):bool{
            // Requête
            try{
                $strQuery   = " DELETE FROM picture
                                WHERE pic_comment_id = :id;";
                
                $prep = $this->_db->prepare($strQuery);
                $prep->bindValue(":id", $intComment, PDO::PARAM_INT);

                $prep->execute();

            } catch (PDOException $e){
                return false;
            }
            return true;
        }
    }
