<div class="accordion-item user_item">
							<h2 class="accordion-header">
								<div class="user_item_content col-12 d-flex align-items-center justify-content-between">
									<!-- Partie gauche -->
									<div class="user_item_left">
										<img src="assets/img/users/profile_pictures/<?php echo($objUser->getAvatar()); ?>" alt=""/>
										<span class="user_title ms-2"><?php echo($objUser->getFull_name()); ?></span>
										<span class="user_pseudo ms-2"><?php echo($objUser->getId()); ?></span>
									</div>

									<!-- Partie droite -->
									<div class="user_item_right d-flex align-items-center">
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
										<a class="btn btn-primary ms-2" data-bs-toggle="collapse" href="#collapse<?php echo($objUser->getId())?>" role="button" aria-expanded="true" aria-controls="collapse<?php echo($objUser->getId())?>">
											Gérer l'utilisateur
										</a>
									</div>
								</div>
							</h2>
							<div id="collapse<?php echo($objUser->getId())?>" class="accordion-collapse collapse" data-bs-parent="#accordionListUsers">
								<div class="accordion-body mt-3">
									<form method="POST" class="user_list_form d-flex justify-content-between align-items-end">
										<?php if(($_SESSION['user']->getRole() == 'admin') && ($objUser->getRole() != 'admin')){ ?>
										<div class="form_left">
											<input type="hidden" name="user" value="<?php echo($objUser->getId())?>">
											<select name="role">
												<option value="user" <?php if($objUser->getRole() == "user"){ echo("selected"); } ?>>Watchr</option>
												<option value="modo" <?php if($objUser->getRole() == "modo"){ echo("selected"); } ?>>Modérateur</option>
												<option value="admin" <?php if($objUser->getRole() == "admin"){ echo("selected"); } ?>>Administrateur</option>
											</select>
	
											<input type="submit" class="btn btn-secondary mt-2" value="Enregistrer les modifications">
										</div>
										<?php } ?>

										<?php if((($_SESSION['user']->getRole() == 'admin') && ($objUser->getRole() != 'admin')) ||
												(($_SESSION['user']->getRole() == 'modo') && ($objUser->getRole() == 'user')) ||
												(($_SESSION['user']->getId() == $objUser->getId()))){ ?>
											<div class="form_right">
												<a href="future_index.php?ctrl=user&action=delete_account&id=<?php echo($objUser->getId()); ?>" class="btn btn-danger">Supprimer l'utilisateur</a>
											</div>
										<?php } ?>
									</form>
								</div>
							</div>
						</div>