<?php
    /**
    * Page permettant de se connecter grâce aux identifiants en base de donnée
    * @author Juliette Durand
    */
    
   
?>

    <!-- Affichage de l'erreur de suppression de compte -->
	<?php if(isset($_SESSION['account_deletion']['success'])){ ?>
        <div class="alert alert-success">
            <?php echo($_SESSION['account_deletion']['success']); ?>
        </div>
    <?php } ?>
    <section id="login">
		<div class="container mb-5">
			<h1><?php echo($strTitle); ?></h1>
		</div>

        <div class="container">
            <div class="row">
                <form class="col-6 offset-3" method="post">
                    <?php if (isset($arrErrors['connect'])){ ?>
                        <div class="alert alert-danger">
                            <?php echo($arrErrors['connect']); ?>
                        </div>
                    <?php } ?>
                    <div>
                        <?php if (isset($arrErrors['email'])){ ?>
                            <div class="alert alert-danger">
                                <?php echo($arrErrors['email']); ?>
                            </div>
                        <?php } ?>
                        <label for="mail">Adresse-email :</label>
                        <input type="email" name="mail" id="mail" value="<?php echo($strMail); ?>">
                    </div>
                    <div>
                        <?php if (isset($arrErrors['password'])){ ?>
                            <div class="alert alert-danger">
                                <?php echo($arrErrors['password']); ?>
                            </div>
                        <?php } ?>
                        <label for="password">Mot de passe :</label>
                        <input type="password" name="password" id="password">
                    </div>
                    <input class="btn btn-primary" type="submit" value="Se connecter">
                    <p>Pas encore de compte ? <a href="create_account.php">Créez-en un !</a></p>
                </form>
            </div>
        </div>
    </section>