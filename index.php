<?php
require 'avusteet/kanta.php';
require 'avusteet/ylapalkki.php';
$kayttaja = kayttajatiedot();
?>

<div class="container">
    
<?php if (!$kayttaja) { ?>
<h2>Tervetuloa drinkkiarkistoon!</h2>
<p><a href="login.php">Kirjaudu sisään</a> tai <a href="register.php">rekisteröidy</a> lisätäksesi reseptejä.</p>
<p><a href="listaus.php">Listaa drinkit</a></p>
<p><a href="haku.php">Etsi drinkkiä</a></p>
<?php } ?>

<?php if ($kayttaja) { ?>
<h2>Tervetuloa drinkkiarkistoon!</h2>
<p>Olet kirjautunut käyttäjänä <b><?php echo $kayttaja->nimi; ?></b>.</p>
<p><a href="listaus.php">Listaa drinkit</a></p>
<p><a href="haku.php">Etsi drinkkiä</a></p>
<p><a href="lisays.php">Lisää uusi drinkki</a></p>
<?php } ?>

 </div>
<?php require 'avusteet/alapalkki.php'; ?>
