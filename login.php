
<?php
require 'avusteet/kanta.php';
require 'avusteet/ylapalkki.php';
?>

<div class="container">
    
    <?php
    if (isset($_POST["username"])) {
        $kysely = luo_kantayhteys()->prepare("select * from kayttajat where nimi = ? and salasana = ?");
        $kysely->execute(array($_POST["username"], $_POST["password"]));
        $kayttaja = $kysely->fetchObject();

        if ($kayttaja) {
            session_start();
            $_SESSION['id'] = $kayttaja->id;
            header('Location: index.php');
            exit();
        } else {
            $virhe = "<b>Käyttäjätunnus tai salasana väärin! :(</b>";
        }
    }
    ?>

    <legend>Kirjautuminen</legend>  

    <?php if (isset($virhe)) echo "<div class='alert alert-error'> $virhe </div>"; ?>

    <form action="login.php" method="POST">
        <p><input type="text" name="username" placeholder="Käyttäjätunnus"/></p>
        <p><input type="password" name="password" placeholder="Salasana"/></p>
        <button type="submit" class="btn">Kirjaudu</button>
    </form>

</div>
<?php require 'avusteet/alapalkki.php'; ?>