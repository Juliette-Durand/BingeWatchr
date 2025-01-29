<?php
	/**
	* Page affichant les informations de l'utilisateur en session et lui permettant de mofifier ses informations personnelles
	* @author Juliette Durand
	*/
	var_dump($_POST);
	
	
?>

	<section id="my_account">
		<div class="container mb-5">
			<h1><?php echo($strTitle); ?></h1>
		</div>
		
        <div class="container">
            <div class="row">
                <div class="col-4 d-flex flex-column align-items-center">
                    <div class="picture_container mb-2">
                        <img class="profile_pic" src="assets/img/users/profile_pictures/<?php echo($objUser->getAvatar()); ?>" alt="">
                    </div>
					<h2 class="mb-3"><?php echo($objUser->getId()); ?></h2>
                    <div class="pic_btn">
                        <a class="btn btn-primary" href="">Changer de photo</a>
                    </div>
                </div>
                
                <form method="POST" class="col-8">        
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
					
					<!--<div>
						<div>
							<label for="old_pwd">Ancien mot de passe</label>
							<input type="text" name="old_pwd" id="old_pwd" value="<?php /*echo($objUser->getPassword());*/ ?>">
						</div>
						<div>
							<label for="new_pwd">Nouveau mot de passe</label>
							<input type="text" name="new_pwd" id="new_pwd" value="<?php /*echo($objUser->getPassword());*/ ?>">
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
							<input type="text" name="confirm_pwd" id="confirm_pwd" value="<?php /*echo($objUser->getPassword());*/ ?>">
						</div>
						
						<button class="btn btn-primary">Réinitialiser le mot de passe</button>
					</div>-->
					<input type="submit" value="Enregistrer les modifications">
                </form>
            </div>
        </div>
	</section>