<?php $kayttaja = kayttajatiedot(); ?>
<!DOCTYPE HTML>
<!DOCTYPE html>
<html lang="en">

    <head>
        <!-- Bootstrap -->
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <meta charset="utf-8">
        <title>Drinkkiarkisto!</title>

        <!-- Le styles -->
        <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
        <style>
            body {
                padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
            }
        </style>
        <link href="bootstrap/css/bootstrap-responsive.css" rel="stylesheet">

        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
          <script src="../assets/js/html5shiv.js"></script>
        <![endif]-->

        <!-- Fav and touch icons -->
       
        <link rel="stylesheet" href="bootstrap/css/bootstrap-responsive.css" type="text/css"/>
        <link rel="stylesheet" href="bootstrap/css/bootstrap.css" type="text/css">


    </head>

    <body>
        <script src="http://code.jquery.com/jquery.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>

        <div class="navbar navbar-inverse navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">
                    <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="brand" href="index.php">Drinkkiarkisto</a>
                    <div class="nav-collapse collapse">
                        <ul class="nav">
                            <li><a href="listaus.php">Listaus</a></li>
                            <li><a href="haku.php">Haku</a></li>
                            <?php if (!$kayttaja) { ?>                            
                                <li><a href="login.php">Kirjaudu</a></li>
                                <li><a href="register.php">Rekisteröidy</a></li>                                  
                            <?php } ?>
                            <?php if ($kayttaja) { ?>
                                <li><a href="lisays.php">Lisää drinkki</a></li>
                                <li><a href="logout.php">Kirjaa ulos käyttäjä <?php echo $kayttaja->nimi; ?> </a></li>
                            <?php } ?>

                            <?php if ($kayttaja->admin == true) { ?>
                                <li><a href="kayttajahallinta.php">Käyttäjienhallinta</a></li>
                                <li><a href="reseptienhallinta.php">Reseptienhallinta</a></li>
                            <?php } ?>

                        </ul>
                    </div><!--/.nav-collapse -->
                </div>
            </div>
        </div>




