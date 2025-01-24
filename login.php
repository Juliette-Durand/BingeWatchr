<?php
	// Variables fonctionnelles
	$refPage="login";
	
	// Variables d'affichage
	/* Ce qui sert de h1 et/ou de nom dans le titre de la page */
	$strTitle="Se connecter";
	

    require_once("entities/user_entity.php");
	include_once("head.php");

    // Récupération des données du formulaire dans le POST
    $strEmail       =   $_POST['email']??"";
    $strPassword    =   $_POST['password']??"";

    // Création d'un tableau d'erreurs
    $arrErrors  =   array();

    if(count($_POST) > 0){
        // Vérification de l'adresse email
        if ($strEmail == "") {
            $arrErrors['email'] =   "L'adresse email est obligatoire";
        } else if (!filter_var($strEmail, FILTER_VALIDATE_EMAIL)){
            $arrErrors['email'] =   "L'adresse email renseignée n'est pas valide";
        }

        // Vérification du mot de passe
        if ($_POST['password'] == "") {
            $arrErrors['password'] = "Le mot de passe est obligatoire";
        }

        if(count($arrErrors) == 0){
            require('models/user_model.php');
            $objUserModel   =   new UserModel();
            // On utilise le modèle pour effectuer la requête dans la base de donnée
            $arrUser        =   $objUserModel->loginUser($strEmail, $strPassword);

            // Si aucun utilisateur correspondant aux identifiants n'a été trouvé dans la base de donnée
            if($arrUser === false){
                $arrErrors['connect']   =   "Adresse email ou mot de passe incorrect(e)";
            } else {
                // Enregistrement de l'utilisateur en session
                $objUser    =   new UserEntity();
                $objUser->hydrate($arrUser);
                $_SESSION['user']   =   $objUser;
                header("Location:index.php");
                //var_dump($_SESSION);
            }
        }
    }
   
?>
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
                        <label for="email">Adresse-email :</label>
                        <input type="email" name="email" id="email" value="<?php echo($strEmail); ?>">
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
		


    </main>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>