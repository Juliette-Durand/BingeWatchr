<?php 
	/**
	* Classe de pour envoye de mail
	* @author Arlind Halimi
	* @date 11/02/2025
	*/
?>
<div class="container col-6" id="contact">
	<form action="" method="post" id="movie_contact" enctype="multipart/form-data">
		<?php if(count($arrErrors)>0){ ?>
            <div class="alert alert-danger">
                <?php foreach($arrErrors as $strError){ ?>
                    <p><?php echo($strError); ?></p>
                <?php } ?>
            </div>
        <?php } ?>
		<div class="my-3">
			<label class="form-label" for="name" >Nom / Prénom</label>
			<input class="form-control" type="text" name="name" id="name" placeholder="Leo Messi" value="<?php echo($strName); ?>">
			<label class="form-label" for="mail" >Destination adresse-email</label>
			<input class="form-control" type="mail" name="mail" id="mail" value="<?php echo($strMail); ?>" placeholder="example@email.fr">
		
		</div>
		<div class="my-3">
			<label class="form-label" for="message">Message</label>
			<textarea class="form-control" name="message" id="message"><?php $strName ?>Hey, je viens de tomber sur ce film et je pense qu'il pourrait te plaire ! 
Link: <?php 
					$previous_page = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER']:'';
					echo($previous_page);
				?>
			</textarea>
		</div>
		<p>
			<input class="btn btn-primary" type="submit" value="Envoye mail" />
		</p>
	</form>
</div>