<?php
session_start();
$_SESSION['connected'] = false;

//Se connecter à la bdd :
require 'functions/connect_bdd.php';
//Récupérer les mdp
$reponse = $bdd->query('SELECT * FROM inscription');
$donnees = $reponse->fetch();

//Vérifier si les mdp sont bon :
if (($_POST['mdp1'] == $donnees['mdp1']) && ($_POST['mdp2'] == $donnees['mdp2'])) {
    $_SESSION['connected'] = true;
    $reponse->closeCursor();
    header('Location: home.php');
    exit();
//Si un champ n'est pas rempli :
} elseif ((isset($_POST['mdp1'])) || (isset($_POST['mdp2']))) {
    header('Location: index.php');
    $reponse->closeCursor();

    exit();
//Si un mdp n'est pas correct :
}else{
    header('Location: index.php');
    $reponse->closeCursor();

    exit();
}

