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
<h2><p> Crash Coders </p></h2>
<form action="pointeuse.php">
<div class="cible">
    
    <?php
    $name = $_POST['choice'];
    $slot = $_POST['when'];
    $mod = $_POST['pointage'];
    $clock = date('H:i');

echo '<div class="info">';
echo '<div class="infoNum"><li><p>', " Pointage de l'apprenant : <u>$name</u> effectué. Authentification achevé ", '</p></li></div>';
echo '<divclass="infoClock"><li><p>', "Votre pointage s'effectue pour <strong> $clock  </strong>, merci de ne pas dépasser 15 minutes de pauses !",'</p></li></div>';
echo '</div>';   
?>
<input type="submit" value="Pointeuse Numerique" id="pn">
</div>
<?php
$bdd = new PDO('mysql:host=localhost;dbname=TIME_DB', 'Bestory', 'TPdev_log');
$requete = $bdd->query("UPDATE BREAK_OUT SET TIME_SLOT = '$slot' WHERE DEV_NAME = '$name' ");
$reponse = $bdd->query("UPDATE BREAK_OUT SET $mod = CURTIME() WHERE DEV_NAME = '$name' ");

?>
</body>
</html>