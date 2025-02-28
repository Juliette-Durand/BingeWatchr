    {**
    * Page Politique de confidentialité
    * @author Juliette Durand
    *}
    {extends file="views/layout.tpl"}      

    {block name="contenu"}
        <div class="container mb-5">
            <h1>{$strTitle}</h1>              
        </div>
        
        <div class="container">
            <h2 class="mt-5">1. Introduction</h2>
            <p>Bienvenue sur <strong>BingeWatchr</strong>. La protection de vos données personnelles est une priorité pour nous. Cette politique de confidentialité explique comment nous collectons, utilisons et protégeons vos informations lorsque vous utilisez notre plateforme.</p>
        
            <h2 class="mt-5">2. Informations collectées</h2>
            <p>Nous collectons uniquement les données suivantes lorsque vous utilisez BingeWatchr :</p>
            <ul>
                <li><strong>Informations de compte</strong> : nom d'utilisateur, adresse e-mail, mot de passe (haché).</li>
                <li><strong>Données d'utilisation</strong> : liste de films enregistrés et préférences.</li>
                <li><strong>Cookies</strong> : pour améliorer votre expérience utilisateur.</li>
            </ul>
        
            <h2 class="mt-5">3. Utilisation des données</h2>
            <p>Vos données sont utilisées uniquement pour :</p>
            <ul>
                <li>Gérer votre compte et votre liste de films.</li>
                <li>Améliorer la plateforme et l'expérience utilisateur.</li>
                <li>Assurer la sécurité du site et détecter les activités suspectes.</li>
            </ul>
        
            <h2 class="mt-5">4. Partage des données</h2>
            <p>Nous ne partageons aucune donnée avec des tiers. Vos informations restent strictement confidentielles et ne sont pas vendues ou cédées.</p>
        
            <h2 class="mt-5">5. Stockage des données</h2>
            <p>Nos données sont stockées en local sur notre hébergeur <strong>localhost</strong>. Nous prenons les mesures nécessaires pour assurer la sécurité de vos informations.</p>
        
            <h2 class="mt-5">6. Vos droits</h2>
            <p>Vous avez le droit de :</p>
            <ul>
                <li>Accéder à vos données personnelles.</li>
                <li>Modifier ou supprimer vos informations.</li>
                <li>Nous contacter pour toute question relative à vos données.</li>
            </ul>
        </div>
    {/block}