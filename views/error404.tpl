{extends file="views/layout.tpl"}

{block name="contenu"}
<section class="container">
    <div class="container mb-5">
        <h1>{$strTitle}</h1>
    </div>
    <div class="row px-5">
        <p class="display-6">Houston, on a un problème ! 🪐</p>
        <p>La page que vous recherchez n'existe pas...</p>
        <a href="future_index.php?ctrl=movie&action=home" class="mt-5 btn btn-primary">Retour à l'accueil</a>
    </div>
</section>
{/block}