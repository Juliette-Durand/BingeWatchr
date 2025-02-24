{**
* Page affichant les informations de l'utilisateur en session et lui permettant de mofifier ses informations personnelles
* @author Juliette Durand
*}
{extends file="views/layout.tpl"}      

{block name="contenu"}
	<section id="my_account">
		<div class="container mb-5">
			<h1>{$strTitle}</h1>
		</div>
		
        <div class="container">
			{if $this->_arrData['boolChange']|isset}
				{* Vérifie la présence de la variable contenant le résultat de la requête PDO *}
				{if $this->_arrData['boolChange'] === true}
					{* Si la requête s'est bien déroulée -> affichage d'une alerte de succès *}
					<div class="alert alert-success">
						Les modifications ont bien été prises en compte
					</div>
				{else}
					{* Si une erreur est retournée -> affichage d'une alerte d'erreur *}
					<div class="alert alert-danger">
						Erreur lors de la prise en compte des modifications
					</div>
				{/if}
			{/if}

			<form method="POST" class="row" enctype="multipart/form-data" id="my_account_form">
                <div class="col-5 d-flex flex-column align-items-center">
                    <div class="picture_container mb-4">
                        <img class="profile_pic" src="assets/img/users/profile_pictures/{$objUser->getAvatar()}" alt="">
                    </div>
					<h2 class="mb-5">{$objUser->getId()}</h2>

					<!-- Affichage de l'erreur si le fichier importé ne respecte pas les critères -->
					{if $arrErrors['avatar']|isset}
						<div class="alert alert-danger">
							{$arrErrors['avatar']}
						</div>
					{/if}
					<!-- Champ d'import de l'avatar -->
					<div id="my_account_file">
						<input type="file" name="avatar" id="avatar" >
					</div>
					<a class="btn btn-secondary" id="my_account_file_btn">Modifier la photo de profil</a>
                </div>
                
				<div class="col-7">        
                    <div>
                        <label for="first_name">Prénom</label>
                        <input type="text" name="first_name" id="first_name" value="{$objUser->getFirst_name()}">
						<!-- <button class="btn btn-primary">Modifier</button> -->
                    </div>
        
                    <div>
                        <label for="last_name">Nom</label>
                        <input type="text" name="last_name" id="last_name" value="{$objUser->getLast_name()}">
						<!-- <button class="btn btn-primary">Modifier</button> -->
                    </div>
        
                    <div>
						<!-- Affichage de l'erreur si l'adresse email ne respecte pas les critères -->
						{if $arrErrors['email']|isset}
							<div class="alert alert-danger">
								{$arrErrors['email']}
							</div>
						{/if}
                        <label for="mail">Email</label>
                        <input type="email" name="mail" id="mail" value="{$objUser->getMail()}">
						<!-- <button class="btn btn-primary">Modifier</button> -->
                    </div>
        
                    <div>
                        <label for="bio">Bio</label>
                        <textarea name="bio" id="bio" rows="4">{$objUser->getBio()}</textarea>
						<!-- <button class="btn btn-primary">Modifier</button> -->
                    </div>
					
					<div>
						{if $arrErrors['old_pwd']|isset}
							<div class="alert alert-danger">
								{$arrErrors['old_pwd']}
							</div>
						{/if}
						{if $arrErrors['new_pwd']|isset}
							<div class="alert alert-danger">
								<ul>
								Le mot de passe renseigné ne répond pas aux critères suivants :
								{foreach $arrErrors['new_pwd'] as $strError}
									<li>{$strError}</li>
								{/foreach}
								</ul>
							</div>
						{/if}
						{if $arrErrors['conf_pwd']|isset}
							<div class="alert alert-danger">
								{$arrErrors['conf_pwd']}
							</div>
						{/if}
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
					<a href="index.php?ctrl=user&action=logout" class="mt-5 btn btn-primary">Déconnexion</a>
				</div>
			</form>
			<div>
				<a href="index.php?ctrl=user&action=delete_account&id={$objUser->getId()}" class="btn btn-danger mt-5">Supprimer le compte</a>
			</div>
        </div>
	</section>
{/block}