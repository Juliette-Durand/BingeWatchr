<?php
	/**
	* Page de gestion des commentaires des utilisateurs
	* @author Juliette Durand
	*/
?>
		<div class="container mb-5">
			<h1><?php echo($strTitle); ?></h1>
		</div>
		
        <section class="container" id="comment_manage">
            <div class="row">
				<div class="search my-4">
					<form method="post" id="searchUser">
						<input type="hidden" name="search" value="search">
						<input type="text" name="keyWord" id="keyWord" value="">

						<input type="submit" value="Rechercher">
					</form>
				</div>
				<div class="accordion" id="accordionListUsers">

                    <?php foreach($arrComment as $objComment){ ?>

                        <div class="accordion-item comment_item">
                            <h2 class="accordion-header">
                                <div class="comment_item_content col-12 d-flex align-items-center justify-content-between">
                                    <!-- Partie gauche -->
                                    <div class="comment_item_left">
                                        <img src="assets/img/users/profile_pictures/<?php echo($objComment['user']->getAvatar()) ?>" alt=""/>
                                        <span class="user_title ms-2"><?php echo($objComment['user']->getFull_name()) ?></span>
                                        <span class="infos_comm ms-2"><?php echo($objComment['comment']->getMovie_name()) ?> - <?php echo($objComment['comment']->getDateFormat()) ?></span>
                                    </div>
    
                                    <!-- Partie droite -->
                                    <div class="comment_item_right d-flex align-items-center">
                                        <span class="user_role">
                                            <?php if($objComment['comment']->getState() == "U"){
                                                echo("Non publié");
                                            } else {
                                                echo("Publié");
                                            } ?>
                                        </span>
                                        <a class="btn btn-primary ms-2" data-bs-toggle="collapse" href="#collapse<?php echo($objComment['comment']->getId()) ?>" role="button" aria-expanded="true" aria-controls="collapse<?php echo($objComment['comment']->getId()) ?>">
                                            Gérer le commentaire
                                        </a>
                                    </div>
                                </div>
                            </h2>
                            <div id="collapse<?php echo($objComment['comment']->getId()) ?>" class="accordion-collapse collapse" data-bs-parent="#accordionListUsers">
                                <div class="accordion-body mt-3">
                                    <div class="user_list_form d-flex justify-content-between">
                                        <div class="form_left col-8">
                                            <span class="comm_title"><b><?php echo($objComment['comment']->getTitle()) ?></b></span>
                                            <p class="comm_content">
                                                <?php echo($objComment['comment']->getContent()) ?>
                                            </p>
                                        </div>
                                        
                                        <form method="POST" class="form_right d-flex align-items-start">
                                            <input type="hidden" name="id_comm" value="<?php echo($objComment['comment']->getId()) ?>">
                                            <input type="submit" class="btn btn-secondary me-2" name="publish_state" value="<?php echo($objComment['comment']->getState() == "U" ? "Publier" : "Dépublier") ?>">
                                            <a href="future_index.php?ctrl=comment&action=delete_comment&id=<?php echo($objComment['comment']->getId()) ?>" class="btn btn-danger">Supprimer</a>
                                        </form>
                                    </div>
                                    <?php if(isset($objComment['picture'])){ ?>
                                        <div class="pic_comm_container">
                                            <?php foreach($objComment['picture'] as $objPicture){ ?>
                                                <img src="assets/img/movies/movie_pictures/<?php echo($objPicture->getFile()) ?>" alt="">
                                            <?php } ?>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    
				</div>
			</div>
        </section>