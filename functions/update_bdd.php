<?php
//Fonction pour mettre à jour un tuto, isReadable à 0 si c'est un brouillon
//ou à 1 si le tuto est fini et est prêt à être envoyé
function update($bdd, $isReadable, $file_name_extension){
    $req = $bdd->prepare('UPDATE tuto SET titre = :titre, contenu = :contenu, description = :description, readable=:readable WHERE id=:id');
    $contenu = str_replace('<IMG "', '<img src="ressources/tuto/'.$file_name_extension.'/', $_POST['contenu']);

    $req->execute(array(
        'titre' => $_POST['titre'],
        'contenu' => $contenu,
        'description' => $_POST['description'],
        'id' => $_SESSION['id'],
        'readable' => $isReadable
    ));
}
