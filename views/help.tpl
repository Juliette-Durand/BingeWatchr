{**
 * Page contenant les aides
 * @author Hugo 
*}

{extends file="views/layout.tpl"}      

{block name="contenu"}
<div class="container">
    <div class="row">
        <div class="col-6">
            <h1>{$strTitle}</h1>

            {** Pour les Utilisateurs non connectés **}
                <h2 class="mt-3 fw-bold">Compte</h2>
                    <h3 class="mt-3 fs-4">Créer un compte</h3>
                        <ul>
                            <li>Se rendre sur l'onglet "S'inscrire" dans la barre de navigation</li>            
                            <li>Inscrire une adresse mail valide</li>            
                            <li>Créer un mot de passe qui respecte les règles de sécurité</li>            
                            <li>Confirmer son mot de passe en écrivant exactement le même que dans l'onglet au dessus</li>            
                        </ul>
                    <h3 class="mt-3 fs-4">Modifier les infos liées à son compte</h3>
                        <li>Se rendre sur sa photo de profil dans la barre de navigation</li>
                        <li>Cliquez sur "Modifier mon profil"</li>
                        <li>Modifiez les informations que vous souhaitez</li>
                        <li>Cliquez sur "Enregistrer"</li>
                <h2 class="mt-3 fw-bold">Connexion</h2>
                    <ul>
                        <li>Se rendre sur l'onglet "Se connecter" dans la barre de navigation</li>            
                        <li>Inscrire son adresse mail renseignée lors de l'inscription</li>            
                        <li>Rentrer son mot de passe créé lors de l'inscription</li>            
                    </ul>
                <h2 class="mt-3 fw-bold">Recherche d'un film</h2>
                    <p>Afin de rechercher un film spécifique parmis la liste complète, il faut se rendre dans l'onglet "Tous les films" dans la barre de navigation</p>
                    <h3 class="mt-3 fs-4">Recherche par mots clés</h3>
                        <ul>
                            <li>Taper dans la barre de recherche le film que vous souhaitez trouver (la recherche est basée sur les titres des films)</li>                    
                        </ul>
                    <h3 class="mt-3 fs-4">Recherche par filtres avancés</h3>
                        <ul>
                            <li>Rechercher par catégories : En cochant les catégories de films que l'on souhaite rechercher (il est possible d'en cocher plusieurs)</li>                    
                            <li>Rechercher par date de sortie de film : En mettant une date de début et une date de fin</li>                    
                            <li>Rechercher par durée de film : La recherche se fait en minutes avec un minimum de 0 minute et un maximum de 500 minutes</li>                    
                            <li>Valider en suite la recherche en cliquant sur le bouton "filtrer mes recherches"</li>                    
                            <li>Les filtres sont cumulables, il est tout à fait possible de filtrer ses recherches par catégories et par date de sortie en même temps par exemple</li>                    
                            <li>Lorsque vous commencez les filtres, que vous en avez renseigné plusieurs, et que vous voulez recommencer du début la recherche (avant de lancer la recherche en cliquant sur le bouton "filtrer mes recherches"), appuyez sur le bouton "Réinitialiser" afin de remettre les filtres à zéro</li>                    
                        </ul>

            {** Pour les Watchr **}
            {if $smarty.session.user|isset && $smarty.session.user->getRole() == "user"}
                <h2 class="mt-3 fw-bold">Commentaires</h2>
                <p>Il est possible de laisser des commentaires par films, pour ce faire, il faut :</p>
                <ul>
                    <li>Cliquer sur un film afin de se rendre sur sa fiche de renseignements</li>                      
                    <li>Dans l'espace dédié aux commentaires, ajouter un titre de commentaire afin de savoir de quoi vous allez parler</li>                    
                    <li>Dans le champs en dessous, ajouter votre commentaire</li>                                       
                    <li>Il est possible d'ajouter des photos liés aux commentaires (Attention : il y a une limite de 10 images par films)</li>                                       
                    <li>Tous les commentaires sont soumis à vérification par un modérateur</li>                                       
                </ul>
            {/if}    

            {** Pour les modérateurs **}
            {if $smarty.session.user|isset && ($smarty.session.user->getRole() == "admin" || $smarty.session.user->getRole() == "modo")}
                <h2 class="mt-3 fw-bold">Gestion des commentaires</h2>
                    <h3 class="mt-3 fs-4">Publier/Dépublier un commentaire via la page de gestion des commentaires</h3>
                        <li>Lorsqu'un utilisateur écrit un commentaire et qu'il l'envoie, le commentaire reste non publié et apparaît dans la page de gestion des commentaires. Pour valider le commentaire, il suffit de cliquer sur le commentaire, puis sur "publier" pour le valider.</li>
                    <h3 class="mt-3 fs-4">Supprimer un commentaire</h3>
                        <li>Toujours dans la page de gestion, en cliquant sur le commentaire, cliquez sur "supprimer" pour supprimer le commentaire définitivement</li>

                <h2 class="mt-3 fw-bold">Ajout de films</h2>  
                    <h3 class="mt-3 fs-4">Créer un nouveau film</h3>
                        <p>Lorsque vous voulez ajouter un nouveau film, il faut aller dans l'onglet "tous les films", puis en bas de la page, vous cliquez sur le bouton "Ajoutez le ici", ce qui vous ammènera à un formulaire où il faudra remplir les champs suivants :</p>
                        <li>L'affiche du film</li>
                        <li>Le titre du film</li>
                        <li>La date de sortie du film</li>
                        <li>La date de mise à l'affiche du film</li>
                        <li>La durée du film</li>
                        <li>Les acteurs qui jouent dans le film (avec la possibilité d'en ajouter en cliquant sur le bouton "Ajouter un acteur")</li>
                        <li>La/Les catégorie(s) du film</li>
                        <li>Le synopsis du film</li>
                        <li>Enfin, appuyez sur le bouton "Soumettre ce film" afin de le rentrer dans la base de données</li>
            {/if}

            {** Pour les Admins **}
            {if $smarty.session.user|isset && $smarty.session.user->getRole() == "admin"}
                
                <h2 class="mt-3 fw-bold">Gestion des rôles</h2>
                    <h3 class="mt-3 fs-4">Modifier un rôle</h3>
                        <li>Lors de l'inscription, par défaut l'utilisateur est Watchr.</li>
                        <li>Pour modifier un rôle utilisateur, allez dans la page de gestion des utilisateurs via l'onglet "Modération" puis "Gestion des utilisateurs". Ensuite, cliquez sur la ligne de l'utilisateur dont vous voulez changer le rôle, puis en cliquant sur son rôle vous pourrez choisir une autre option. Vous pouvez choisir entre "Administrateur", "Modérateur" ou "Watchr".</li>
                        <li>À noter qu'un administrateur ne peut ni changer le rôle d'un autre admin, ni le supprimer. Les droits s'appliquent sur les modérateurs et les Watchrs.</li>
                        <li>Attention : Une fois que l'on attribue le rôle d'admin à un utilisateur, on ne pourra plus le modifier !</li>
                <h2 class="mt-3 fw-bold">Gestion des utilisateurs</h2>  
                    <h3 class="mt-3 fs-4">Supprimer un utilisateur</h3>
                        <li>Pour supprimer un utilisateur, vous devez vous rendre sur la page de gestion des utilisateurs.</li>
                        <li>Cliquez sur la ligne correspondant au profil que vous souhaitez supprimer</li>
                        <li>Cliquez sur "Supprimer"</li>
            {/if}
        </div>
    </div>
</div>

{/block}