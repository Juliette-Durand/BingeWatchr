<?php
    // Récupérer les informations du $_POST et $_FILES
    $strFirst_name = $_POST['first_name'] ?? "";
    $strLast_name = $_POST['last_name'] ?? "";
    $strMail = $_POST['mail'] ?? "";
    $strPassword = $_POST['password'] ?? "";
    $strBio = $_POST['bio'] ?? "";
    $strAvatar = $_FILES['avatar']['name'] ?? "";

        var_dump($strFirst_name);
        var_dump($strLast_name);
        var_dump($strMail);
        var_dump($strPassword);
        var_dump($strBio);
        var_dump($strAvatar);

?>

<!-- Formulaire d'inscription -->
<form name="formRegister" method="post" action="" enctype="multipart/form-data">
    <legend>Formulaire d'inscription BingeWatchr</legend>

    <label for="first_name">Prénom :</label><br>
    <input type="text" id="first_name" name="first_name" class="form-control" value="<?php echo htmlspecialchars($strFirst_name); ?>"><br>

    <label for="last_name">Nom :</label><br>
    <input type="text" id="last_name" name="last_name" class="form-control" value="<?php echo htmlspecialchars($strLast_name); ?>"><br>

    <label for="mail">E-mail :</label><br>
    <input type="email" id="mail" name="mail" class="form-control" value="<?php echo htmlspecialchars($strMail); ?>"><br>

    <label for="password">Mot de passe :</label><br>
    <input type="password" id="password" name="password" class="form-control" value="<?php echo htmlspecialchars($strPassword); ?>"><br>

    <label for="bio">Biographie :</label><br>
    <textarea id="bio" name="bio" class="form-control"><?php echo htmlspecialchars($strBio); ?></textarea><br>

    <label for="avatar">Avatar*:</label><br>
    <input class="form-control" name="avatar" type="file"><br>

    <p>
        <input class="form-control btn btn-primary" type="submit" value="S'inscrire">
    </p>
</form>
