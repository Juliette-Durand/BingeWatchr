<?php
	// Variables fonctionnelles
	$refPage="my_account";
	
	// Variables d'affichage
	/* Ce qui sert de h1 et/ou de nom dans le titre de la page */
	$strTitle="Mon compte";
	
	// Inclusion du fichier model et entity
	require_once("models/user_model.php");
	require_once("entities/user_entity.php");
	
	// Instanciation
	$objUser	= new UserModel();
	
	// Utilisation
	$arrUser	= $objUser->findUser();
	
	foreach($arrUser as $arrDetUser){
		$objUser = new UserEntity();
		$objUser->hydrate($arrDetUser);
	}
	
	var_dump($arrUser);
	var_dump($objUser);


	include_once("head.php");
?>

        <div class="container">
            <div class="row">
                <div class="picture_container col-4">
                    <img src="https://picsum.photos/200" alt="">
                </div>
                <form action="" class="col-8">
                    <div>
                        <label for="pseudo">Pseudo</label>
                        <input type="text" name="pseudo" id="pseudo" value="">
                    </div>
        
                    <div>
                        <label for="first_name">Prénom</label>
                        <input type="text" name="first_name" id="first_name">
                    </div>
        
                    <div>
                        <label for="last_name">Nom</label>
                        <input type="text" name="last_name" id="last_name">
                    </div>
        
                    <div>
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email">
                    </div>
                    
                    <div>
                        <label for="password">Mot de passe</label>
                        <input type="text" name="password" id="password">
                    </div>
        
                    <div>
                        <label for="bio">Bio</label>
                        <textarea name="bio" id="bio"></textarea>
                    </div>
                </form>
            </div>
        </div>


    </main>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>