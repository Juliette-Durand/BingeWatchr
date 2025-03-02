		{**
		* Barre de navigation permettant d'accéder aux différentes pages
		* @author Juliette Durand
		*}
        <nav class="navbar navbar-expand-lg bg-body-tertiary head_navbar">
            <div class="container">
				<div class="d-flex justify-content-between align-items-center w-100">
						<a class="navbar-brand" href="index.php?ctrl=movie&action=home">BingeWatchr</a>
						<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
							<span class="navbar-toggler-icon"></span>
						</button>
					<div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
						<ul class="navbar-nav d-flex align-items-center">
							<li class="nav-item">
								<a class="nav-link" href="index.php?ctrl=movie&action=home">Accueil</a>
							</li>
							{* <li class="nav-item">
								<a class="nav-link" href="collection.php">Ma collection</a>
							</li> *}
							<li class="nav-item">
								<a class="nav-link" href="index.php?ctrl=movie&action=allmovies">Tous les films</a>
							</li>
							{if ((isset($smarty.session.user)) && ($smarty.session.user->getRole() != "user"))}
								<li class="nav-item dropdown">
									<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
										Modération
									</a>
	
									<ul class="dropdown-menu">
										{* <li><a class="dropdown-item" href="#">Demandes d'ajout de film</a></li> *}
										<li><a class="dropdown-item" href="index.php?ctrl=comment&action=comment_manage">Gestion des commentaires</a></li>
										<li><a class="dropdown-item" href="index.php?ctrl=user&action=user_role_manage">Gestion des utilisateurs</a></li>
									</ul>
								</li>
							{/if}
							{if $smarty.session.user|isset}
									<li class="nav-item dropdown profile_picture">
										<a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
											<div class="pic_container"><img src="assets/img/users/profile_pictures/{$smarty.session.user->getAvatar()}" alt=""></div>
										</a>
										<ul class="dropdown-menu">
											<li><a class="dropdown-item" href="index.php?ctrl=user&action=my_account">Mon compte</a></li>
											<li><a class="dropdown-item" href="index.php?ctrl=user&action=logout">Déconnexion</a></li>
										</ul>
									</li>
							{else}
								<a href="index.php?ctrl=user&action=create_account" class="btn btn-secondary">S'inscrire</a>
								<a href="index.php?ctrl=user&action=login" class="btn btn-primary">Se connecter</a>
							{/if}
							<li>
								<a href="index.php?ctrl=user&action=help" class="btn btn-secondary rounded-circle"><i class="fa-solid fa-question"></i></a>
							</li>
							{if $smarty.session.user|isset}
								<li class="ms-3">
									Connecté en tant que<br>
									<b>
										{if $smarty.session.user->getRole() == "user" }
											{"Watchr"}
										{elseif $smarty.session.user->getRole() == "modo" }
											{"Modérateur"}
										{elseif $smarty.session.user->getRole() == "admin" }
											{"Administrateur"}
										{/if}
									</b>
								</li>
							{/if}
						</ul>
					</div>
				</div>
            </div>
        </nav>