<?php
require_once "function.php";
date_default_timezone_set('Europe/Paris');
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>File Explorer</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.0/css/bulma.min.css">
  </head>
  <body>
      <header>
      <div class="container">
        <nav class="navbar">
          <div class="breadcrumb has-succeeds-separator" aria-label="breadcrumbs">
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Chemin</a></li>
                    <li><a href="#">Chemin</a></li>
                    <li class="is-active"><a href="#" aria-current="page">Fil d'Ariane</a></li>
                </ul>
          </div>
          <div class="navbar-menu">
            <div class="navbar-end">
              <div class="navbar-item">
                <form action="" method="post">
                  <label for="name">Nom :</label>
                  <input type="text" name="name" id="name">
                  <input type="submit" value="createDir">
                  <input type="submit" value="createFile">
                </form>
                <button class="button">Créer un dossier</button>
                <button class="button">Créer un fichier</button>
              </div>
            </div>
          </div>
        </nav>
      </div>
      </header>
  <section class="section">
    <div class="container">
      <?php
      echo "<table class=\"table\">
        <thead>
          <tr>
            <th>Nom</th>
            <th>Taille (octets)</th>
            <th>Type</th>
            <th>Date de création (UTC +2)</th>
            <th>Actions</th>
          </tr>
        </thead>"
        ?>
        <tbody>

      <?php
        $items = scandir(getcwd());
        foreach($items as $item) {
          if($item !== "." && $item !== "..") {
            $type = (is_dir($item))? "dossier":"fichier";
            $taille = (is_dir($item)) ? taille_dossier($item):filesize($item);
            echo"
            <tr>
              <th>$item</th>
              <th>$taille</th>
              <th>$type</th>
              <th>".date ("d/m/Y H:i:s", filemtime($item))."</th>
              <th>
                <button>Modifier</button>
                <button>Supprimer</button>
              </th>
            </tr>
            ";
          }
        }
      ?>
        </tbody>
      </table>
    </div>
  </section>
  <div class="container">
    <footer class="footer">
      <div class="content has-text-centered">
        <p class="text">File Explorer - Adrien Paturot & Guillaume Blondel</p>
      </div>
    </footer>
  </div>
  </body>
</html>
