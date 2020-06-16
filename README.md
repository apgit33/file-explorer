# file-explorer
File Explorer

Ouvrir fichier : fopen($name,$option);
Fermer fichier : fclose($name);

Afficher le texte d'un fichier : fpassthru($name); ** 

Copier : copy(string fichier_depart, string fichier_destination);

Déplacer => utiliser renommer

Renommer : rename(string nom_depart, string nom_nouveau);

Supprimer un fichier : unlink($name);
Supprimer un dossier : rmdir($name);

Modification fichier : fwrite($name, $modif); **

** : ouvrir le fichier avant utilisation et le fermer ensuite !
