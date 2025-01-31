<?php
	/**
	* Page affichant les informations de l'utilisateur en session et lui permettant de mofifier ses informations personnelles
	* @author Juliette Durand
	*/

	// Variables fonctionnelles
	$refPage="my_account";
	
	// Variables d'affichage
	/* Ce qui sert de h1 et/ou de nom dans le titre de la page */
	$strTitle="Mon compte";
	
	// Inclusion du fichier model et entity
	require_once("models/user_model.php");

	include_once("head.php");
	// Instanciation
	$objUser	= new UserModel();
	
	// Récupération des données en sessions de user
	$arrUser	= $objUser->findUser($_SESSION['user']->getId());
	
	$objUser = new UserEntity();
	$objUser->hydrate($arrUser);
	
	/*var_dump($arrUser);
	var_dump($objUser);*/

?>

	<section id="my_account">
		<div class="container mb-5">
			<h1><?php echo($strTitle); ?></h1>
		</div>
		
        <div class="container">
            <div class="row">
                <div class="col-4 d-flex flex-column align-items-center">
                    <div class="picture_container mb-3">
                        <img class="profile_pic" src="assets/img/users/profile_pictures/<?php echo($objUser->getAvatar()); ?>" alt="">
                    </div>
                    <div class="pic_btn">
                        <a class="btn btn-primary" href="">Changer de photo</a>
                    </div>
                </div>
                
                <form action="" class="col-8">
                    <div>
                        <label for="pseudo">Pseudo</label>
                        <input type="text" name="pseudo" id="pseudo" value="<?php echo($objUser->getId()); ?>">
                    </div>
        
                    <div>
                        <label for="first_name">Prénom</label>
                        <input type="text" name="first_name" id="first_name" value="<?php echo($objUser->getFirst_name()); ?>">
						<button class="btn btn-primary">Modifier</button>
                    </div>
        
                    <div>
                        <label for="last_name">Nom</label>
                        <input type="text" name="last_name" id="last_name" value="<?php echo($objUser->getLast_name()); ?>">
						<button class="btn btn-primary">Modifier</button>
                    </div>
        
                    <div>
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" value="<?php echo($objUser->getEmail()); ?>">
						<button class="btn btn-primary">Modifier</button>
                    </div>
        
                    <div>
                        <label for="bio">Bio</label>
                        <textarea name="bio" id="bio"><?php echo($objUser->getBio()); ?></textarea>
						<button class="btn btn-primary">Modifier</button>
                    </div>
					
					<div>
						<div>
							<label for="old_pwd">Ancien mot de passe</label>
							<input type="text" name="old_pwd" id="old_pwd" value="<?php echo($objUser->getPassword()); ?>">
						</div>
						<div>
							<label for="new_pwd">Nouveau mot de passe</label>
							<input type="text" name="new_pwd" id="new_pwd" value="<?php echo($objUser->getPassword()); ?>">
							<p>Le mot de passe doit contenir :</p>
							<ul class="pwd_conditions">
								<li>au moins une majuscule</li>
								<li>au moins une minuscule</li>
								<li>au moins un chiffre</li>
								<li>au moins un caractère spécial</li>
							</ul>
						</div>
						<div>
							<label for="confirm_pwd">Confirmation mot de passe</label>
							<input type="text" name="confirm_pwd" id="confirm_pwd" value="<?php echo($objUser->getPassword()); ?>">
						</div>
						
						<button class="btn btn-primary">Réinitialiser le mot de passe</button>
					</div>
                </form>
            </div>
        </div>
    
	</section>
  </main>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>