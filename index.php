<?php
session_start();
$_SESSION['connected'] = false
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="scss/style_index.css">
    <title>Inscription</title>
</head>

<body>
    <form action="traitement_inscription.php" method="POST">
        <div class="container container_mdp1">
            <label for="mdp1">Mot de passe 1</label>
            <input type="password" name="mdp1" id="mdp1" placeholder="mdp 1">
        </div>
        <div class="container container_mdp2">
            <label for="mdp2">Mot de passe 2</label>
            <input type="password" name="mdp2" id="mdp2" placeholder="mdp 2">
        </div>

        <button type="submit">Valider</button>
    </form>
</body>

</html>