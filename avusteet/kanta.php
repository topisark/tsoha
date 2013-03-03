<?php

session_start();

function luo_kantayhteys() {
    try {
        $yhteys = new PDO("pgsql:host=localhost;dbname=topisark",
                        "topisark", "35646791e52441da");
    } catch (PDOException $e) {
        die("VIRHE: " . $e->getMessage());
    }
    $yhteys->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $yhteys;
}

function drinkkikysely($id) {
    $drinkkikysely = luo_kantayhteys()->prepare("select * from drinkki where id = ?");
    $drinkkikysely->execute(array($id));
    return $drinkkikysely->fetchObject();
}

function aineskysely($id) { 
    $aineskysely = luo_kantayhteys()->prepare("select * from ainesosat where id = ?");
    $aineskysely->execute(array($id));
    return $aineskysely->fetchObject();
}

function mixerkysely($id) {
    $mixerkysely = luo_kantayhteys()->prepare("select * from mixer where juoma = ?");
    $mixerkysely->execute(array($id));
    return $mixerkysely->fetchObject();
}

function kayttajatiedot() {
    session_start();
    $kayttajakysely = luo_kantayhteys()->prepare("select id, nimi, admin from kayttajat where id = ?");
    $kayttajakysely->execute(array($_SESSION["id"]));
    $kayttaja = $kayttajakysely->fetchObject();
    return $kayttaja;
}

?>
        