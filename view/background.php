<!--**********************************************************************************

                                    Background

***********************************************************************************-->

<!DOCTYPE html>

<html lang="fr">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <link rel="stylesheet" href="./public/fonts/fontawesome-5.0.4/css/fontawesome-all.css">
    
    <?php foreach ($GLOBALS['pageStylesheets'] as $stylesheet) { ?>
    
        <link rel="stylesheet" href="./public/css/<?= $stylesheet ?>.css" />
    
    <?php } ?>
   
    <link rel="icon" type="image/x-icon" href="./images/ico/favicon.ico" />
    <title><?= $GLOBALS['pageTitle'] ?></title>
    <meta name="description" content="Billet simple pour l'Alaska - Le livre en ligne de Jean Forteroche">
</head>


<body>

<div id='main'>
    <header>
        <a id='homepageLink' href='./' target=_self>
            <h1>Billet simple pour l'Alaska</h1>
            <div id='authorLine'></div>
            <span id='author'>Jean Forteroche</span>
        </a>
    </header>
    