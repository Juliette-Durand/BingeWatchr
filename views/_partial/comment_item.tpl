<div class="accordion-item comment_item">
                        <h2 class="accordion-header">
                            <div class="comment_item_content col-12 d-flex align-items-center justify-content-between">
                                <!-- Partie gauche -->
                                <div class="comment_item_left">
                                    <img src="assets/img/users/profile_pictures/{$objComment['user']->getAvatar()}" alt=""/>
                                    <span class="user_title ms-2">{$objComment['user']->getFull_name()}</span>
                                    <span class="infos_comm ms-2">{$objComment['comment']->getMovie_name()} - {$objComment['comment']->getDateFormat()}
                                        {if $objComment['picture']|isset}
                                            <i class="fa-solid fa-image ms-2"></i>
                                        {/if}
                                    </span>
                                </div>

                                <!-- Partie droite -->
                                <div class="comment_item_right d-flex align-items-center">
                                    <span class="comment_status">
                                        {if $objComment['comment']->getState() == "U"}
                                            <span class="status_xmark me-2"><i class="fa-solid fa-circle-xmark"></i></span>Non publié
                                        {else}
                                            <span class="status_check me-2"><i class="fa-solid fa-circle-check"></i></span>Publié
                                        {/if}
                                    </span>
                                    <a class="btn btn-primary ms-2" data-bs-toggle="collapse" href="#collapse{$objComment['comment']->getId()}" role="button" aria-expanded="true" aria-controls="collapse{$objComment['comment']->getId()}">
                                        Gérer le commentaire
                                    </a>
                                </div>
                            </div>
                        </h2>
                        <div id="collapse{$objComment['comment']->getId()}" class="accordion-collapse collapse" data-bs-parent="#accordionListUsers">
                            <div class="accordion-body mt-3">
                                <div class="user_list_form d-flex justify-content-between">
                                    <div class="form_left col-8">
                                        <span class="comm_title"><b>{$objComment['comment']->getTitle()}</b></span>
                                        <p class="comm_content">
                                            {$objComment['comment']->getContent()}
                                        </p>
                                    </div>
                                    
                                    <form method="POST" class="form_right d-flex align-items-start">
                                        <input type="hidden" name="id_comm" value="{$objComment['comment']->getId()}">
                                        <input type="submit" class="btn btn-secondary me-2" name="publish_state" value="{$objComment['comment']->getState() == "U" ? "Publier" : "Dépublier"}">
                                        <a href="index.php?ctrl=comment&action=delete_comment&id={$objComment['comment']->getId()}" class="btn btn-danger">Supprimer</a>
                                    </form>
                                </div>
                                {if $objComment['picture']|isset}
                                    <div class="pic_comm_container">
                                        {foreach $objComment['picture'] as $objPicture}
                                            <img src="assets/img/movies/movie_pictures/{$objPicture->getFile()}" alt="">
                                        {/foreach}
                                    </div>
                                {/if}
                            </div>
                        </div>
                    </div>