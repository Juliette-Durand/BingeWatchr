    {**
    * Page permettant de se connecter grâce aux identifiants en base de donnée
    * @author Juliette Durand
    *}
    {extends file="views/layout.tpl"}      

    {block name="contenu"}

    <section id="login">
		<div class="container mb-5">
			<h1>{$strTitle}</h1>
		</div>

        <div class="container">
            <div class="row">
                <form class="col-6 offset-3" method="post">
                    <div>
                        <label for="mail">Adresse-email :</label>
                        <input type="email" name="mail" id="mail" value="{$strMail}">
                    </div>
                    <div>
                        <label for="password">Mot de passe :</label>
                        <input type="password" name="password" id="password">
                    </div>
                    <input class="btn btn-primary" type="submit" value="Se connecter">
                    <p>Pas encore de compte ? <a href="create_account.php">Créez-en un !</a></p>
                </form>
            </div>
        </div>
    </section>
    {/block}