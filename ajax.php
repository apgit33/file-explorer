<?php
$arr_file_types = ['image/png', 'image/gif', 'image/jpg', 'image/jpeg'];
 
if (!(in_array($_FILES['file']['type'], $arr_file_types))) {
    echo "false";
    return;
}
 
if (!file_exists('home')) {
    mkdir('home', 0777);
}
 
move_uploaded_file($_FILES['file']['tmp_name'], 'home/' . time() . '_' . $_FILES['file']['name']);
 
echo "Fichier ajouté!";