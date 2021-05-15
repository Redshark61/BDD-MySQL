<?php
//Vérifier si l'utilisateur est bien connecté + activation session
require 'functions/check_connection.php';
header('Location: affiche_liste.php', TRUE);
//Connexion bdd
require 'functions/connect_bdd.php';

//Fonciton pour mettre à jour la bdd
require 'functions/update_bdd.php';

require 'functions/change_name.php';

//On vérifie si des fichiers photos sont envoyé 
require 'functions/upload_file.php';

//Récupération du tuto à modifer
$req = $bdd->prepare('SELECT * FROM tuto WHERE id=:id');
$req->execute(array(
    'id' => $_SESSION['id']
));
$donnees = $req->fetch();

//Si c'est une maj de tuto, ce tuto est un brouillon et on ne le sauvegarde pas (donc on le met en ligne)
if($_SESSION['update'] && !$donnees['readable'] && !isset($_POST['save'])){
    uploadImage($file_name_extension);
    //Mise à jour du tuto
    update($bdd, 1, $file_name_extension);
    $req->closeCursor();
    echo 'Envoie de tuto après modif';

//Si c'est juste une mise à jour d'un tuto déjà en ligne
}elseif($_SESSION['update']){
    uploadImage($file_name_extension);
    update($bdd, 0, $file_name_extension);
    $req->closeCursor();
    echo $_SESSION['update'].'\n';
    echo 'Mise à jour de tuto déjà existant'.'\n';
}

//Sinon on le créé et le rentre dans la bdd
//L'attribut readable définit si il apparaîtra sur le site avec les autres tutos
else{
    $req = $bdd->prepare('INSERT INTO tuto(titre, contenu , date_creation, file_name, description, readable) VALUES(:titre, :contenu, NOW(), :file_name, :description, :readable)');
    
    uploadImage($file_name_extension);
    //On rajoute les balises pour la mise en page
    $contenu = $_POST['contenu'];
    $contenu = '<div class="tuto_contenu"><p>'.$contenu;
    $contenu = $contenu.'</p></div>';
    $contenu = str_replace('<IMG "', '<img src="ressources/tuto/'.$file_name_extension.'/', $contenu);

    $req->execute(array(
        'titre' => $_POST['titre'],
        'contenu' => $contenu,
        'file_name' => $file_name_extension,
        'description' => $_POST['description'],
        'readable' => isset($_POST['save'])?0:1
    ));
    $req->closeCursor();
    echo "Création d'un nouveau tuto";
}
exit();