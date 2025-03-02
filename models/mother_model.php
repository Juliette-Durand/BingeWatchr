<?php
 	/**
	* Entité mère
	* @author Arlind Halimi
	*/	
	class MotherModel{
		
		protected object $_db; /**< Variable de connexion à la base de données */
		
		public function __construct(){
			try{
				// Connexion à la base de données
				$this->_db = new PDO(
								"mysql:host=localhost;dbname=bingewatchr",  // Serveur et BDD
								"root",  		//Nom d'utilisateur de la base de données
								"",	 	// Mot de passe de la base de données
								array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC) // Mode de renvoi 
								); 
				// Pour résoudre les problèmes d’encodage
				$this->_db->exec("SET CHARACTER SET utf8"); 	
				// Configuration des exceptions
				$this->_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
			} catch(PDOException $e) { 
				echo "Échec : " . $e->getMessage(); 
			}
		}
	}