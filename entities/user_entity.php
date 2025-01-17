<?php
	/**
	* Classe d'un utilisateur
	* @author Juliette Durand
	*/
	
	require_once('mother_entity.php');
	
	class UserEntity extends MotherEntity {
		
		/**
		* Initialisation des attributs
		*/
		private string $_last_name;
		private string $_first_name;
		private string $_email;
		private string $_password;
		private string $_create_date;
		private string $_avatar;
		private string $_bio;
		private string $_role;
		
		/**
		* Mise à jour de l'id
		*/
		public function setId(mixed $mixId) {
			if (!is_string($mixId)) {
				throw new TypeError("La classe Mother requiert un Id de type string");
			}
			$this->_id = $mixId;
		}
		
		/**
		* Récupération du nom
		* @return string _last_name
		*/
		public function getLast_name(){
			return $this->_last_name;
		}
		/**
		* Mise à jour du nom
		*/
		public function setLast_name(string $strName){
			$this->_name = $strName;
		}
		
		/**
		* Récupération du prénom
		* @return string _first_name
		*/
		public function getFirst_name():string{
			return $this->_first_name;
		}
		/**
		* Mise à jour du prénom
		*/
		public function setFirst_name(string $strFirstName){
			$this->_fName = $strFirstName;
		}
		
		public function getFull_name():string{
			$fullName = $this->getName()." ".$this->getFirstName();
			return $fullName;
		}
		
		/**
		* Récupération de l'email
		* @return string _email
		*/
		public function getEmail():string{
			return $this->_email;
		}
		/**
		* Mise à jour de l'email
		*/
		public function setEmail(string $strEmail){
			$this->_email = $strEmail;
		}
		
		/**
		* Récupération du mot de passe
		* @return string _password
		*/
		public function getPassword():string{
			return $this->_password;
		}
		/**
		* Mise à jour du mot de passe
		*/
		public function setPassword(string $strPwd){
			$this->_pwd = $strPwd;
		}
	}