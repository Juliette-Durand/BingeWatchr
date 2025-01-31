<?php
    /**
    * Page permettant de se déconnecter
    * @author Juliette Durand
    */
    session_start();
    session_destroy(); // La session est immédiatement effacée
    header("Location:index.php"); // L'utilisateur est redirigé vers la page d'accueil
?>