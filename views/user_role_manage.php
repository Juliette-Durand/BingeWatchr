<?php
	/**
	* Page de gestion des rôles des utilisateurs
	* @author Juliette Durand
	*/
?>
		<div class="container mb-5">
			<h1><?php echo($strTitle); ?></h1>
		</div>
		
        <section class="container" id="users_list_role">
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
								<span class="user_role">
									<?php
										switch($objUser->getRole()){
											case "user":
												echo("Watchr");
												break;
											case "modo":
												echo("Modérateur");
												break;
											case "admin":
												echo("Administrateur");
												break;
										}?>
									</span>
								<button class="btn btn-primary ms-2">Changer le rôle</button>
							</div>
						</div>
						
					<?php }?>
				
			</div>
        </section>