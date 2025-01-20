<?php
// Récupérer les informations du $_POST et $_FILES
$strFirst_name = $_POST['first_name'] ?? "";
$strLast_name = $_POST['last_name'] ?? "";
$strMail = $_POST['mail'] ?? "";
$strPassword = $_POST['password'] ?? "";
$strBio = $_POST['bio'] ?? "";
$strAvatar = $_FILES['avatar'] ?? "";

var_dump($_POST);

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

<!-- Formulaire d'inscription -->
<form name="formRegister" method="post" action="" enctype="multipart/form-data">
    <legend>Formulaire d'inscription BingeWatchr</legend>

    <!-- Affichage des erreurs -->
    <?php if (isset($arrErrors['first_name'])): ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $arrErrors['first_name']; ?>
        </div>
    <?php endif; ?>

    <label for="first_name">Prénom :</label><br>
    <input type="text" id="first_name" name="first_name" class="form-control" value="<?php echo($strFirst_name); ?>"><br>

    <?php if (isset($arrErrors['last_name'])): ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $arrErrors['last_name']; ?>
        </div>
    <?php endif; ?>

    <label for="last_name">Nom :</label><br>
    <input type="text" id="last_name" name="last_name" class="form-control" value="<?php echo($strLast_name); ?>"><br>

    <?php if (isset($arrErrors['mail'])): ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $arrErrors['mail']; ?>
        </div>
    <?php endif; ?>

    <label for="mail">E-mail :</label><br>
    <input type="email" id="mail" name="mail" class="form-control" value="<?php echo($strMail); ?>"><br>

    <?php if (isset($arrErrors['password'])): ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $arrErrors['password']; ?>
        </div>
    <?php endif; ?>

    <label for="password">Mot de passe :</label><br>
    <input type="password" id="password" name="password" class="form-control" value="<?php echo($strPassword); ?>"><br>

    <?php if (isset($arrErrors['bio'])): ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $arrErrors['bio']; ?>
        </div>
    <?php endif; ?>

    <label for="bio">Biographie :</label><br>
    <textarea id="bio" name="bio" class="form-control"><?php echo($strBio); ?></textarea><br>

    <?php if (isset($arrErrors['avatar'])): ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $arrErrors['avatar']; ?>
        </div>
    <?php endif; ?>

    <label for="avatar">Avatar* :</label><br>
    <input class="form-control" name="avatar" type="file"><br>

    <p>
        <input class="form-control btn btn-primary" type="submit" value="S'inscrire">
    </p>
</form>
