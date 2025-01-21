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
			$strQueryUsers 	= "	SELECT *
								FROM user
								ORDER BY user_last_name ASC, user_first_name ASC;";
	
			/* Je récupère le résultat de ma requête d'utilisateurs */
			$arrUsers	= $this->_db->query($strQueryUsers)->fetchAll();
			
			return $arrUsers;
		}
		
		/**
		* Récupération des données d'un utilisateur
		* @return array Tableau des utilisateurs de la bdd
		*/
		public function findUser():array{
			
			/* J'écris ma requête */
			$strQueryOneUser 	= "	SELECT *
									FROM user
									WHERE user_id = 'SuperPoulet'
									ORDER BY user_last_name ASC, user_first_name ASC;";
	
			/* Je récupère le résultat de ma requête d'utilisateurs */
			$arrOneUser	= $this->_db->query($strQueryOneUser)->fetch();
			
			return $arrOneUser;
		}
		
		/**
		*
		*/
		public function newUser(){
			
			/* Écriture de la requête */
			$strQueryNewUser	= "	INSERT INTO user (	user_id, user_first_name, user_last_name, user_mail, user_password,
														user_create_date, user_avatar, user_bio, user_role)
									VALUES ('', '', '', '', '', NOW(), '', '','user'); ";
		}
	}