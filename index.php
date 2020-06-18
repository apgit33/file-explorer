<?php
require_once "function.php";
require_once "init.php";
date_default_timezone_set('Europe/Paris');
$name = (isset($_POST['name']) ? $_POST['name']:"");
$path_file = (isset($_POST['path']) ? $_POST['path']:"");
$delete = (isset($_POST['deleteReally']) ? $_POST['deleteReally']:"");

if (isset($_POST['delete'])) {
  $deleteMove = $_POST['delete'];
  rename($deleteMove,getcwd().DIRECTORY_SEPARATOR.'.recycle_bin'.DIRECTORY_SEPARATOR.$deleteMove);
}

if ($delete !== "") {
  $file = $path_file.DIRECTORY_SEPARATOR.$delete;
  if (!is_dir($file)) {
    fclose($file);
    unlink($file);
  } else {
    rrmdir($file);
  }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>File Explorer</title>
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/5.3.45/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.0/css/bulma.min.css">
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
  <?php

    if (!empty($_GET['dir'])) {
    $cwd = $_GET['dir'];
    }
    else  {
      $cwd = $init_dir.DIRECTORY_SEPARATOR;
    }

    chdir($cwd);

    ?>
      <header>
      <div class="container">
        <nav class="navbar">
          <div class="navbar-brand breadcrumb has-succeeds-separator" aria-label="breadcrumbs">
                <ul>
                <?php
                   // break absolute path into individual items
                   $breadcrumb_menu = explode(DIRECTORY_SEPARATOR, getcwd());
                   $path_accum = ''; // initialize increment
                   $is_home = false;
                   // iterate over root directory
                  foreach ($breadcrumb_menu as $item) {
                    $path_accum .= $item . DIRECTORY_SEPARATOR; // recursive path increment
                    if ($item === $home_dir) {
                        $is_home = true;
                    }
                    if ($is_home) {
                        echo "<li><a href=\"?dir=$path_accum\" title=\"$path_accum\">$item</a></li>";
                    }
                  }

                   ?>
                </ul>
          </div>
          <div class="navbar-menu">
            <div class="navbar-end">
              <div class="navbar-item">
              <form action="" method="post" id="create_dir">
                <div class="group">
                  <label class="label" for="name">Nom :</label>
                  <input class="input l-m" type="text" name="name" id="name" placeholder="Ajoutez l'extension pour créer un fichier">
                  
                  <input  class="button" type="submit" name="create" value="Create">
                </div>
                <ul id='erreur_creation'>
                  <li>
                  <?php 
                  (isset($_POST['create']))? create($name):"";
                  ?>
                  </li>
                </ul>
                  </form> 
                </div>     
            </div>
          </div>
        </nav>
      </div>
      </header>
  <section class="section">
    <div class="container">
      <?php
      echo "
          <button type='submit' name='cache' class='button'  id ='cache' >Show</button>
      <table class=\"table\">
        <thead>
          <tr>
            <th>Nom</th>
            <th>Taille (octets)</th>
            <th>Type</th>
            <th>Date de création (UTC +2)</th>
            <th>Actions</th>
          </tr>
        </thead>";
        ?>
        <tbody>

      <?php
        $items = scandir(getcwd());
         
        $path=getcwd();
        foreach($items as $item) {
          if ($item !== "." && $item !== "..") {
            $type = (is_dir($item))? "dossier":"fichier";
            $taille = (is_dir($item)) ? taille_dossier($item):filesize($item);
            echo"
            <tr ";
            if ($item[0] == "."){ 
              echo "class='hidden'>";
            } else {
              echo ">";
            }
            echo "<th>";
              if (is_dir($item)) {
                echo "<a href='?dir=$cwd$item".DIRECTORY_SEPARATOR."' title='$cwd$item'>$item</a>";
              } else {
                echo "<a href='?dir=$cwd&file=$item' class='fichier' title='$cwd$item'>$item</a>";
              }
            echo"</th>
              <th>$taille</th>
              <th>$type</th>
              <th>".date ("d/m/Y H:i:s", filemtime($item))."</th>
              <th>";
              if ($item !== '.recycle_bin') {
                echo "<div class='group'>
                <button class=\"button\">Modifier</button>
                
                <form action='' method='post' id='delete_form'>
                  <input type='hidden' value=$path name='path'/>";
                if (!strstr(getcwd(),DIRECTORY_SEPARATOR.'.recycle_bin')){
                  echo "<button type ='submit' class='button' name='delete' value='$item'>Supprimer</button>";
                } else {
                  echo "
                  <button type ='submit' class='button' name='deleteReally' value='$item' style='background-color: red;'>Supprimer</button>";
                }
                echo "
                </form>
                </div>";
              }
              echo "
              </th>
            </tr>
            ";
          }
        }
      ?>
        </tbody>
      </table>
      <div>
        <?php         
          if (!empty($_GET['file'])) {
            $extension=strrchr($_GET['file'],'.');
            switch ($extension) {
              case '.txt':
                afficher_content($_GET['file']);
                break;
              case '.jpg':
                print_r ("<img src='".substr(strrchr(getcwd(),DIRECTORY_SEPARATOR),1).DIRECTORY_SEPARATOR.$_GET['file']."' alt=''/>");
                break;
              default:
                break;
            }
          }
        ?>
      </div>
    </div>
  </section>
  <div class="container">
  <section>
    <div id="drop_file_zone" ondrop="upload_file(event)" ondragover="return false">
      <div id="drag_upload_file">
          <p>Ajoutez le fichier ici</p>
          <p>ou</p>
          <p><input class="button" type="button" value="Select File" onclick="file_explorer();"></p>
          <input class="button" type="file" id="selectfile">
      </div>
    </div>
 </section>
 </div>
    <footer class="footer">
      <div class="content has-text-centered">
        <p class="text">File Explorer - Adrien Paturot & Guillaume Blondel</p>
      </div>
    </footer>
  </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="custom.js"></script>    
    <script src="script.js"></script>
  </body>
</html>