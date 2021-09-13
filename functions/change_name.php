<?php

//On supprime tous les caractères interdits dasn les url, car le nom de fichier fera office d'url
$forbiden_char = array('\'', '!', '.', '/', '?', ',', ';', '§', '%', '*', '$', '£', '&');
$file_name_without_extension = str_replace($forbiden_char, '', $_POST['titre']);
//On remplace les espaces par des _
$file_name_extension = str_replace(' ', '_', $file_name_without_extension);
$file_name_extension = str_replace('?', '_', $file_name_extension);
echo "Le post = {$_POST['titre']}";
echo "Apres le post = $file_name_extension";
