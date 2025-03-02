<?php
    /**
     * Point d'entrée de toutes les pages du site
     * @author Juliette Durand
     * Créé le 28/01/2025 - Dernière modification le 28/01/2025 par Juliette Durand
     */
    
    // Autoloader Composer
	require('vendor/autoload.php');
    // Inclusion du fichier user_entity pour qu'il soit disponible constamment
    // -> Utilisation perpétuelle dans le header quand l'utilisateur est connecté
    require_once("entities/user_entity.php");

    // Activation de l'accès au $_SESSION sur toutes les pages
    session_start();

    // var_dump($_SESSION);

    // Récupération des informations dans l'url
    $strController  = $_GET['ctrl']??"movie";
    $strAction      = $_GET['action']??"home";

    $boolPb = false;

    // Appel du controleur
    require_once("controllers/mother_controller.php");
    $strFile = "controllers/".$strController."_controller.php";
    if (file_exists($strFile)) {
        require_once($strFile);
        // Construction du nom du controleur
        $strCtrlName    = ucfirst($strController)."Ctrl";
        if (class_exists($strCtrlName)) {
            // Instanciation du controleur
            $objController  = new $strCtrlName();
            if (method_exists($objController, $strAction)) {
                // Appel de la méthode
                $objController->$strAction(); 
            } else {
                $boolPb = true;
            }
        } else {
            $boolPb = true;
        }
    } else {
        $boolPb = true;
    }

    if ($boolPb) {
        header("Location:index.php?ctrl=error&action=error404");
    }

    
    
    