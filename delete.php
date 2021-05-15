<?php

require 'functions/connect_bdd.php';

$reponse = $bdd->prepare('DELETE FROM tuto WHERE file_name = :file_name');

$reponse->execute(array(
    'file_name' => $_GET['tuto']
));

$reponse->closeCursor();

delete_files('ressources/tuto/'.$_GET['tuto']);

/* 
 * php delete function that deals with directories recursively
 */
function delete_files($target) {
    if(is_dir($target)){
        $files = glob( $target . '*', GLOB_MARK ); //GLOB_MARK adds a slash to directories returned

        foreach( $files as $file ){
            delete_files( $file );      
        }

        rmdir( $target );
    } elseif(is_file($target)) {
        unlink( $target );  
    }
}
header('Location: affiche_liste.php', TRUE);
exit();