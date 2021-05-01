<?php
// On essaie de se connecter à la base de données (bdd) :

require 'functions/check_connection.php';
require 'functions/connect_bdd.php';
// On se connecte à la table des billets pour en récupérer le contenu :
//$req = $bdd->prepare('SELECT id, titre, contenu, DATE_FORMAT(date_creation, \' le %d/%m/%Y à %H h%i %s\') AS date_heure FROM tuto WHERE id=?');

$req = $bdd->prepare('INSERT INTO tuto(titre, contenu , date_creation, file_name, description) VALUES(:titre, :contenu, NOW(), :file_name, :description)');
$forbiden_char = array('\'', '!', '.', '/', '?', ',', ';', '§', '%', '*', '$', '£', '&');
$file_name_without_extension = str_replace($forbiden_char, '', $_POST['titre']);
$file_name_extension = str_replace(' ', '_', $file_name_without_extension);

$contenu = $_POST['contenu'];
$contenu = substr_replace($contenu,'<div class="tuto_contenu">', 0, 0);
$contenu = substr_replace( $contenu, '</div>', -1,0);

$req->execute(array(
    'titre' => $_POST['titre'],
    'contenu' => $contenu,
    'file_name' => $file_name_extension,
    'description' => $_POST['description']
));


// file_put_contents('tuto/'.$file_name_extension, "
// <!DOCTYPE html>
// <html lang='fr'>
// <head>
//     <meta charset='UTF-8'>
//     <meta http-equiv='X-UA-Compatible' content='IE=edge'>
//     <meta name='viewport' content='width=device-width, initial-scale=1.0'>
//     <link rel='stylesheet' href='prism.css'>
//         <link rel='stylesheet' href='style.css'>

//     <title>{$_POST['titre']}</title>
// </head>
// <body>
//     $contenu
//     <a href='../home.php'>Retour</a>
//     <script src='prism.js'></script>
// </body>
// </html>

// ");
header('Location: affiche_liste.php', TRUE);
exit();
