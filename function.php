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
