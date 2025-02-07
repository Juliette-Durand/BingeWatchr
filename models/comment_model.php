<?php
	/**
	* Classe de gestion de la base de données pour les utilisateurs
	* @author Arlind Halimi et Hugo
    * date : 07/02/2025
	*/

    /**
     * require pour mother model
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
        * @return array Tableau des comments
        */
        public function allComments(){
            $strQuery = "SELECT comm_id, comm_title, comm_content, comm_date, comm_user_id 
                        FROM comment;";
            /* Je récupère le résultat de ma requête d'utilisateurs */
            $arrMovie  = $this->_db->query($strQueryMovie)->fetchAll();

            return $arrMovie;
        }

    }
