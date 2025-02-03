<?php
	/**
	* Page affichant les informations de l'utilisateur en session et lui permettant de mofifier ses informations personnelles
	* @author Juliette Durand
	*/
	//var_dump($_POST);
	
	
?>

	<section id="my_account">
		<div class="container mb-5">
			<h1><?php echo($strTitle); ?></h1>
		</div>
		
        <div class="container">
			<?php if (isset($this->_arrData['boolChange'])){
				// Vérifie la présence de la variable contenant le résultat de la requête PDO
				if ($this->_arrData['boolChange'] === true){
					// Si la requête s'est bien déroulée -> affichage d'une alerte de succès ?>
					<div class="alert alert-success">
						Les modifications ont bien été prises en compte
					</div>
				<?php } else {
					// Si une erreur est retournée -> affichage d'une alerte d'erreur ?>
					<div class="alert alert-danger">
						Erreur lors de la prise en compte des modifications
					</div>
				<?php }
			} ?>

			<form method="POST" class="row" enctype="multipart/form-data" id="my_account_form">
                <div class="col-5 d-flex flex-column align-items-center">
                    <div class="picture_container mb-4">
                        <img class="profile_pic" src="assets/img/users/profile_pictures/<?php echo($objUser->getAvatar()); ?>" alt="">
                    </div>
					<h2 class="mb-5"><?php echo($objUser->getId()); ?></h2>

					<!-- Affichage de l'erreur si le fichier importé ne respecte pas les critères -->
					<?php if (isset($arrErrors['avatar'])) { ?>
						<div class="alert alert-danger">
							<?php echo($arrErrors['avatar']) ?>
						</div>
					<?php } ?>
					<!-- Champ d'import de l'avatar -->
					<div id="my_account_file">
						<input type="file" name="avatar" id="avatar" >
					</div>
					<a class="btn btn-secondary" id="my_account_file_btn">Modifier la photo de profil</a>
                </div>
                
				<div class="col-7">        
                    <div>
                        <label for="first_name">Prénom</label>
                        <input type="text" name="first_name" id="first_name" value="<?php echo($objUser->getFirst_name()); ?>">
						<!-- <button class="btn btn-primary">Modifier</button> -->
                    </div>
        
                    <div>
                        <label for="last_name">Nom</label>
                        <input type="text" name="last_name" id="last_name" value="<?php echo($objUser->getLast_name()); ?>">
						<!-- <button class="btn btn-primary">Modifier</button> -->
                    </div>
        
                    <div>
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" value="<?php echo($objUser->getEmail()); ?>">
						<!-- <button class="btn btn-primary">Modifier</button> -->
                    </div>
        
                    <div>
                        <label for="bio">Bio</label>
                        <textarea name="bio" id="bio" rows="4"><?php echo($objUser->getBio()); ?></textarea>
						<!-- <button class="btn btn-primary">Modifier</button> -->
                    </div>
					
					<div>
						<?php if (isset($arrErrors['old_pwd'])){ ?>
							<div class="alert alert-danger">
								<?php echo($arrErrors['old_pwd']) ?>
							</div>
						<?php } ?>
						<?php if (isset($arrErrors['new_pwd'])){ ?>
							<div class="alert alert-danger">
								<ul>
								Le mot de passe renseigné ne répond pas aux critères suivants :
								<?php foreach ($arrErrors['new_pwd'] as $strError){ ?>
									<li><?php echo($strError); ?></li>
								<?php } ?>
								</ul>
							</div>
						<?php } ?>
						<?php if (isset($arrErrors['conf_pwd'])){ ?>
							<div class="alert alert-danger">
								<?php echo($arrErrors['conf_pwd']) ?>
							</div>
						<?php } ?>
						<div id="my_account_pwd">
							<div>
								<label for="old_pwd">Ancien mot de passe</label>
								<input type="password" name="old_pwd" id="old_pwd">
							</div>
							<div>
								<label for="new_pwd">Nouveau mot de passe</label>
								<input type="password" name="new_pwd" id="new_pwd">
								<p>Le mot de passe doit contenir :</p>
								<ul class="pwd_conditions">
									<li>au minimum 8 caractères</li>
									<li>au moins une majuscule</li>
									<li>au moins une minuscule</li>
									<li>au moins un chiffre</li>
									<li>au moins un caractère spécial</li>
								</ul>
							</div>
							<div>
								<label for="confirm_pwd">Confirmation mot de passe</label>
								<input type="password" name="confirm_pwd" id="confirm_pwd">
							</div>
						</div>
						
						<a class="btn btn-secondary" id="my_account_pwd_btn">Modifier le mot de passe</a>
					</div>
					<input type="submit" class="btn btn-primary" value="Enregistrer les modifications">
				</div>
			</form>
			<div class="row">
				<a href="future_index.php?ctrl=user&action=delete" class="btn btn-danger">Supprimer le compte</a>
			</div>
        </div>
	</section>