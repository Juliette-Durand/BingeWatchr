<?php
	/**
	* Classe de gestion de la base de données pour les utilisateurs
	* @author Arlind Halimi et Juliette Durand
    * date : 07/02/2025
    * Dernière modification le 12/02/2025 par Juliette
	*/

    /**
     * require once mother model et comment entity
     */
    require_once("mother_model.php");
    require_once("entities/comment_entity.php");
    
    class CommentModel extends MotherModel{
        /**
        * Constructeur de la classe
        */
        public function __construct(){
            parent::__construct();
        }
        
        /**
         * Ajoute les Comments
         * @return bool true ou false 
         */
        public function addComment(object $objCommentEntity):bool{
            //var_dump($objCommentEntity->getId());
            try{
                
                // $objMovie = new MovieEntity();
                $strQuery = " INSERT INTO comment (comm_movie_id, comm_user_id, comm_title, comm_date, comm_content)
                                            VALUE(:comm_movie_id,:comm_user_id,:comm_title,NOW(),:comm_content)";
                $prep = $this->_db->prepare($strQuery); 
                $prep->bindValue(":comm_movie_id",  $objCommentEntity->getMovie_id(), PDO::PARAM_INT);
                $prep->bindValue(":comm_user_id",   $objCommentEntity->getUser_id(), PDO::PARAM_STR);
                $prep->bindValue(":comm_title",     $objCommentEntity->getTitle(), PDO::PARAM_STR);
                $prep->bindValue(":comm_content",   $objCommentEntity->getContent(), PDO::PARAM_STR);

                $prep->execute();
                
                //var_dump($prep->debugDumpParams());   die; 
            }catch(PDOExeption $e){
                return false;
            }
            return true;
        }

        /**
        * Récupération de tous les Comments
        * @return array $arrComments tableau des comments
        */
        public function allComments(){
            $strQuery = "SELECT comm_id, comm_title, comm_content, comm_date, comm_user_id 
                        FROM comment
                        WHERE comm_movie_id= ".$_GET['id']."
                        ORDER BY comm_date DESC
                        LIMIT 3;";

            /* Je récupère le résultat de ma requête d'utilisateurs */
            $arrComments  = $this->_db->query($strQuery)->fetchAll();

            return $arrComments;
        }

        /**
		 * Chérche avatad de une user pour fiche de comments
		 * @return string $strOneUser avatar user
		 */
		public function findAvatarUser($user_id):string{		
			/* J'écris ma requête */
			$strQuery 	= "	SELECT user_avatar
							FROM user
							WHERE user_id = '".$user_id."';";
	
			/* Je récupère le résultat de ma requête d'utilisateur */
			$strOneUser	= $this->_db->query($strQuery)->fetch();
			
			return $strOneUser ['user_avatar'];
		}

        // Juliette - 12/02/2025
        /**
         * Compte du nombre de photos déjà associées à un film
         * @return int nombre de photos au total
         */
        public function countPictures(int $intId, int $intPicImport = 0):int{
            $strQuery   = " SELECT COUNT(*) AS 'nbPic'
                            FROM picture
                                INNER JOIN comment ON pic_comment_id = comm_id
                                INNER JOIN movie ON comm_movie_id = movie_id
                            WHERE movie_id = ".$intId.";";
            
            /* Récupération d'un tableau ayant une seule colonne contenant le nombre de photos associées au film */
            $arrCount = $this->_db->query($strQuery)->fetch();

            /* Retourne le nombre de photos existantes + le nombre de photos importées */
            return ($arrCount['nbPic']+$intPicImport);
        }
    }
