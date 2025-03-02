	{**
	* Page de gestion des rôles des utilisateurs
	* @author Juliette Durand
	*}
{extends file="views/layout.tpl"}

{block name="contenu"}
		<div class="container mb-5">
			<h1>{$strTitle}</h1>
		</div>
		
        <section class="container" id="users_list_role">
            <div class="row">
				<div class="search my-4">
					<form method="post" id="searchUser">
						<input type="hidden" name="search" value="search">
						<input type="text" name="keyWord" id="keyWord" value="{$strKeyword}">

						<input type="submit" value="Rechercher">
					</form>
				</div>
				<div class="accordion" id="accordionListUsers">
				{foreach $arrUser as $objUser}
					{include file="views/_partial/user_item.tpl"}
					{/foreach}
				</div>
			</div>
        </section>
{/block}