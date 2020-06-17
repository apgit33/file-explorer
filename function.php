<?php
function create($name) {
    if (!file_exists($name)) {
        if (($name !=='') && (strpbrk($name, "\/?%*:|\"<>")=== FALSE)) {
            $extension=strrchr($name,'.');
            if ($extension == '.txt') {
                $handle = fopen($name,'w'); 
                fclose($handle);
            } else {
                mkdir($name);
            }
        } else {
            echo "Mauvais nom de fichier/dossier";
        }
    } else {
        echo "Nom déjà existant";
    }
}
function createDir($name){
    $erreur ="";

    if  ($name !== '') {
        if ((strpbrk($name, "\/?%*:|\"<>.") === FALSE) && (!is_dir($name))){
            mkdir($name);
        } else {
            $erreur =  "Mauvais nom de dossier";
        }
    }
    echo $erreur;
}

function createFile($name){
    $erreur ="";
//fichier ecrasé si .txt dans le nom
    if (($name !== '') && (!is_file($name.".txt"))) {
        if (strpbrk($name, "\/?%*:|\"<>")=== FALSE){
          //on récupère l'extension
          $extension=strrchr($name,'.');
          //on creer/ouvre le fichier en Write only
          if ($extension !== '.txt')  {
              $handle = fopen("$name.txt",'w');
              
          }else {
              $handle = fopen($name,'w'); 
          }
          //on ferme le fichier
          fclose($handle);
        } else {
            $erreur =   "Mauvais nom de fichier";
        }
      }
    echo $erreur;
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

function afficher_content($name) {
    $lines = file("./$name"); // display file line by line 
    foreach($lines as $line_num => $line) { 
        echo "# {$line_num} : ".htmlspecialchars($line)."<br />\n"; 
    }
}