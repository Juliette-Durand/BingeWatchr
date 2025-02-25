{if (count($arrErrors) > 0)}
<div class="alert alert-danger">
{foreach $arrErrors as $strError}
    <p>{$strError}</p>
{/foreach}
</div>
{/if}
{if ($strSuccess != "")}
<div class="alert alert-success">
    <p>{$strSuccess}</p>
</div>
{elseif ($strError != "")}
<div class="alert alert-danger">
    <p>{$strError}</p>
</div>
{/if}	