{**
 * Page contenant les aides
 * @author Hugo 
*}

{extends file="views/layout.tpl"}      

{block name="contenu"}

<h1>{$strTitle}</h1>

{if ((isset($_SESSION['user'])) && ($_SESSION['user']->getRole() != "user"))}
    
{/if}

{/block}