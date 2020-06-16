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
            <th>Taille</th>
            <th>Type</th>
            <th>Date de création</th>
            <th>Actions</th>
          </tr>
        </thead>"
        ?>
        <tbody>
          <tr>
            <th>$filename</th>
            <th>$filesize</th>
            <th>$filetype</th>
            <th>$filecreation</th>
            <th>
              <button>Modifier</button>
              <button>Supprimer</button>
            </th>
          </tr>
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
