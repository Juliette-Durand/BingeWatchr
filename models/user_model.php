<?php
	/**
	* Classe de gestion de la base de données pour les utilisateurs
	* @author Juliette Durand 
    * Créé le 28/01/2025 - Dernière modification le 11/02/2025 par Juliette Durand
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
		public function findAll(string $strKeyword = ""):array{
			
			/* J'écris ma requête */
			$strQuery 	= "	SELECT user_id, user_last_name, user_first_name, user_avatar, user_role
							FROM user";

			// Recherche de l'utilisateur par mot clé
			if($strKeyword != ""){
				$strQuery	.="	WHERE LOWER(user_id) LIKE LOWER('".$strKeyword."%')
								OR LOWER(user_first_name) LIKE LOWER('".$strKeyword."%')
								OR LOWER(user_last_name) LIKE LOWER('".$strKeyword."%')";
			}

			$strQuery	.="	ORDER BY user_last_name ASC, user_first_name ASC;";
	
			/* Je récupère le résultat de ma requête d'utilisateurs */
			$arrUsers	= $this->_db->query($strQuery)->fetchAll();
			
			return $arrUsers;
		}
		
		/**
		* Récupération des données d'un utilisateur via son id
		* @return array Tableau des infos de l'utilisateur
		*/
		public function displayUser($strId):array{		
			/* J'écris ma requête */
			$strQuery 	= "	SELECT user_id, user_first_name, user_last_name, user_mail, user_bio, user_password, user_avatar, user_role
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
			$strQuery	= "	SELECT user_id, user_mail, user_password, user_avatar, user_role
							FROM user
							WHERE user_mail = '".$strMail."';";
			$arrUser	=	$this->_db->query($strQuery)->fetch();

			if(($arrUser != false) && (password_verify($strPassword, $arrUser['user_password']))){
				unset($arrUser['user_password'], $arrUser['user_mail']);
				return $arrUser;
			}
			return false;
		}
		
		/**
		* Insertion des données d'un nouvel utilisateur lors de la création d'un compte
		* @return bool True si insertion réussie sinon False
		*/
		public function newUser(object $objUser, bool $boolAvatar):bool{
			try{
				/* Écriture de la requête */
				$strQuery	= "	INSERT INTO user (	user_id, user_first_name, user_last_name, user_mail, user_password,
													user_create_date, user_avatar, user_bio, user_role)
								VALUES (:id, :fname, :lname, :mail, :password, NOW(), :avatar, :bio,'user'); ";
				
				$prep	=	$this->_db->prepare($strQuery);
	
				$prep->bindValue(':id', $objUser->getId(), PDO::PARAM_STR);
				$prep->bindValue(':fname', $objUser->getFirst_name(), PDO::PARAM_STR);
				$prep->bindValue(':lname', $objUser->getLast_name(), PDO::PARAM_STR);
				$prep->bindValue(':mail', $objUser->getMail(), PDO::PARAM_STR);
				$prep->bindValue(':password', $objUser->getPwdHash(), PDO::PARAM_STR);
				$prep->bindValue(':bio', $objUser->getBio(), PDO::PARAM_STR);
				if ($boolAvatar === true){
					$prep->bindValue(':avatar', $objUser->getAvatar(), PDO::PARAM_STR);
				} else {
					$prep->bindValue(':avatar', "no_profile_pic.webp", PDO::PARAM_STR);
				}

				$prep->execute();
			}catch(PDOException $e) { 
				return false;
			} 
			return true;
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
				$prep->bindValue(':mail', $objUser->getMail(), PDO::PARAM_STR);
				$prep->bindValue(':bio', $objUser->getBio(), PDO::PARAM_STR);
				$prep->bindValue(':avatar', $objUser->getAvatar(), PDO::PARAM_STR);
				if ($boolPwd === true){
					$prep->bindValue(':password', $objUser->getPwdHash(), PDO::PARAM_STR);
				}
				
				//var_dump($prep->execute());
				//var_dump($prep->debugDumpParams());
				$prep->execute();
			}catch(PDOException $e) { 
				return false;
			} 
			return true;
		}

		/**
		* Suppression d'un compte utilisateur via son id
		* @return bool True si suppression réussie sinon False
		*/
		public function deleteAccount(string $strId):bool{
			try{
				/* Écriture de la requête */
				$strQuery	= "	DELETE FROM user
								WHERE user_id =:id;";
				
				$prep	=	$this->_db->prepare($strQuery);
				
				$prep->bindValue(':id', $strId, PDO::PARAM_STR);
				
				//var_dump($prep->execute());
				//var_dump($prep->debugDumpParams());
				$prep->execute();
			}catch(PDOException $e) { 
				return false;
			} 
			return true;
		}

		/**
		* Vérification de la présence d'une adresse email en base de donnée
		* @return bool True si une adresse existe sinon False
		*/
		public function verifMail(string $strEmail):bool{
			$strQuery	= "	SELECT user_mail
							FROM user
							WHERE user_mail = '".$strEmail."';";
			$arrUser	=	$this->_db->query($strQuery)->fetch();

			if($arrUser > 0){
				return true;
			}
			return false;
		}

		/**
		* Vérification de la présence d'un id en base de donnée
		* @return bool True si un id existe sinon False
		*/
		public function verifId(string $strId):bool{
			$strQuery	= "	SELECT user_id
							FROM user
							WHERE user_id = '".$strId."';";
			$arrUser	=	$this->_db->query($strQuery)->fetch();

			if($arrUser > 0){
				return true;
			}
			return false;
		}

		/**
		* Mise à jour du rôle d'un utilisateur
		* @return bool True si modification prise en compte sinon False
		*/
		public function updateRole(string $strRole, string $strId):bool{
			try{
				/* Écriture de la requête */
				$strQuery	= "	UPDATE user
								SET user_role = :role
								WHERE user_id = :id;";
				
				$prep	=	$this->_db->prepare($strQuery);

				$prep->bindValue(':role', $strRole, PDO::PARAM_STR);
				$prep->bindValue(':id', $strId, PDO::PARAM_STR);
				
				$prep->execute();
			}catch(PDOException $e) { 
				return false;
			} 
			return true;
		}

		public function displayAvatar(string $strId):array{
			$strQuery	= "	SELECT user_avatar
							FROM user
							WHERE user_id = '".$strId."';";
			$arrAvatar	=	$this->_db->query($strQuery)->fetch();

			return $arrAvatar;
		}

		/**
		 * Recherche du role d'un utilisateur
		 */
		public function checkRole(string $strId):array{
			$strQuery	= "	SELECT user_role AS 'role'
							FROM user
							WHERE user_id = '".$strId."';";
			
			$arrUser	=	$this->_db->query($strQuery)->fetch();

			return $arrUser;
		}
	}