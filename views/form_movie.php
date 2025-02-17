<?php 
	/**
	* Classe de formulaire pour ajoute nouve film
	* @author Arlind Halimi
	*/
?>


	<div class="container"  id="form_movie">
	
		<form action="" method="post" id="movie_form" enctype="multipart/form-data">
			<div class="row g-5 py-3">
				<?php if (count($arrErrors) > 0){ ?>
					<div class="alert alert-danger">
						<?php foreach($arrErrors as $strError){ ?>
							<p><?php echo $strError; ?></p>
						<?php } ?>
					</div>
				<?php } ?>
				<div class="row pt-5"> 
					<div class="col-4">
						<label>Image * : <small class="secondPlan"> (5Mo max)</small></label>
						<input class="form-control <?php echo (isset($arrErrors['fichier']))?'is-invalid':'';  ?>" value="<?php echo($strPhoto) ?>" name="fichier" type="file">
					</div>
					<div class="col-8">
						
						<div>
							<label for="name">Titre *</label>
							<input type="text" name="name" id="name" value="<?php echo($strTitleForm); ?>"  class="form-control <?php echo (isset($arrErrors['name']))?'is-invalid':''; ?>" >
						</div>
						<div>
							<label for="release">Date realise *</label>
							<input type="date" name="release" id="release" class="form-control <?php echo (isset($arrErrors['release']))?'is-invalid':''; ?>" value="<?php echo($strDate); ?>">
						</div>
						<div>
							<label for="display">Date mise a l'affiche</label>
							<input type="date" name="display" id="display" class="form-control <?php echo (isset($arrErrors['date']))?'is-invalid':''; ?>" value="<?php echo($strMovieDisplay); ?>">
						</div>
						<div>
							<label for="duration">Duration</label>
							<input type="time" name="duration" id="duration" class="form-control <?php echo (isset($arrErrors['duration']))?'is-invalid':''; ?>" value="<?php echo($strDuration); ?>">
						</div>
					</div>
					<div class="row">
						<div class="col-6">
							<div>
								<!-- Select actor -->

								<label for="actor">Actor</label>
								<select id="actor" name="actor" class="form-control  <?php echo (isset($arrErrors['actor']))?'is-invalid':''; ?>">
									<option value="0" <?php echo(($objActorModel->intActor == 0)?"selected":"");?> >--</option>
									<?php foreach ($arrActor as $arrDetActor) { 
										$objActorEntity->hydrate($arrDetActor);
									?> 
									<option value="<?php echo($objActorEntity->getId()); //=> Utiliser le getter ?>" 
											<?php echo (($objActorModel->intActor == $objActorEntity->getId())?"selected":"");?> >
										<?php echo($objActorEntity->getFirst_name()." ". $objActorEntity->getLast_name()); ?> 
									</option>
									<?php }	?>
								</select>
							</div>
							
		
							<div>
								
							<!-- Select category -->
							<label for="category">Category</label>
							<select id="category" name="category" class="form-control <?php echo (isset($arrErrors['category']))?'is-invalid':''; ?>">
								<option value="0" >--</option>
								<?php foreach ($arrCategory as $arrDetCategory) { ?>
									<?php //$objCategoryEntity->hydrate($category); ?>
									<?php $objCategoryEntity->setId($arrDetCategory['cat_id']); ?>
									<?php $objCategoryEntity->setName($arrDetCategory['cat_name']); ?>
									<option value="<?php echo $objCategoryEntity->getId(); ?>" >
										<?php echo $objCategoryEntity->getName(); ?> 
									</option>
								<?php }	?>
							</select>
						</div>
					</div>
						<div class="col-6">
							<label for="new actor"></label> 
							<a href='future_index.php?ctrl=actor&action=form_actor' class="form-control btn btn-primary"  value="Ajoute un actor">Ajoute un actor </a>
						</div>
						
					</div> 
				</div>
				
				<div class="row">
					<div class="col-md-6">
						<label>Zone de texte synopsis*:</label>
						<textarea name="desc" class="form-control <?php echo (isset($arrErrors['desc']))?'is-invalid':''; ?>" id="" value="<?php echo($strSynopsis) ?>"></textarea>
					</div>
					
				</div>
				<div class="row mt-3">
					<div class="col-3">
						<input class="form-control btn btn-primary" type="submit"  value="Soumettre ce film">
					</div>
				</div>
		</form>
	</div>

