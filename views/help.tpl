{**
 * Page contenant les aides
 * @author Hugo 
*}

{extends file="views/layout.tpl"}      

{block name="contenu"}

<h1>{$strTitle}</h1>

{** Pour les admins **}
{*if $_SESSION['user']|isset && $_SESSION['user']->getRole() == "user"*}
    
    <h2>Gestion des rôles</h2>
        <h3>Affilier un rôle</h3>
        <h3>Modifier un rôle</h3>

    <h2>Gestion des utilisateurs</h2>  
        <h3>Modifier les infos d'un utilisateur</h3>
        <h3>Supprimer un utilisateur</h3>
{*/if*}

{** Pour les modérateurs **}
    <h2>Gestion des commentaires</h2>  
        <h3>Modifier les commentaires</h3>
        <h3>Supprimer les commentaires</h3>
        <h3>Valider les commentaires contenant une photo</h3>
        <h3>Gérer la taille des photos</h3>
    
    <h2>Ajout de films</h2>  
        <h3>Créer un nouveau film</h3>
        <h3>Modifier la page d'un film</h3>
        <h3>Supprimer un film dans la Base de Données</h3>

{** Pour les utilisateurs **}
    <h2>Compte</h2>
    <h2>Connexion</h2>
    <h2>Demande d'ajout de film</h2>
    <h2>Recherche d'un film</h2>

{/block}