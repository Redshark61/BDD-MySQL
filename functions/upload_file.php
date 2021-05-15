<?php
function uploadImage($tuto_name){
    if($_FILES['fileToUpload']['name'] == ''){
        echo 'No image send';
    }else{
        if(!is_dir('ressources/tuto/'.$tuto_name)){
            mkdir('ressources/tuto/'.$tuto_name);
        }
        $target_dir = 'ressources/tuto/'.$tuto_name.'/';
        $target_file = $target_dir . basename($_FILES['fileToUpload']['name']);
        $upload_OK = true;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $upload_OK = false;
        }
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $upload_OK = false;
        }

        if(!$upload_OK){
            echo "L'image n'a pas été envoyé";
        }else{
            if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)){
                echo "L'image a été envoyé !";
            }else{
                echo "L'image n'a pas été envoyé !";
            }
        }
    }
}