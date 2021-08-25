<?php
//Vérifier si l'utilisateur est bien connecté + activation session
require 'functions/check_connection.php';
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Raleway&family=Roboto+Slab&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="scss/style-create.css">
    <script src="format.js" defer></script>
    <title>Ajout d'un tuto</title>
</head>

<body>
    <form id="create_tuto" action="cible.php" method="POST" enctype="multipart/form-data">

        <?php

        //Si l'url contient un nom de tuto (n'est pas vide), cela signifie que c'est une modification de tuto déjà existant
        if (!empty($_GET)) {
            $_SESSION['update'] = true;
            //Connexion bdd
            require 'functions/connect_bdd.php';
            //Récupérer les infos du tuto à modifier
            $reponse = $bdd->prepare('SELECT * FROM tuto WHERE file_name = :required_tuto');
            $reponse->execute(array(
                'required_tuto' => $_GET['tuto']
            ));
            $donnees = $reponse->fetch();
            //Récupérer l'id du tuto demandé
            $_SESSION['id'] = $donnees['id'];
        } else {
            $_SESSION['update'] = false;
        }
        ?>
        <!--Si c'est une modification de tuto, on met le contenu dans les textarea et input, sinon on laisse vide-->
        <div class="input"><input type="text" name="titre" id="titre" placeholder="Titre" value="<?= isset($donnees) ? htmlspecialchars($donnees['titre']) : '' ?>"></div>
        <div class="form__contenu">
            <textarea name="description" id="Description" cols="30" rows="10" placeholder="Description" form="create_tuto"><?= isset($donnees) ? htmlspecialchars($donnees['description']) : '' ?></textarea>
            <div class="container_format">
                <button class="format" type="button" id="img" form="create_tuto">Image</button>
                <button class="format" type="button" id="h1" form="create_tuto">Titre</button>
                <button class="format" type="button" id="question" form="create_tuto">Question</button>
                <button class="format" type="button" id="transform" form="create_tuto">Bloc de code</button>
                <button class="format" type="button" id="span_code" form="create_tuto">Code</button>
                <button class="format" type="button" id="video" form="create_tuto">Vidéo</button>
            </div>
            <textarea name="contenu" id="contenu" cols="30" rows="10" placeholder="Contenu" form="create_tuto"><?= isset($donnees) ? htmlspecialchars($donnees['contenu']) : '' ?></textarea>
        </div>
        <div class="container__button">
            <button type="submit" name="submit" form="create_tuto">Envoyer</button>
            <button type="submit" name="save" form="create_tuto">Sauvegarder</button>
            <input type="file" name="fileToUpload" form="create_tuto">
    </form>
    <ul>
        <?php
        function is_dir_empty($dir)
        {
            if (!is_readable($dir)) return null;
            return (count(scandir($dir)) == 2);
        }

        if (!empty($_GET)) {
            $directory = './ressources/tuto/' . $_GET['tuto'];
            if (isset($_GET['remove'])) {
                if (unlink($_GET['remove'])) {
                    echo "This file has been removed";
                } else {
                    echo 'Something went wrong';
                }
            }

            $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

            if (!is_dir($directory)) {
                exit('Invalid diretory path');
            } elseif (is_dir_empty($directory)) {

                echo '
                <li>Aucune image</li>';
            } else {
                foreach (scandir($directory) as $file) {
                    if ($file !== '.' && $file !== '..') {
                        echo "
                            <li>{$file}
                                <img style='max-width:100px;' src='{$directory}/{$file}'>
                                <div class='img-control'>
                                    <button type='button' name='remove' value='{$directory}/{$file}'>Effacer</button

                                    </div>
                            </li>
                            ";
                    }
                }
            }
        }
        ?>
    </ul>
    </div>
    <div class="links">
        <a href="home.php">Retour</a>
        <a href="affiche_liste.php">Voir les commentaires</a>
    </div>

    <script src="copy.js"></script>
    <script src="remove_file.js"></script>
</body>

</html>