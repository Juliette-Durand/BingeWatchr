<?php
/*
* Classe pour gérer les catégories 
* @author Hugo Gomes
*/
class CategoryModel extends MOtherModel{
		
    /**
    * Constructeur de la classe
    */
    public function __construct(){
        parent::__construct();
    }
    
    public function findCategory() {
        $strQuery   = "SELECT cat_id, cat_name
                    FROM category;";
        $arrCat     = $this->_db->query($strQuery)->fetchAll();
        return $arrCat;
    }
    
}