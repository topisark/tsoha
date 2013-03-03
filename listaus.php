
<?php
require 'avusteet/kanta.php';
require 'avusteet/ylapalkki.php';
?>

<div class="container">

    <?php
    $kysely = luo_kantayhteys()->prepare("select * from drinkki");
    $kysely->execute();
    ?>

    <legend>Kannassa olevat drinkit</legend>
    <ul>
        <?php while ($drinkki = $kysely->fetchObject()) { ?>
            <li><a href="drinkki.php?drinkki=<?php echo $drinkki->id; ?>"><?php echo $drinkki->nimi; ?></a></li>
        <?php } ?>
    </ul>

</div>
<?php require 'avusteet/alapalkki.php'; ?>