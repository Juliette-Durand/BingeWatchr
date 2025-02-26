{if (count($arrErrors) > 0)}
    <div class="container alert alert-danger">
        {foreach $arrErrors as $strError}
            <p>{$strError}</p>
        {/foreach}
    </div>
{/if}
{if ($strSuccess != "")}
<div class="container alert alert-success">
    <p>{$strSuccess}</p>
</div>
{elseif ($strError != "")}
<div class="container alert alert-danger">
    <p>{$strError}</p>
</div>
{/if}	