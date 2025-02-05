<?php
    /**
    * Page permettant à un utilisateur de supprimer son compte
    * @author Juliette Durand
    */
    
   // Penser à optimiser l'affichage selon si le compte supprimé est celui de l'utilisateur connecté ou non
?>
    <section id="delete_account">
		<div class="container mb-5">
			<h1><?php echo($strTitle); ?></h1>
		</div>

        <div class="container">
            
            <?php if((isset($_SERVER['HTTP_REFERER'])) && (str_contains($_SERVER['HTTP_REFERER'], 'action=user_role_manage'))){ ?>
                <div class="row">
                    <div class="col-5 offset-2">
                        <span class="display-6">Vous êtes sur le point de supprimer le compte d'un utilisateur</span>
                        <ul class="mt-3 mb-5">
                            <b>La suppression de ce compte entrainera :</b>
                            <li>la suppression de toutes les informations le concernant</li>
                            <li>la déconnexion de sa session sur tous les appareils</li>
                        </ul>
                        <div>
                            <a href="future_index.php?ctrl=user&action=confirm_delete_account" class="btn btn-danger">Confirmer la suppression du compte</a>
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="picture_container mb-4 text-end">
                            <img class="profile_pic" src="assets/img/users/profile_pictures/<?php echo($strUserAvatar); ?>" alt="">
                        </div>
                    </div>
                </div>
            <?php } else if((isset($_SERVER['HTTP_REFERER'])) && (str_contains($_SERVER['HTTP_REFERER'], 'action=my_account'))) { ?>
                <div class="row">
                    <div class="col-5 offset-2">
                        <span class="display-6">Oh non...<br>Vous nous quittez déjà ?</span>
                        <ul class="mt-3 mb-5">
                            <b>La suppression de votre compte entrainera :</b>
                            <li>la suppression de toutes les informations vous concernant</li>
                            <li>la déconnexion de votre session sur tous les appareils</li>
                        </ul>
                        <div>
                            <a href="future_index.php?ctrl=user&action=confirm_delete_account" class="btn btn-danger">Confirmer la suppression du compte</a>
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="picture_container mb-4 text-end">
                            <img class="profile_pic" src="assets/img/users/profile_pictures/<?php echo($_SESSION['user']->getAvatar()); ?>" alt="">
                        </div>
                    </div>
                </div>
            <?php } else {
                header("Location:future_index.php?ctrl=user&action=my_account");
            } ?>
        </div>
    </section>