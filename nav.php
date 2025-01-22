
        <nav class="navbar navbar-expand-lg bg-body-tertiary head_navbar">
            <div class="container">
				<div class="d-flex justify-content-between align-items-center w-100">
						<a class="navbar-brand" href="index.php">BingeWatchr</a>
						<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
							<span class="navbar-toggler-icon"></span>
						</button>
					<div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
						<ul class="navbar-nav d-flex align-items-center">
							<li class="nav-item">
								<a class="nav-link" aria-current="page" href="index.php">Accueil</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="#">Ma collection</a>
							</li>
							<li class="nav-item dropdown">
								<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
									Modération
								</a>
								<ul class="dropdown-menu">
									<li><a class="dropdown-item" href="#">Demandes d'ajout de film</a></li>
									<li><a class="dropdown-item" href="#">Gestion des commentaires</a></li>
									<li><a class="dropdown-item" href="user_role_manage.php">Rôles des utilisateurs</a></li>
								</ul>
							</li>
							<li class="nav-item dropdown profile_picture">
								<a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
									<div class="pic_container"><img src="https://picsum.photos/200" alt=""></div>
								</a>
								<ul class="dropdown-menu">
									<li><a class="dropdown-item" href="compte.php">Mon compte</a></li>
									<li><a class="dropdown-item" href="#">Déconnexion</a></li>
								</ul>
							</li>
						</ul>
					</div>
				</div>
            </div>
        </nav>