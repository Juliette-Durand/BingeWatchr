<div class="col-md-4 ">
	<div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
		<div class="col p-4 d-flex flex-column position-static">
			<h3 class="mb-0"><?php echo($objCommentEntity->getTitle()); ?></h3>
			<div class="mb-1 text-body-secondary">
				<?php echo($objCommentEntity->getDate()); ?> 
				(<?php echo($objCommentEntity->getUser_id()); ?>)
			</div>
			<p class="mb-auto"><?php echo($objCommentEntity->getContent()); ?></p>			
		</div>
		<div class="col-auto d-none d-lg-block">
			<img class="bd-placeholder-img mx-3" width="50" height="50" alt="User:  <?php echo($objCommentEntity->getUser_id()); ?>" 
			src="assets/img/users/profile_pictures/<?php echo($objCommentModel->findAvatarUser($objCommentEntity->getUser_id()));?>">
		</div>
	</div>
</div>