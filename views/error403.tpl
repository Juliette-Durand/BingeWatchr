{extends file="views/layout.tpl"}

{block name="contenu"}
<section class="container">
    <div class="container mb-5">
        <h1>{$strTitle}</h1>
    </div>
		
    <div class="row px-5">
        <p class="display-6">Vous ne passerez... paaaaas ! 🧙‍♂️</p>
        <p>Il semblerait que vous n'avez pas les droits pour accéder à cette page...</p>
        <a href="index.php?ctrl=movie&action=home" class="mt-5 btn btn-primary">Retour à l'accueil</a>
    </div>
</section>
{/block}