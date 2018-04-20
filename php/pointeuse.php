<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/pointeuse.css">
    <link rel="stylesheet" href="../css/animation.css">
    <title>Pointeuse de pause</title>
</head>
<header>
    <div>
    <h1> P O I N T E U S E</h1></div><div><img src="../img/sablier.svg" alt="Sablier"></div><div><h1>N U M E R I Q U E </h1></div>
</div>
</header>
<body>
<!-- <embed src="../trySound/retroSound.mp3" autostart="true" loop="false" hidden="true"></embed> -->
    <form method="POST" action="phpCible.php">
       <h2><p> Crash Coders </p></h2>
    <div id="first">
        <div>
    <select name="choice" id="choice" required>
    <option> Vous êtes ? </option>
    <?php
    try {
        $bdd = new PDO('mysql:host=192.168.1.55;dbname=crashcoders-pointeuse', 'Caroline', 'motdepasse');
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $reponse = $bdd->query('SELECT * FROM BREAK_OUT');
        while ($file = $reponse->fetch()) {
            echo "<option>", $file['DEV_NAME'], "</option>";
        }
    }
    catch(PDOException $e)
              {
                print "Erreur !: " . $e->getMessage() . "<br/>";
              }
    ?>
    </select>
    </div>
    <div>
    <select name="when" id="when" required>
    <option> Plage Horaire </option>
    <?php
    $reponse = $bdd->query('SELECT * FROM T_SLOT');
    while ($file = $reponse->fetch()) {
        echo "<option>", $file['Matin'], "</option>";
        echo "<option>", $file['apres_midi'], "</option>";
    }
    ?>
</select>
</div>
<div class="check">
<select name="pointage" id="pointage" required>
<option> Mode </option>
<?php
$reponse = $bdd->query('SELECT * FROM TB_MOD');
while ($file = $reponse->fetch()) {
    echo "<option>", $file['pointage_x'], "</option>";
    echo "<option>", $file['depointage_x'], "</option>";
}
?>
</div>
    
<?php
$name = $_POST['choice'];
$slot = $_POST['when'];
$mod = $_POST['pointage'];
// $reponse = $bdd->query("UPDATE BREAK_OUT SET POINTAGE = CURTIME() WHERE DEV_NAME =  '$name' ");
$requete = $bdd->query("UPDATE BREAK_OUT SET TIME_SLOT = '$slot' WHERE DEV_NAME = '$name' ");
$reponse = $bdd->query("UPDATE BREAK_OUT SET $mod = CURTIME() WHERE DEV_NAME = '$name' ");
?>

<div>
    <input type="submit" name="breakOut" id="breakOut" value="Let's Go !"><br/>
</div>
    </div>

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="../js/pointeuse.js" type="text/javascript"></script>

<?php
$bdd->close();
session_destroy();
?>
</form>
</body>
</html>