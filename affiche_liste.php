<?php
require 'functions/check_connection.php';
require 'functions/connect_bdd.php';

$reponse = $bdd->query('SELECT * FROM tuto');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="scss/style_affiche.css">
    <title>Afficher la liste</title>
</head>
<body>
    <main>
<?php
while ($donnees = $reponse->fetch()) {
?>
    <div class="container_article">
        <h2><?= htmlspecialchars($donnees['titre']) ?></h2>
        <p><?= htmlspecialchars($donnees['description']) ?></p>
        <h3><?= htmlspecialchars($donnees['date_creation']) ?></h3>
        <?php 
        if(!$donnees['readable']):
            ?>
            <h3 style="color:red;">En cours de modif !</h3>
            <?php
        endif;
        ?>
        <a href="http://<?=$_SERVER['HTTP_HOST']?>/BDD-MySQL/affiche_tuto.php?name=<?= $donnees['file_name'] ?>"> <?= $donnees['titre'] ?></a>
        <a href="add_commentaire.php?tuto=<?=$donnees['file_name']?>">Modifier</a>
        <a href="delete.php?tuto=<?=$donnees['file_name']?>">Supprimer</a>
    </div>

<?php
}
$reponse->closeCursor();
?>
    </main>

<a href="home.php">Retour</a>
</body>
</html>
