<div class="accordion-item user_item">
							<h2 class="accordion-header">
								<div class="user_item_content col-12 d-flex align-items-center justify-content-between">
									<!-- Partie gauche -->
									<div class="user_item_left">
										<img src="assets/img/users/profile_pictures/{$objUser->getAvatar()}" alt=""/>
										<span class="user_title ms-2">{$objUser->getFull_name()}</span>
										<span class="user_pseudo ms-2">{$objUser->getId()}</span>
									</div>

									<!-- Partie droite -->
									<div class="user_item_right d-flex align-items-center">
										<span class="user_role">
											{if $objUser->getRole() == "user" }
												{"Watchr"}
											{elseif $objUser->getRole() == "modo" }
												{"Modérateur"}
											{elseif $objUser->getRole() == "admin" }
												{"Administrateur"}
											{/if}
										</span>
										<a class="btn btn-primary ms-2" data-bs-toggle="collapse" href="#collapse{$objUser->getId()}" role="button" aria-expanded="true" aria-controls="collapse{$objUser->getId()}">
											Gérer l'utilisateur
										</a>
									</div>
								</div>
							</h2>
							<div id="collapse{$objUser->getId()}" class="accordion-collapse collapse" data-bs-parent="#accordionListUsers">
								<div class="accordion-body mt-3">
									<form method="POST" class="user_list_form d-flex justify-content-between align-items-end">
										{if (($smarty.session.user->getRole() == 'admin') && ($objUser->getRole() != 'admin'))}
										<div class="form_left">
											<input type="hidden" name="user" value="{$objUser->getId()}">
											<select name="role">
												<option value="user" {if ($objUser->getRole() == "user")} selected {/if} >Watchr</option>
												<option value="modo" {if ($objUser->getRole() == "modo")} selected {/if} >Modérateur</option>
												<option value="admin" {if ($objUser->getRole() == "admin")} selected {/if} >Administrateur</option>
											</select>
	
											<input type="submit" class="btn btn-secondary mt-2" value="Enregistrer les modifications">
										</div>
										{/if}

										{if ((($smarty.session.user->getRole() == 'admin') && ($objUser->getRole() != 'admin')) ||
												(($smarty.session.user->getRole() == 'modo') && ($objUser->getRole() == 'user')) ||
												(($smarty.session.user->getId() == $objUser->getId())))}
											<div class="form_right">
												<a href="index.php?ctrl=user&action=delete_account&id={$objUser->getId()}" class="btn btn-danger">Supprimer l'utilisateur</a>
											</div>
										{/if}
									</form>
								</div>
							</div>
						</div>