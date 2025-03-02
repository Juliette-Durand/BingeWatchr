<?php
    use Smarty\Smarty;
    
    /**
     * Controleur parent de tous les autres controleurs
     * @author Juliette Durand
     */

    class MotherCtrl{
        
        protected array     $_arrData = array(); /**< Tableau clé/valeur regroupant les données retournées par les controllers et utilisées dans les views */
        protected array 	$_arrErrors 	= array();
	    protected string 	$_strSuccess 	= "";
	    protected string 	$_strError   	= "";

        /**
         * Constructeur de la classe
         */
        public function __construct(){
        }


        /** 
		* Fonction permettant l'affichage d'une page avec Smarty
		*/
        public function display(string $strView, bool $boolDisplay=true) {
            $objSmarty = new Smarty();

            foreach($this->_arrData as $key=>$value) {
                $objSmarty->assign($key, $value);
            }

            // Donner le tableau des erreurs (construit dans les controllers) au template
			$objSmarty->assign("arrErrors", $this->_arrErrors);
            $objSmarty->assign("strSuccess", $_SESSION['success']??$this->_strSuccess);
            $objSmarty->assign("strError", $_SESSION['error']??$this->_strError);

            if($boolDisplay) {

                unset($_SESSION['success']);
                unset($_SESSION['error']);
                $objSmarty->display("views/".$strView.".tpl");
            } else {
                return $objSmarty->fetch("views/".$strView.".tpl");
            }
        }
    }