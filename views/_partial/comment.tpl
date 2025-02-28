<div class="">
	<div class="g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
		<div class="col p-4 d-flex flex-column position-static">
			<div class="d-flex">
				<img class="bd-placeholder-img me-3" width="50" height="50" alt="User: {$objCommentEntity->getUser_id()}" 
				src="assets/img/users/profile_pictures/{$objCommentModel->findAvatarUser($objCommentEntity->getUser_id())}">

				<h3 class="mb-0">{$objCommentEntity->getTitle()}</h3>
			</div>
			<div class="mb-1 text-body-secondary">
				{$objCommentEntity->getDate()} 
				({$objCommentEntity->getUser_id()})
			</div>
			<p class="mb-auto">{$objCommentEntity->getContent()}</p>			
		</div>
		<div class="col-auto d-none d-lg-block">
		</div>
	</div>
</div>