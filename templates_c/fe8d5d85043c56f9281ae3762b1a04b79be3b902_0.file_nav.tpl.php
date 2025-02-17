<?php
/* Smarty version 5.4.3, created on 2025-02-17 15:00:35
  from 'file:views/_partial/nav.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.3',
  'unifunc' => 'content_67b34f136be9c5_86957110',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'fe8d5d85043c56f9281ae3762b1a04b79be3b902' => 
    array (
      0 => 'views/_partial/nav.tpl',
      1 => 1739438240,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_67b34f136be9c5_86957110 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\wamp64\\www\\BingeWatchrs\\views\\_partial';
?>		        <nav class="navbar navbar-expand-lg bg-body-tertiary head_navbar">
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
							<li class="nav-item">
								<a class="nav-link" href="collection.php">Ma collection</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="index.php?ctrl=movie&action=allmovies">Tous les films</a>
							</li>
							<?php if ((((true && (true && null !== ($_smarty_tpl->getValue('_SESSION')['user'] ?? null)))) && ($_smarty_tpl->getValue('_SESSION')['user']->getRole() != "user"))) {?>
								<li class="nav-item dropdown">
									<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
										Modération
									</a>
	
									<ul class="dropdown-menu">
										<li><a class="dropdown-item" href="#">Demandes d'ajout de film</a></li>
										<li><a class="dropdown-item" href="#">Gestion des commentaires</a></li>
										<li><a class="dropdown-item" href="index.php?ctrl=user&action=user_role_manage">Gestion des utilisateurs</a></li>
									</ul>
								</li>
							<?php }?>
							<?php if (((true && (true && null !== ($_smarty_tpl->getValue('_SESSION')['user'] ?? null))))) {?>
									<li class="nav-item dropdown profile_picture">
										<a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
											<div class="pic_container"><img src="assets/img/users/profile_pictures/<?php echo $_smarty_tpl->getValue('_SESSION')['user']->getAvatar();?>
" alt=""></div>
										</a>
										<ul class="dropdown-menu">
											<li><a class="dropdown-item" href="index.php?ctrl=user&action=my_account">Mon compte</a></li>
											<li><a class="dropdown-item" href="index.php?ctrl=user&action=logout">Déconnexion</a></li>
										</ul>
									</li>
							<?php } else { ?>
								<a href="index.php?ctrl=user&action=create_account" class="btn btn-secondary">S'inscrire</a>
								<a href="index.php?ctrl=user&action=login" class="btn btn-primary">Se connecter</a>
							<?php }?>
						</ul>
					</div>
				</div>
            </div>
        </nav><?php }
}
