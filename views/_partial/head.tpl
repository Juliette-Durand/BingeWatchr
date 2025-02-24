    {**
    * Head contenant les infos de la page, les liens, et l'inclusion de la barre de navigation
    * @author Juliette Durand
    *}

<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BingeWatchr - {$strTitle}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <header>
        {include file="views/_partial/nav.tpl"}

        <!-- Affichage du message de suppression de compte -->
        {if (isset($_SESSION['account_deletion']['error']))}
            <div class="alert alert-danger">
                {$_SESSION['account_deletion']['error']}
            </div>
        {elseif (isset($_SESSION['account_deletion']['success']))}
            <div class="alert alert-success">
                {$_SESSION['account_deletion']['success']}
            </div>
        {/if}
    </header>

    <main>