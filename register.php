
<?php
require 'avusteet/kanta.php';
require 'avusteet/ylapalkki.php';
?>
<div class="container">
    <html>    
        <legend>Rekisteröidy plz!</legend>
        
        <?php if (isset($_SESSION['virhe'])) echo "<div class='alert alert-error'>" . $_SESSION['virhe'] . "</div>"; ?>
        <?php unset($_SESSION['virhe']); ?>
        <form action="reg.php" method="post">            
            <input type="text" name="nimi" placeholder="Käyttäjätunnus"></p>
            <input type="password" name="salasana" placeholder="Salasana"></p>
            <button type="submit" class="btn">Rekisteröidy</button>
        </form>

</div>
<?php require 'avusteet/alapalkki.php'; ?>