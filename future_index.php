<?php
    /**
     * Point d'entrée de toutes les pages du site
     * @author Juliette Durand
     */

    // Inclusion du fichier user_entity pour qu'il soit disponible constamment
    // -> Utilisation perpétuelle dans le header quand l'utilisateur est connecté
    require_once("entities/user_entity.php");

    // Activation de l'accès au $_SESSION sur toutes les pages
    session_start();

    $strController  = $_GET['ctrl']