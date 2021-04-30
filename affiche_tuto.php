<?php
require 'functions/check_connection.php';
require 'functions/connect_bdd.php';
$required_tuto = $_GET['name'];

$reponse = $bdd->prepare('SELECT * FROM tuto WHERE file_name = :required_tuto');
$reponse->execute(array(
    'required_tuto'=>$required_tuto
));
$donnees = $reponse->fetch();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="prism.css">
    <title><?= $donnees['titre'] ?></title>
</head>
<body>
    <?php
    echo $donnees['contenu'];
    $reponse->closeCursor();
    ?>
    <script src="prism.js"></script>
</body>
</html>