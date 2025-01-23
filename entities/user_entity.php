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
		protected string $_id = '';
		private string $_last_name;
		private string $_first_name;
		private string $_email;
		private string $_password;
		private string $_create_date;
		private string $_avatar;
		private string $_bio;
		private string $_role;
		
		public function __construct(){
			parent::__construct();
			$this->_prefixe = 'user';
			$this->_id='';
		}
		
		/**
		* Récupération de l'id
		* @return string _id
		*/
		public function getId(){
			return $this->_id;
		}
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
			$this->_last_name = $strName;
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
			$this->_first_name = $strFirstName;
		}
		
		public function getFull_name():string{
			$fullName = $this->getLast_name()." ".$this->getFirst_name();
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
		public function setMail(string $strMail){
			$this->_email = $strMail;
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
			$this->_password = $strPwd;
		}
		
		/**
		* Récupération de la date de création
		* @return string _create_date
		*/
		public function getCreate_date():string{
			return $this->_create_date;
		}
		/**
		* Mise à jour de la date de création
		*/
		public function setCreate_date(string $strDate){
			$this->_create_date = $strDate;
		}
		
		/**
		* Récupération de l'avatar
		* @return string _avatar
		*/
		public function getAvatar():string{
			return $this->_avatar;
		}
		/**
		* Mise à jour de l'avatar
		*/
		public function setAvatar(string $strAvatar){
			$this->_avatar = $strAvatar;
		}
		
		/**
		* Récupération de la biographie
		* @return string _bio
		*/
		public function getBio():string{
			return $this->_bio;
		}
		/**
		* Mise à jour de l'avatar
		*/
		public function setBio(string $strBio){
			$this->_bio = $strBio;
		}
		
		/**
		* Récupération du rôle
		* @return string _role
		*/
		public function getRole():string{
			return $this->_role;
		}
		/**
		* Mise à jour du role
		*/
		public function setRole(string $strRole){
			$this->_role = $strRole;
		}
	}