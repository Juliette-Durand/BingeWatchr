<?php
	/**
	* Entité mère
	* @author Juliette Durand
	*/
	class MotherEntity{
		
		protected string $_prefixe; /**< Variable préfixe des champs utilisée dans l'hydratation */
		protected mixed $_id = 0; /**< Variable d'id des tables de la base de données */
		
		/**
         * Constructeur de la classe
         */
		public function __construct(){
		}
		
		/**
		 * Fonction d'hydratation d'une classe permettant d'écrire automatiquement les setters de la classe et des les remplir
		 */
		public function hydrate($arrData){
			foreach ($arrData as $key=>$value){
				$strMethod = "set".ucfirst(str_replace($this->_prefixe.'_', '', $key));
				// On appel le setter uniquement s'il existe
				if(method_exists($this, $strMethod)){
					$this->$strMethod($value);
				}
			}
		}	
		
		/**
		* Récupération de l'id
		* @return int|string de l'identifiant (string pour les utilisateurs et int pour les autres)
		*/
		public function getId():int|string{
			return $this->_id;
		}
		/**
		* Mise à jour de l'id
		* @param int|string $mixId l'identifiant
		*/
		public function setId(int|string $mixId) {	
			$this->_id = $mixId;
		}
		
	}