<?php
require 'functions/check_connection.php';
require 'functions/connect_bdd.php';

function update($bdd, $isReadable){
    $req = $bdd->prepare('UPDATE tuto SET titre = :titre, contenu = :contenu, description = :description, readable=:readable WHERE id=:id');
    $req->execute(array(
        'titre' => $_POST['titre'],
        'contenu' => $_POST['contenu'],
        'description' => $_POST['description'],
        'id' => $_SESSION['id'],
        'readable' => $isReadable
    ));
}


$req = $bdd->prepare('SELECT * FROM tuto WHERE id=:id');
$req->execute(array(
    'id' => $_SESSION['id']
));
$donnees = $req->fetch();
if($_SESSION['update'] && !$donnees['readable'] && !isset($_POST['save'])){
    update($bdd, 1);
    $req->closeCursor();

}elseif($_SESSION['update']){
    update($bdd, 0);
    $req->closeCursor();
}
else{
    $req = $bdd->prepare('INSERT INTO tuto(titre, contenu , date_creation, file_name, description, readable) VALUES(:titre, :contenu, NOW(), :file_name, :description, :readable)');
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
        'description' => $_POST['description'],
        'readable' => isset($_POST['save'])?0:1
    ));
    $req->closeCursor();
}
header('Location: affiche_liste.php', TRUE);
exit();
