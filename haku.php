
<?php
require 'avusteet/kanta.php';
require 'avusteet/ylapalkki.php';
?>

<div class="container">

    <legend>Haku</legend>

    <form action="haku.php" method="POST">        
        <input type="text" name="hakusana" placeholder="Hakusana"/>
        <p><input class="btn" type="submit" value="Hae!"/></p>        
        <?php
        $yhteys = luo_kantayhteys();
        $hakukysely = $yhteys->prepare("select * from drinkki where nimi = ?");
        $nimi = ucfirst(strtolower($_POST['hakusana']));
        $hakukysely->execute(array($nimi));
        ?>

        <ul>
            <?php while ($drinkki = $hakukysely->fetchObject()) { ?>
                <li><a href="drinkki.php?drinkki=<?php echo $drinkki->id; ?>"><?php echo $drinkki->nimi; ?></a></li>
            <?php } ?>
        </ul>
</div>

<?php require 'avusteet/alapalkki.php'; ?>
