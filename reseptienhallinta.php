<?php
require 'avusteet/kanta.php';
require 'avusteet/ylapalkki.php';
$kayttaja = kayttajatiedot();
if ($kayttaja->admin != true) {
    header('Location: index.php');
    exit();
}

if (isset($_POST["poista"])) {
    $mixerpoisto = luo_kantayhteys()->prepare("delete from mixer where juoma = ?");
    $mixerpoisto->execute(array($_POST["poista"]));   
    
    $drinkkipoisto = luo_kantayhteys()->prepare("delete from drinkki where id = ?");
    $drinkkipoisto->execute(array($_POST["poista"]));   
    
    unset($_POST["poista"]);
}

?>
<div class="container">

    <?php
    $kysely = luo_kantayhteys()->prepare("select * from drinkki");
    $kysely->execute();
    ?>

    <table class="table table-bordered">
        <?php
        echo "<th>Id</th>";
        echo "<th>Nimi</th>";
        echo "<th>Poista</th>";
        while ($rivi = $kysely->fetch()) {
            $apu = $rivi["id"];
            echo "<tr>";
            echo "<td>" . $rivi["id"] . "</td>";
            echo "<td>" . $rivi["nimi"] . "</td>";            
            echo "<td> <form action='reseptienhallinta.php' method='post'><input type='text' name='poista' value='$apu' style='display:none'><input class='btn btn-danger' type='submit' value='Poista' /></form> </td>";
            echo "</tr>";
        }
        ?>
    </table>

</div>
<?php require 'avusteet/alapalkki.php'; ?>