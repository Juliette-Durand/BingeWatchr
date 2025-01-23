<?php
	/**
	* Entité mère
	* @author Juliette Durand
	*/
	class MotherEntity{
		
		protected string $_prefixe;
		protected mixed $_id = 0;
		
		public function __construct(){
		}
		
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
		* @return int l'identifiant
		*/
		public function getId():int|string{
			return $this->_id;
		}
		/**
		* Mise à jour de l'id
		* @param int l'identifiant
		*/
		
		public function setId(int|string $mixId) {
			
			$this->_id = $mixId;
		}
		
	}