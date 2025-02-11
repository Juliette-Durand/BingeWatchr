<?php
    /**
     * Point d'entrée de toutes les pages du site
     * @author Juliette Durand
     * Créé le 28/01/2025 - Dernière modification le 28/01/2025 par Juliette Durand
     */

    // Inclusion du fichier user_entity pour qu'il soit disponible constamment
    // -> Utilisation perpétuelle dans le header quand l'utilisateur est connecté
    require_once("entities/user_entity.php");

    // Activation de l'accès au $_SESSION sur toutes les pages
    session_start();

    // var_dump($_SESSION);

    // Récupération des informations dans l'url
    $strController  = $_GET['ctrl']??"movie";
    $strAction      = $_GET['action']??"home";

    // Appel du controleur
    require_once("controllers/mother_controller.php");
    require_once("controllers/".$strController."_controller.php");

    // Construction du nom du controleur
    $strCtrlName    = ucfirst($strController)."Ctrl";
    // Instanciation du controleur
    $objController  = new $strCtrlName();
    // Appel de la méthode
    $objController->$strAction();