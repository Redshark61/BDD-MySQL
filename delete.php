<?php

require 'functions/connect_bdd.php';

$reponse = $bdd->prepare('DELETE FROM tuto WHERE file_name = :file_name');

$reponse->execute(array(
    'file_name' => $_GET['tuto']
));

$reponse->closeCursor();
header('Location: affiche_liste.php', TRUE);
exit();