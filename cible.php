<?php
// On essaie de se connecter à la base de données (bdd) :
require 'functions/check_connection.php';
require 'functions/connect_bdd.php';
// On se connecte à la table des billets pour en récupérer le contenu :
//$req = $bdd->prepare('SELECT id, titre, contenu, DATE_FORMAT(date_creation, \' le %d/%m/%Y à %H h%i %s\') AS date_heure FROM tuto WHERE id=?');
if($_SESSION['update']){
$req = $bdd->prepare('UPDATE tuto SET titre = :titre, contenu = :contenu, description = :description WHERE id=:id');
$req->execute(array(
    'titre' => $_POST['titre'],
    'contenu' => $_POST['contenu'],
    'description' => $_POST['description'],
    'id' => $_SESSION['id']
));
    $req->closeCursor();
}
else{
    $req = $bdd->prepare('INSERT INTO tuto(titre, contenu , date_creation, file_name, description) VALUES(:titre, :contenu, NOW(), :file_name, :description)');
    $forbiden_char = array('\'', '!', '.', '/', '?', ',', ';', '§', '%', '*', '$', '£', '&');
    $file_name_without_extension = str_replace($forbiden_char, '', $_POST['titre']);
    $file_name_extension = str_replace(' ', '_', $file_name_without_extension);

    $contenu = $_POST['contenu'];
    $contenu = '<div class="tuto_contenu">'.$contenu;
    $contenu = $contenu.'</div>';

    $req->execute(array(
        'titre' => $_POST['titre'],
        'contenu' => $contenu,
        'file_name' => $file_name_extension,
        'description' => $_POST['description']
    ));
    $req->closeCursor();
}
header('Location: affiche_liste.php', TRUE);
exit();
