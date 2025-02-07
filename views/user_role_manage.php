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
				<div class="search my-4">
					<form method="post" id="searchUser">
						<input type="hidden" name="search" value="search">
						<input type="text" name="keyWord" id="keyWord" value="<?php echo($strKeyword) ?>">

						<input type="submit" value="Rechercher">
					</form>
				</div>
				<div class="accordion" id="accordionListUsers">
					<?php foreach($arrUser as $arrDetUser){
						$objUser = new UserEntity();
						$objUser->hydrate($arrDetUser);
						include('views/_partial/user_item.php');
					} ?>
				</div>
			</div>
        </section>