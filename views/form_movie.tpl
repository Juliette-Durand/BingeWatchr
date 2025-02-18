	{**
	* Classe de formulaire pour ajoute nouve film
	* @author Arlind Halimi
	*}
	
	<div class="container"  id="form_movie">
	
		<form action="" method="post" id="movie_form" enctype="multipart/form-data">
			<div class="row g-5 py-3">
				{if count($arrErrors) > 0}
					<div class="alert alert-danger">
						{foreach $arrErrors as $strError}
							<p>{$strError}</p>
						{/foreach}
					</div>
				{/if}
				<div class="row pt-5"> 
					<div class="col-4">
						<label>Image * : <small class="secondPlan"> (5Mo max)</small></label>
						<input class="form-control {if $arrErrors['fichier']|isset} is-invalid {/if}" value="{$strPhoto}" name="fichier" type="file">
					</div>
					<div class="col-8">
						<div>
							<label for="name">Titre *</label>
							<input type="text" name="name" id="name" value="{$strTitleForm}"  class="form-control { if $arrErrors['name']|isset} is-invalid {/if}" >
						</div>
						<div>
							<label for="release">Date realise *</label>
							<input type="date" name="release" id="release" class="form-control {if $arrErrors['release']|isset} is-invalid {/if}" value="{$strDate}">
						</div>
						<div>
							<label for="display">Date mise a l'affiche</label>
							<input type="date" name="display" id="display" class="form-control {if $arrErrors['date']|isset} is-invalid {/if}" value="{$strMovieDisplay}">
						</div>
						<div>
							<label for="duration">Duration</label>
							<input type="time" name="duration" id="duration" class="form-control {if $arrErrors['duration']|isset} is-invalid {/if}" value="{$strDuration}">
						</div>
					</div>
					<div class="row">
						<div class="col-6">
							<div>
								<label for="actor">Actor</label>
								<select id="actor" name="actor" class="form-control  {if $arrErrors['actor']|isset} is-invalid {/if}">
									<option value="0" {if ($objActorModel->intActor == 0)} selected {else} {/if}>--</option>
									{foreach $arrActor as $arrDetActor} 
										{$objActorEntity->hydrate($arrDetActor)}
									<option value="{$objActorEntity->getId()}" 
											{if ($objActorModel->intActor == $objActorEntity->getId())} selected {else} {/if}>
										{$objActorEntity->getFirst_name()} {$objActorEntity->getLast_name()} 
									</option>
									{/foreach} 
								</select>
								
								
							</div>
						
						</div>
						<div class="col-6">
							<label for="new actor">Ajoute un actor</label> 
							<a href='future_index.php?ctrl=actor&action=form_actor' class="form-control btn btn-primary"  value="Ajoute un actor">Ajoute un actor </a>
						</div>
						
					</div> 
				</div>
				
				<div class="row">
					<div class="col-md-6">
						<label>Zone de texte synopsis*:</label>
						<textarea name="desc" class="form-control {if $arrErrors['desc']|isset} is-invalid {/if}" id="" value="{$strSynopsis}""></textarea>
					</div>
					<div class="col-md-6">
						<label>Zone de texte Notes*:</label>
						<textarea name="notes" class="form-control {if $arrErrors['notes']|isset} is-invalid {/if}" id="" value="{$strNotes}""></textarea>
					</div>
				</div>
				<div class="row mt-3">
					<div class="col-3">
						<input class="form-control btn btn-primary" type="submit"  value="Soumettre ce film">
					</div>
				</div>
		</form>
	</div>

