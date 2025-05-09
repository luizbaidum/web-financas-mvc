<?php

    use src\Diretorio;

    if (!isset($_SESSION) ||
        !isset($_SESSION['logado']) ||
        $_SESSION['logado'] !== true ||
        !isset($_SESSION['user']) ||
        !isset($_SESSION['nivel'])
    ) {
        header ('location: logout?erro=true');
    }
?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title ?? $this->empresa; ?></title>
    <link rel="stylesheet" href="<?= Diretorio::getBaseUrl() ?>/css/bootstrap.css">
    <link rel="stylesheet" href="<?= Diretorio::getBaseUrl() ?>/css/custom.css">
    <link rel="stylesheet" href="<?= Diretorio::getBaseUrl() ?>/css/media-query.css">
</head>