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
    <title>Ajout d'un tuto</title>
</head>

<body>
        <form action="cible.php" method="POST">
        <?php
        
        //Si l'url contient un nom de tuto (n'est pas vide), cela signifie que c'est une modification de tuto déjà existant
        if(!empty($_GET)){
            $_SESSION['update'] = true;
            //Connexion bdd
            require 'functions/connect_bdd.php';
            //Récupérer les infos du tuto à modifier
            $reponse = $bdd->prepare('SELECT * FROM tuto WHERE file_name = :required_tuto');
            $reponse->execute(array(
                'required_tuto'=>$_GET['tuto']
            ));
            $donnees = $reponse->fetch();
            //Récupérer l'id du tuto demandé
            $_SESSION['id'] = $donnees['id'];
        }
        ?>
        <!--Si c'est une modification de tuto, on met le contenu dans les textarea et input, sinon on laisse vide-->
                <div class="input"><input type="text" name="titre" id="titre" placeholder="Titre" value="<?=isset($donnees)?htmlspecialchars($donnees['titre']):'' ?>"></div>
                    <div class="form__contenu">
                        <textarea name="description" id="Description" cols="30" rows="10" placeholder="Description"><?=isset($donnees)?htmlspecialchars($donnees['description']):'' ?></textarea>
                        <textarea name="contenu" id="contenu" cols="30" rows="10" placeholder="Contenu"><?=isset($donnees)?htmlspecialchars($donnees['contenu']):'' ?></textarea>
                    </div>
                    <div class="code_transformation">
                        <textarea name="editeur" id="editeur" cols="30" rows="10" placeholder="Éditeur de code"></textarea>
                        <div class="effect_button">
                            <button class="transform" type="button">Transformer</button>
                            <button class="copy" type="button">Copier</button>
                        </div>
                    </div>
            <div class="container__button">
            <button type="submit" name="submit">Envoyer</button>
            <button type="submit" name="save">Sauvegarder</button>
            </div>
        </form>
    <div class="links">
        <a href="home.php">Retour</a>
        <a href="affiche_liste.php">Voir les commentaires</a>
    </div>

    <script src="copy.js"></script>
</body>

</html>