
<?php
require 'avusteet/kanta.php';
require 'avusteet/ylapalkki.php';
$kayttaja = kayttajatiedot();
?>
<div class="container">
    <?php
    if (!$kayttaja) {
        header('Location: index.php');
        exit();
    }
    ?>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['virhe'])) {
        echo "<p>" . $_SESSION['virhe'] . "</p>";
        unset($_SESSION['virhe']);
    }

//if (!empty($_POST['ainekset[0]']) && strlen($_POST['nimi']) > 0 && !empty($_POST['maarat[0]'])) {
    if (strlen($_POST['nimi']) > 0) {
        $yhteys = luo_kantayhteys();
        $aineet = $_POST['ainekset'];
        $nimi = $_POST['nimi'];
        $nimi = ucfirst(strtolower($nimi));
        $maara = $_POST['maarat'];
        $tarkistus = $yhteys->prepare("select count (*) from drinkki where nimi = ?");
        $tarkistus->execute(array($nimi));
        if ($tarkistus->fetchColumn() != 0) {
            $_SESSION['virhe'] = "Drinkki on jo olemassa!";
            header('Location: lisays.php');
            exit();
        }
        $drinkkilisays = $yhteys->prepare("insert into drinkki (nimi) values (?)");
        $drinkkilisays->execute(array($nimi));
        $drinkki_id = $yhteys->lastInsertId("drinkki_id_seq");
        $apu = 0;
        foreach ($maara as &$paljonko) {
            $ainetarkistus = $yhteys->prepare("select * from ainesosat where nimi = ?");
            $ainetarkistus->execute(array($aineet[$apu]));
            $ainetarkistus = $ainetarkistus->fetch();
            if ($ainetarkistus["id"] > 0) {
                $aine_id = $ainetarkistus["id"];
            } else {
                $ainelisays = $yhteys->prepare("insert into ainesosat (nimi) values (?)");
                $ainelisays->execute(array($aineet[$apu]));
                $aine_id = $yhteys->lastInsertId("ainesosat_id_seq");
            }
            $mixerlisays = $yhteys->prepare("insert into mixer (juoma, aine, maara) values (?, ?, ?)");
            $mixerlisays->execute(array($drinkki_id, $aine_id, $paljonko));
            $apu++;
        }
        echo 'Uusi juoma lisätty: ' . $nimi;
    } else if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $_SESSION['virhe'] = "Tarkista ettet jättänyt mitään tyhjäksi!";
        header('Location: lisays.php');
        exit();
    }
    ?>


    <?php if (isset($_SESSION['virhe'])) echo "<p>" . $_SESSION['virhe'] . "</p>"; ?>
    <?php unset($_SESSION['virhe']); ?>
    <form action="lisays.php" method="POST">

        <legend>Uusi drinkki</legend>


        <input type="text" name="nimi" placeholder="Drinkin nimi"></p>
        

        <div id="kentat">
            <input type="text" name="ainekset[]" placeholder="Aines">  <input type='text' placeholder="Määrä (cl)" name='maarat[]'/>

        </div>
        <input class="btn" type="button" value="Lisää uusi aine" onClick="lisaaKentta('kentat');"/>        
        <input class="btn" type="submit" value="Valmis!"/> 
    </form>

    <script>
            var laskuri = 1;
            var max = 10;
            function lisaaKentta(divName) {
                if (laskuri == max) {
                    alert("Ei saa olla yli " + laskuri + " ainetta!");
                }
                else {
                    var ainesdiv = document.createElement('div');
                    var valintadiv = document.createElement('div');
                    ainesdiv.innerHTML = "<input type='text' placeholder='Aines' name='ainekset[]'> <input type='text' placeholder='Määrä (cl)' name='maarat[]'>";



                    document.getElementById(divName).appendChild(ainesdiv);
                    laskuri++;
                }
            }
    </script>

</div>
<?php require 'avusteet/alapalkki.php'; ?>