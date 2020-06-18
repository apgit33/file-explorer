<?php
$arr_file_types = ['image/png', 'image/gif', 'image/jpg', 'image/jpeg', 'text/plain', 'application/pdf', 'application/x-rar-compressed'];
 
if (!(in_array($_FILES['file']['type'], $arr_file_types))) {
    echo "Type de fichier acceptés : png / gif / txt / jpeg / jpg / pdf / rar";
    return;
}
 
if (!file_exists('accueil')) {
    mkdir('accueil', 0777);
}
 
move_uploaded_file($_FILES['file']['tmp_name'], 'accueil/' . time() . '_' . $_FILES['file']['name']);
 
echo "GREAT SUCCESS!";
