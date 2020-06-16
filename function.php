<?php

function createDir($name){
    if (($name !== '') && (strpbrk($name, "\/?%*:|\"<>.") === FALSE)){
        if (!is_dir($name)) {
            mkdir($name);
        }
    }
}

function createFile($name){
    if (($name !=='') && (strpbrk($name, "\/?%*:|\"<>")=== FALSE)){
        //on récupère l'extension
        $extension=strrchr($name,'.');
        //on creer/ouvre le fichier en Write only
        if (($extension !== '.txt') && ($extension !== '.php'))  {
            $handle = fopen("$name.txt",'w');
            
        }else {
            $handle = fopen($name,'w'); 
        }
        //on ferme le fichier
        fclose($handle);
    }
}

function taille_dossier($rep){
    $racine = opendir($rep);
    $taille = 0;
    while($dossier = readdir($racine)){
        if (!in_array($dossier, array("..", "."))){
            if(is_dir($rep.DIRECTORY_SEPARATOR.$dossier)){
                $taille+=taille_dossier($rep. DIRECTORY_SEPARATOR .$dossier);
            }else{
                $taille+= filesize($rep. DIRECTORY_SEPARATOR .$dossier);
            }
        }  
    }
    closedir($racine);
    return $taille;
}