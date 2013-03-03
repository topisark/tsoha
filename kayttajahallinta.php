<?php
require 'avusteet/kanta.php';
require 'avusteet/ylapalkki.php';
$kayttaja = kayttajatiedot();
if ($kayttaja->admin != true) {
    header('Location: index.php');
    exit();
}

function teeAdmin($id) {
    $muokkaus = luo_kantayhteys()->prepare("update kayttajat set admin = true where id = ?");
    $muokkaus->execute(array($id));
}

function teeKayttaja($id) {
    $muokkaus = luo_kantayhteys()->prepare("update kayttajat set admin = false where id = ?");
    $muokkaus->execute(array($id));
}

function poistaKayttaja($id) {
    $muokkaus = luo_kantayhteys()->prepare("delete from kayttajat where id = ?");
    $muokkaus->execute(array($id));
}

if (isset($_POST["kayttajaksi"])) {
    teeKayttaja($_POST["kayttajaksi"]);
    unset($_POST["kayttajaksi"]);
}

if (isset($_POST["adminiksi"])) {
    teeAdmin($_POST["adminiksi"]);
    unset($_POST["adminiksi"]);
}

if (isset($_POST["poista"])) {
    poistaKayttaja($_POST["poista"]);
    unset($_POST["poista"]);
}

?>
<div class="container">

    <?php
    $kysely = luo_kantayhteys()->prepare("select * from kayttajat");
    $kysely->execute();
    ?>

    <table class="table table-bordered">
        <?php
        echo "<th>Id</th>";
        echo "<th>Nimi</th>";
        echo "<th>Admin/käyttäjä</th>";
        echo "<th>Poista</th>";
        while ($rivi = $kysely->fetch()) {
            $apu = $rivi["id"];
            echo "<tr>";
            echo "<td>" . $rivi["id"] . "</td>";
            echo "<td>" . $rivi["nimi"] . "</td>";
            if ($rivi["admin"]) {                
                echo "<td> <form action='kayttajahallinta.php' method='post'><input type='text' name='kayttajaksi' value='$apu' style='display:none'><input class='btn btn-warning' type='submit' value='Käyttäjäksi' /></form> </td>";
            } else {                
                echo "<td> <form action='kayttajahallinta.php' method='post'><input type='text' name='adminiksi' value='$apu' style='display:none'><input class='btn btn-info' type='submit' value='Adminiksi' /></form> </td>";
            }
            echo "<td> <form action='kayttajahallinta.php' method='post'><input type='text' name='poista' value='$apu' style='display:none'><input class='btn btn-danger' type='submit' value='Poista' /></form> </td>";
            echo "</tr>";
        }
        ?>
    </table>

</div>
<?php require 'avusteet/alapalkki.php'; ?>