<?php

include_once("head.php");
// Récupérer les informations du $_POST et $_FILES
$strFirst_name = $_POST['first_name'] ?? "";
$strLast_name = $_POST['last_name'] ?? "";
$strMail = $_POST['mail'] ?? "";
$strPassword = $_POST['password'] ?? "";
$strBio = $_POST['bio'] ?? "";
$strAvatar = $_FILES['avatar'] ?? "";

//var_dump($_POST);
//var_dump($strAvatar);

// Initialisation du tableau des erreurs
$arrErrors = array();

// Le formulaire est envoyé
if (count($_POST) > 0) {

    // Vérifier le contenu de $strFirst_name
    if ($strFirst_name == "") {
        $arrErrors['first_name'] = "La zone Prénom est obligatoire";
    }

    // Vérifier le contenu de $strLast_name
    if ($strLast_name == "") {
        $arrErrors['last_name'] = "La zone Nom est obligatoire";
    }

    // Vérifier le contenu de $strMail
    if ($strMail == "") {
        $arrErrors['mail'] = "La zone E-mail est obligatoire";
    }

    // Vérifier le contenu de $strPassword
    if ($strPassword == "") {
        $arrErrors['password'] = "La zone Mot de passe est obligatoire";
    }

    // Vérifier le contenu de $strBio
    if ($strBio == "") {
        $arrErrors['bio'] = "La zone Biographie est obligatoire";
    }

    // Vérifier le contenu de $strAvatar
    if ($strAvatar == "") {
        $arrErrors['avatar'] = "L'avatar est obligatoire";
    }

    // Si aucune erreur, traitement (par exemple, insertion en BDD)
    if (count($arrErrors) == 0) {
        // => Formulaire valide, insérer en BDD ou autre traitement
    }
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire d'inscription BingeWatchr</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <!-- Formulaire d'inscription -->
        <form name="formRegister" method="post" action="" enctype="multipart/form-data">
            <legend>Formulaire d'inscription BingeWatchr</legend>

            <!-- Affichage des erreurs -->
            <?php
            if (isset($arrErrors['first_name'])) { ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $arrErrors['first_name']; ?>
                </div>
            <?php } ?>

            <label for="first_name">Prénom :</label><br>
            <input type="text" id="first_name" name="first_name" class="form-control" value="<?php echo($strFirst_name); ?>"><br>

            <?php
            if (isset($arrErrors['last_name'])) { ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $arrErrors['last_name']; ?>
                </div>
            <?php } ?>

            <label for="last_name">Nom :</label><br>
            <input type="text" id="last_name" name="last_name" class="form-control" value="<?php echo($strLast_name); ?>"><br>

            <?php
            if (isset($arrErrors['mail'])) { ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $arrErrors['mail']; ?>
                </div>
            <?php } ?>

            <label for="mail">E-mail :</label><br>
            <input type="email" id="mail" name="mail" class="form-control" value="<?php echo($strMail); ?>"><br>

            <?php
            if (isset($arrErrors['password'])) { ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $arrErrors['password']; ?>
                </div>
            <?php } ?>

            <label for="password">Mot de passe :</label><br>
            <input type="password" id="password" name="password" class="form-control" value="<?php echo($strPassword); ?>"><br>

            <?php
            if (isset($arrErrors['bio'])) { ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $arrErrors['bio']; ?>
                </div>
            <?php } ?>

            <label for="bio">Biographie :</label><br>
            <textarea id="bio" name="bio" class="form-control"><?php echo($strBio); ?></textarea><br>

            <?php
            if (isset($arrErrors['avatar'])) { ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $arrErrors['avatar']; ?>
                </div>
            <?php } ?>

            <label for="avatar">Avatar* :</label><br>
            <input class="form-control" name="avatar" type="file"><br>

            <p>
                <input class="form-control btn btn-primary" type="submit" value="S'inscrire">
            </p>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>