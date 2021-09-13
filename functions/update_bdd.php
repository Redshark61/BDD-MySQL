<?php
//Fonction pour mettre à jour un tuto, isReadable à 0 si c'est un brouillon
//ou à 1 si le tuto est fini et est prêt à être envoyé
function update($bdd, $isReadable, $file_name_extension, $old_name)
{
    $new_file_name_extension = str_replace(' ', '_', $_POST['titre']);
    $req = $bdd->prepare('UPDATE tuto SET titre = :titre, contenu = :contenu, description = :description, readable=:readable, file_name = :file_name WHERE id=:id');
    $contenu = str_replace('<IMG "', '<img src="ressources/tuto/' . $file_name_extension . '/', $_POST['contenu']);
    $contenu = str_replace('<VIDEO "', '<video loop autoplay> <source src="ressources/tuto/' . $file_name_extension . '/', $contenu);

    $contenu = str_replace($old_name, $file_name_extension, $contenu);


    $req->execute(array(
        'titre' => $_POST['titre'],
        'contenu' => $contenu,
        'description' => $_POST['description'],
        'id' => $_SESSION['id'],
        'readable' => $isReadable,
        'file_name' => $file_name_extension
    ));

    if ($old_name != $new_file_name_extension) {

        rename('ressources/tuto/' . $old_name, 'ressources/tuto/' . $file_name_extension);
    }
    echo "L'ancien file_name = $old_name \n";
    echo "Le new_file_name_extension = $new_file_name_extension \n";
}
