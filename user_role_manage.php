<?php
	/*
	* Page de gestion des rôles des utilisateurs
	* @author Juliette Durand
	*/

	// Variables fonctionnelles
	$refPage="user_role_manage";
	
	// Variables d'affichage
	/* Ce qui sert de h1 et/ou de nom dans le titre de la page */
	$strTitle="Gérer les rôles des utilisateurs";
	
	// Inclusion du fichier model et entity de user
	require_once("models/user_model.php");
	require_once("entities/user_entity.php");
	
	// Instanciation
	$objUser	= new UserModel();
	
	// Utilisation
	$arrUser	= $objUser->findAll();
	
	foreach($arrUser as $arrDetUser){
		$objUser = new UserEntity();
		$objUser->hydrate($arrDetUser);
	}
	
	/*var_dump($arrUser);
	var_dump($objUser);*/


	include_once("head.php");
?>
		<div class="container mb-5">
			<h1><?php echo($strTitle); ?></h1>
		</div>
		
        <div class="container">
            <div class="row">
				<?php
					foreach($arrUser as $arrDetUser){
						$objUser = new UserEntity();
						$objUser->hydrate($arrDetUser);?>
						
						<div class="user_item col-12 d-flex align-items-center justify-content-between">
							<div class="user_item_left">
								<img src="assets/img/users/profile_pictures/<?php echo($objUser->getAvatar()); ?>" alt=""/>
								<span class="user_title ms-2"><?php echo($objUser->getFull_name()); ?></span>
								<span class="user_pseudo ms-2"><?php echo($objUser->getId()); ?></span>
							</div>
							<div class="user_item_right">
								<span class="user_role"><?php echo($objUser->getRole()); ?></span>
								<button class="btn btn-primary">Changer le rôle</button>
							</div>
						</div>
						
					<?php }?>
				
			</div>
        </div>


    </main>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>