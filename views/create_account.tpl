{**
* Page de création d'un utilisateur
* @author Juliette Durand
*}
{extends file="views/layout.tpl"}

{block name="contenu"}
    <section class="container" id="create_account">
        <div class="container mb-5">
            <h1>{$strTitle}</h1>
        </div>
        <form method="post" class="row" enctype="multipart/form-data" >
            <div class="col-5">
                <input type="file" name="profile_picture" id="profile_picture">
            </div>
            <div class="col-7">
                <div class="mb-3">
                    <label for="id">Pseudo</label>
                    <input type="text" name="id" value="{$objUser->getId()}">
                </div>
        
                <div class="mb-3">
                    <label for="first_name">Prénom</label>
                    <input type="text" name="first_name" value="{$objUser->getFirst_name()}">
                </div>
        
                <div class="mb-3">
                    <label for="last_name">Nom</label>
                    <input type="text" name="last_name" value="{$objUser->getLast_name()}">
                </div>
        
                <div class="mb-3">
                    <label for="mail">Adresse email</label>
                    <input type="email" name="mail" value="{$objUser->getMail()}">
                </div>
        
                <div class="mb-3">
                    <label for="bio">Bio</label>
                    <textarea name="bio">{$objUser->getBio()}</textarea>
                </div>
        
                <div class="row">
                    <div class="col-6">
                        <p>Le mot de passe doit contenir :</p>
                        <ul class="pwd_conditions">
                            <li>au minimum 8 caractères</li>
                            <li>au moins une majuscule</li>
                            <li>au moins une minuscule</li>
                            <li>au moins un chiffre</li>
                            <li>au moins un caractère spécial</li>
                        </ul>
                    </div>
                    <div class="col-6">
                        {if count($arrErrorsPwd)>0}
                            <ul class="alert alert-danger">
                                Le mot de passe doit contenir :
                                {foreach $arrErrorsPwd as $strErrorPwd}
                                    <li>{$strErrorPwd}</li>
                                {/foreach}
                            </ul>
                        {/if}
                        <div class="mb-3">
                            <label for="password">Mot de passe</label>
                            <input type="password" name="password">
                        </div>
                        <div>
                            <label for="confirm_pwd">Confirmation mot de passe</label>
                            <input type="password" name="confirm_pwd">
                        </div>
                    </div>
                </div>
                
                <input type="submit" class="btn btn-primary" value="Créer mon compte">
            </div>

        </form>
    </section>
{/block}