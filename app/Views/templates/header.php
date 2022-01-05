<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title><?=esc($title)?></title>
    <link rel="icon" type="image/jpeg" sizes="16x16" href="assets/img/favicon.jpg">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="assets/css/Contact-Form-Clean.css">
    <link rel="stylesheet" href="assets/css/Data-Table.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Dark.css">
    <link rel="stylesheet" href="assets/css/Navigation-with-Button.css">
    <link rel="stylesheet" href="assets/css/projet.css">
    <link rel="stylesheet" href="assets/css/Sidebar-Cool-SB-Admin-Inspirate.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/table.css">
    <link rel="stylesheet" href="assets/css/Ultimate-Sidebar-Menu.css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

  <body>
        <nav class="navbar navbar-dark bg-dark  navbar-expand-md text-light border rounded-0 navigation-clean-button">
        <div class="container"><a class="navbar-brand" href="<?= base_url();?>">Mon HLM</a><button data-toggle="collapse" data-target="#navcol-1" class="navbar-toggler"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="nav navbar-nav mr-auto">
                    <li class="nav-item"><a class="nav-link" href="<?= base_url();?>/Offres?page=1">Offres</a></li>
                </ul>
                <?php if (!empty($pseudo)) { ?>
                  <span class="navbar-text actions"><a class="login" href="<?= base_url();?>/gererprofil"><i class="fa fa-user"></i></a></span>
                <?php } else { ?>
                  <span class="navbar-text actions"><a class="login" href="<?= base_url();?>/Connexion"><i class="fa fa-user"></i></a></span>
                <?php } ?>

            </div>
        </div>
    </nav>