
<?php
require 'avusteet/kanta.php';
require 'avusteet/ylapalkki.php';
?>

<div class="container">
    <?php
    $drinkki = drinkkikysely($_GET["drinkki"]);
    $mixer = luo_kantayhteys()->prepare("select * from mixer where juoma = ?");
    $mixer->execute(array($drinkki->id));
    ?>

    <legend> <?php echo $drinkki->nimi ?> </legend>
    <p><b>Ainekset:</b></p>

    <?php
    while ($tulostus = $mixer->fetchObject()) {
        $aines = luo_kantayhteys()->prepare("select * from ainesosat where id = ?");
        $aines->execute(array($tulostus->aine));
        $rivi = $aines->fetch();
        echo $rivi["nimi"] . " " . $tulostus->maara . " cl<br>";
    }
    ?>
</div>
    <?php require 'avusteet/alapalkki.php'; ?>

