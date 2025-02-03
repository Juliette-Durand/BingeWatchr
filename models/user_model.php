<?php
	/**
	* Classe de gestion de la base de données pour les utilisateurs
	* @author Juliette Durand
	*/


	require_once("mother_model.php");
	

	class UserModel extends MotherModel{

		/**
		* Constructeur de la classe
		*/
		public function __construct(){
			parent::__construct();
		}

		/**
		* Récupération de tous les utilisateurs
		* @return array Tableau des utilisateurs de la bdd
		*/
		public function findAll():array{
			
			/* J'écris ma requête */
			$strQuery 	= "	SELECT *
							FROM user
							ORDER BY user_last_name ASC, user_first_name ASC;";
	
			/* Je récupère le résultat de ma requête d'utilisateurs */
			$arrUsers	= $this->_db->query($strQuery)->fetchAll();
			
			return $arrUsers;
		}
		
		/**
		* Récupération des données d'un utilisateur via son id
		* @return array Tableau des infos de l'utilisateur
		*/
		public function findUser($strId):array{		
			/* J'écris ma requête */
			$strQuery 	= "	SELECT *
							FROM user
							WHERE user_id = '".$strId."'
							ORDER BY user_last_name ASC, user_first_name ASC;";
	
			/* Je récupère le résultat de ma requête d'utilisateur */
			$arrOneUser	= $this->_db->query($strQuery)->fetch();
			
			return $arrOneUser;
		}

		/**
		* Récupération des données d'un utilisateur lors de la connexion et tests de correspondance de mot de passe
		* @return array|bool Tableau des utilisateurs de la bdd ou false
		*/
		public function loginUser($strMail, $strPassword):array|bool{
			$strQuery	= "	SELECT *
							FROM user
							WHERE user_mail = '".$strMail."';";
			$arrUser	=	$this->_db->query($strQuery)->fetch();

			if(($arrUser != false) && ($strPassword === $arrUser['user_password'])){
				unset($arrUser['user_password'], $arrUser['user_mail'], $arrUser['user_create_date']);
				return $arrUser;
			}
			return false;
		}
		
		/**
		* Insertion des données d'un nouvel utilisateur lors de la création d'un compte
		* @return bool True si insertion réussie sinon False
		*/
		public function newUser():bool{
			
			/* Écriture de la requête */
			$strQuery	= "	INSERT INTO user (	user_id, user_first_name, user_last_name, user_mail, user_password,
												user_create_date, user_avatar, user_bio, user_role)
							VALUES ('', '', '', '', '', NOW(), '', '','user'); ";
		}
		
		/**
		* Modification des données d'un utilisateur via son id
		* @return bool True si modification réussie sinon False
		*/
		public function changeInfos(object $objUser, bool $boolPwd):bool{
			try{
				/* Écriture de la requête */
				$strQuery	= "	UPDATE user
								SET user_first_name = :fname, user_last_name = :lname, user_mail = :mail, user_bio = :bio, user_avatar = :avatar";
				if ($boolPwd === true){
					$strQuery	.= ", user_password= :password";
				}
				$strQuery		.= " WHERE user_id=:id;";
				
				$prep	=	$this->_db->prepare($strQuery);
				
				$prep->bindValue(':id', $objUser->getId(), PDO::PARAM_STR);
				$prep->bindValue(':fname', $objUser->getFirst_name(), PDO::PARAM_STR);
				$prep->bindValue(':lname', $objUser->getLast_name(), PDO::PARAM_STR);
				$prep->bindValue(':mail', $objUser->getEmail(), PDO::PARAM_STR);
				$prep->bindValue(':bio', $objUser->getBio(), PDO::PARAM_STR);
				$prep->bindValue(':avatar', $objUser->getAvatar(), PDO::PARAM_STR);
				if ($boolPwd === true){
					$prep->bindValue(':password', $objUser->getPassword(), PDO::PARAM_STR);
				}
				
				//var_dump($prep->execute());
				//var_dump($prep->debugDumpParams());
				$prep->execute();
			}catch(PDOException $e) { 
				return false;
			} 
			return true;
		}
	}