<?php
	/**
	* Page de gestion des commentaires des utilisateurs
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
						<input type="text" name="keyWord" id="keyWord" value="">

						<input type="submit" value="Rechercher">
					</form>
				</div>
				<div class="accordion" id="accordionListUsers">

                    <div class="accordion-item user_item">
                        <h2 class="accordion-header">
                            <div class="user_item_content col-12 d-flex align-items-center justify-content-between">
                                <!-- Partie gauche -->
                                <div class="user_item_left">
                                    <img src="assets/img/users/profile_pictures/no_profile_pic.webp" alt=""/>
                                    <span class="user_title ms-2">Juliette Durand</span>
                                    <span class="user_pseudo ms-2">Intouchables - 02/01/2025 10:58</span>
                                </div>

                                <!-- Partie droite -->
                                <div class="user_item_right d-flex align-items-center">
                                    <span class="user_role">
                                    Non publié
                                    </span>
                                    <a class="btn btn-primary ms-2" data-bs-toggle="collapse" href="#collapse" role="button" aria-expanded="true" aria-controls="collapse">
                                        Gérer le commentaire
                                    </a>
                                </div>
                            </div>
                        </h2>
                        <div id="collapse" class="accordion-collapse collapse" data-bs-parent="#accordionListUsers">
                            <div class="accordion-body mt-3">
                                <form method="POST" class="user_list_form d-flex justify-content-between align-items-end">
                                    <div class="form_left col-8">
                                        <span class="comm_title">Véritable chef d'œuvre et amplement mérité</span>
                                        <p class="comm_content">
                                            Intouchables nous fait découvrir des liens forts entre un jeune de banlieue et un tétraplégique que tout oppose. Beaucoup de rires mais également une très forte émotion, j'en suis ressortie émue, à aller voir absolument !
                                        </p>
                                    </div>
                                    
                                    <div class="form_right d-flex align-items-start">
                                        <input type="submit" class="btn btn-secondary me-2" value="Publier">
                                        <a href="future_index.php?ctrl=user&action=delete_account&id=" class="btn btn-danger">Supprimer</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    
				</div>
			</div>
        </section>