<section class="container" id="create_account">
    <form method="post" class="row" enctype="multipart/form-data" >
        <div class="col-5">
            <input type="file" name="profile_picture" id="profile_picture">
        </div>
        <div class="col-7">
            <div class="mb-3">
                <label for="id">Pseudo</label>
                <input type="text" name="user_id">
            </div>
    
            <div class="mb-3">
                <label for="first_name">Prénom</label>
                <input type="text" name="user_first_name">
            </div>
    
            <div class="mb-3">
                <label for="last_name">Nom</label>
                <input type="text" name="user_last_name">
            </div>
    
            <div class="mb-3">
                <label for="mail">Adresse email</label>
                <input type="text" name="user_mail">
            </div>
    
            <div class="mb-3">
                <label for="bio">Bio</label>
                <textarea name="user_bio"></textarea>
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
                    <div class="mb-3">
                        <label for="password">Nouveau mot de passe</label>
                        <input type="text" name="user_password">
                    </div>
                    <div>
                        <label for="confirm_pwd">Confirmation mot de passe</label>
                        <input type="text" name="confirm_pwd">
                    </div>
                </div>
            </div>
            
            <input type="submit" class="btn btn-primary" value="Créer mon compte">
        </div>

    </form>
</section>