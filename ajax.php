<?php
$arr_file_types = ['image/png', 'image/gif', 'image/jpg', 'image/jpeg', 'text/plain', 'application/pdf', 'application/x-rar-compressed'];
 
if (!(in_array($_FILES['file']['type'], $arr_file_types))) {
    echo "Type de fichier acceptés : png / gif / txt / jpeg / jpg / pdf / rar";
    return;
}

move_uploaded_file($_FILES['file']['tmp_name'], 'accueil'.DIRECTORY_SEPARATOR. time() . '_' . $_FILES['file']['name']);
 
echo "GREAT SUCCESS!";
