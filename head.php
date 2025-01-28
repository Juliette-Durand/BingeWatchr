<?php
    /**
    * Head contenant les infos de la page, les liens, et l'inclusion de la barre de navigation
    * @author Juliette Durand
    */
    require_once("entities/user_entity.php");
    session_start();
    //var_dump($_SESSION);
?>

<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BingeWatchr - <?php echo($strTitle); ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <header>
        <?php
			include_once("nav.php");
		?>
    </header>

    <main>