<?php
    use Smarty\Smarty;
    
    /**
     * Controleur parent de tous les autres controleurs
     * @author Juliette Durand
     */

    class MotherCtrl{
        
        protected array $_arrData = array(); /**< Tableau clé/valeur regroupant les données retournées par les controllers et utilisées dans les views */
        protected array 	$_arrErrors 	= array();
		protected string 	$_strSuccess 	= "";

        /**
         * Constructeur de la classe
         */
        public function __construct(){
        }

        /**
         * Méthode permettant d'afficher chaque page avec head, contenu et footer en remplissant les données du tableau arrData
         * @param string $strView
         */
        public function display_old(string $strView){
            foreach($this->_arrData as $key=>$value){
                $$key   =   $value;
            }
            include_once("views/_partial/head.php");
            include_once("views/".$strView.".php");
            include_once("views/_partial/footer.php");
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
			$objSmarty->assign("strSuccess", $this->_strSuccess);

            if($boolDisplay) {
                $objSmarty->display("views/".$strView.".tpl");
            } else {
                return $objSmarty->fetch("views/".$strView.".tpl");
            }
        }
    }