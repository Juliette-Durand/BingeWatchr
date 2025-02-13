<?php
/* Smarty version 5.4.3, created on 2025-02-13 15:33:32
  from 'file:views/_partial/head.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.3',
  'unifunc' => 'content_67ae10cc81ac22_28802104',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '97b3a0e53d689392ac57e3db3e43e476e2395506' => 
    array (
      0 => 'views/_partial/head.tpl',
      1 => 1739437048,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:views/_partial/nav.tpl' => 1,
  ),
))) {
function content_67ae10cc81ac22_28802104 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\wamp64\\www\\BingeWatchrs\\views\\_partial';
?>    
<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BingeWatchr - <?php echo $_smarty_tpl->getValue('strTitle');?>
</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <header>
        <?php $_smarty_tpl->renderSubTemplate("file:views/_partial/nav.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>

        <!-- Affichage du message de suppression de compte -->
        <?php if (((true && (true && null !== ($_smarty_tpl->getValue('_SESSION')['account_deletion']['error'] ?? null))))) {?>
            <div class="alert alert-danger">
                <?php echo $_smarty_tpl->getValue('_SESSION')['account_deletion']['error'];?>

            </div>
        <?php } elseif (((true && (true && null !== ($_smarty_tpl->getValue('_SESSION')['account_deletion']['success'] ?? null))))) {?>
            <div class="alert alert-success">
                <?php echo $_smarty_tpl->getValue('_SESSION')['account_deletion']['success'];?>

            </div>
        <?php }?>
    </header>

    <main><?php }
}
