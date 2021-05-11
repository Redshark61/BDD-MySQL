<?php
//Vérifier si l'utilisateur est bien connecté + activation session
require 'functions/check_connection.php';
//Connexion bdd
require 'functions/connect_bdd.php';

//Fonction pour mettre à jour un tuto, isReadable à 0 si c'est un brouillon
//ou à 1 si le tuto est fini et est prêt à être envoyé
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

//Récupération du tuto à modifer
$req = $bdd->prepare('SELECT * FROM tuto WHERE id=:id');
$req->execute(array(
    'id' => $_SESSION['id']
));
$donnees = $req->fetch();
//Si c'est une maj de tuto, ce tuto est un brouillon et on ne le sauvegarde pas (donc on le met en ligne)
if($_SESSION['update'] && !$donnees['readable'] && !isset($_POST['save'])){
    //Mise à jour du tuto
    update($bdd, 1);
    $req->closeCursor();

///Si c'est juste une mise à jour d'un tuto déjà en ligne
}elseif($_SESSION['update']){
    update($bdd, 0);
    $req->closeCursor();
}
//Sinon on le créé et le rentre dans la bdd
//L'attribut readable définit si il apparaîtra sur le site avec les autres tutos
else{
    $req = $bdd->prepare('INSERT INTO tuto(titre, contenu , date_creation, file_name, description, readable) VALUES(:titre, :contenu, NOW(), :file_name, :description, :readable)');
    //On supprime tous les caractères interdits dasn les url, car le nom de fichier fera office d'url
    $forbiden_char = array('\'', '!', '.', '/', '?', ',', ';', '§', '%', '*', '$', '£', '&');
    $file_name_without_extension = str_replace($forbiden_char, '', $_POST['titre']);
    //On remplace les espaces par des _
    $file_name_extension = str_replace(' ', '_', $file_name_without_extension);
    
    //On rajoute les balises pour la mise en page
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
