    {**
    * Page Mentions légales
    * @author Juliette Durand
    *}
    {extends file="views/layout.tpl"}      

    {block name="contenu"}
        <div class="container mb-5">
            <h1>{$strTitle}</h1>              
        </div>
        
        <div class="container">
            <h2 class="mt-5">1. Éditeur du site</h2>
            <p>Le site <strong>BingeWatchr</strong> est édité par :</p>
            <ul>
                <li><strong>Nom :</strong> BingeWatchr</li>
                <li><strong>Siège social :</strong> Hollywood</li>
                <li><strong>Email de contact :</strong> contact@bingewatchr.local</li>
                <li><strong>Directeur de la publication :</strong> Les BingeWatchrs originels</li>
            </ul>

            <h2 class="mt-5">2. Hébergement</h2>
            <p>Le site est hébergé en local sur <strong>localhost</strong>.</p>
            
            <h2 class="mt-5">3. Propriété intellectuelle</h2>
            <p>L'ensemble du contenu présent sur le site <strong>BingeWatchr</strong> (textes, images, logos, code, etc.) est protégé par les lois en vigueur sur la propriété intellectuelle. Toute reproduction, distribution ou utilisation sans autorisation préalable est interdite.</p>
            
            <h2 class="mt-5">4. Responsabilité</h2>
            <p>L'éditeur s'efforce de fournir des informations exactes et à jour, mais ne peut garantir l'exactitude, l'exhaustivité ou l'actualité des contenus. L'utilisateur utilise le site sous sa propre responsabilité.</p>

            <h2 class="mt-5">5. Données personnelles</h2>
            <p>Le site collecte des données personnelles conformément à sa <a href="#">Politique de Confidentialité</a>. Les utilisateurs disposent d'un droit d'accès, de modification et de suppression de leurs données.</p>
            
            <h2 class="mt-5">6. Cookies</h2>
            <p>Le site utilise des cookies pour améliorer l'expérience utilisateur. Vous pouvez configurer votre navigateur pour refuser les cookies.</p>
        
            <h2 class="mt-5">7. Contact</h2>
            <p>Pour toute question ou réclamation, vous pouvez nous contacter à l'adresse suivante : <strong>contact@bingewatchr.local</strong>.</p>
        </div>
    {/block}