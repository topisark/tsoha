<?php
require 'avusteet/kanta.php';
require 'avusteet/ylapalkki.php';
?>

<div class="container">

<?php
$yhteys = luo_kantayhteys();
$tarkistus = $yhteys->prepare("select count (*) from kayttajat where nimi = ?");
$tarkistus->execute(array($_POST["nimi"]));
$kysely = $yhteys->prepare("INSERT INTO kayttajat (nimi, salasana) VALUES (?, ?)");

if (empty($_POST["nimi"]) || empty($_POST["salasana"])) {
    $_SESSION['virhe'] = "Käyttäjätunnus tai salasana ei saa olla tyhjä!";
    header('Location: register.php');
    exit();
}

if ($tarkistus->fetchColumn() != 0) {
    $_SESSION['virhe'] = "Käyttäjätunnus on jo olemassa!";
    header('Location: register.php');
    exit();
}

if (!empty($_POST["nimi"]) && !empty($_POST["salasana"])) {
    $kysely->execute(array($_POST["nimi"], $_POST["salasana"]));
}

else {
    $_SESSION['virhe'] = "Käyttäjätunnus tai salasana ei saa olla tyhjä!";
    header('Location: register.php');        
    exit();
}

$id = $yhteys->lastInsertId("kayttajat_id_seq");

$nimikysely = $yhteys->prepare("SELECT nimi from kayttajat where id = $id");
$nimikysely->execute();
$nimi = $nimikysely->fetch();
echo "<div class='alert alert-success'> Uuden käyttäjän nimi:<strong> $nimi[0] </strong></div>";
?>
<p><a href="login.php">Kirjaudu sisään</a></p>
</div>
<?php require 'avusteet/alapalkki.php'; ?>
