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
    
    <link rel="apple-touch-icon" sizes="57x57" href="./public/images/ico/apple-touch/jf-57.png">
    <link rel="apple-touch-icon" sizes="72x72" href="./public/images/ico/apple-touch/jf-72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="./public/images/ico/apple-touch/jf-114.png">
    <link rel="apple-touch-icon" sizes="144x144" href="./public/images/ico/apple-touch/jf-144.png">

    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="@jeanforteroche">
    <meta name="og:locale" content="fr_FR">
    <meta name="og:site_name" content="Billet simple pour l'Alaska - Jean Forteroche">
    <meta property="og:title" content="Billet simple pour l'Alaska - Jean Forteroche">
    <meta property="og:url" content="http://www.projet4.ch-essaisweb.fr/">
    <meta property="og:type" content="website">
   
    <link rel="icon" type="image/x-icon" href="./public/images/ico/favicon.ico" />
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
    