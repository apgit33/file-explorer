<?php
require_once "function.php";
require_once "init.php";
date_default_timezone_set('Europe/Paris');
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>File Explorer</title>
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/5.3.45/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.0/css/bulma.min.css">
    <link rel="stylesheet" href="https://unpkg.com/buefy/dist/buefy.min.css">
  </head>
 
  <body>
  <script src="https://cdn.jsdelivr.net/npm/vue@2.5.13/dist/vue.js"></script>
  <?php

        if (!empty($_GET['dir'])) {
        $cwd = $_GET['dir'];
        }
        else  {
          $cwd = $init_dir;
        }

        chdir($cwd);

    ?>
      <header>
      <div class="container">
        <nav class="navbar">
          <div class="breadcrumb has-succeeds-separator" aria-label="breadcrumbs">
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
        </thead>";
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
  <div id="app" class="container">
  <section>
    <b-field class="file">
      <b-upload v-model="file" expanded>
        <a class="button is-primary is-fullwidth">
          <b-icon icon="upload"></b-icon>
          <span>{{ file.name || "Click to upload"}}</span>
        </a>
      </b-upload>
    </b-field>
    <b-field>
      <b-upload v-model="dropFiles" multiple drag-drop expanded>
        <section class="section">
          <div class="content has-text-centered">
            <p>
              <b-icon icon="upload" size="is-large"></b-icon>
            </p>
            <p>Drop your files here or click to upload</p>
          </div>
        </section>
      </b-upload>
    </b-field>

    <div class="tags">
      <span v-for="(file, index) in dropFiles" :key="index" class="tag is-primary">
        {{file.name}}
        <button class="delete is-small" type="button" @click="deleteDropFile(index)"></button>
      </span>
    </div>
  </section>
  </div>
  
  <div class="container">
    <footer class="footer">
      <div class="content has-text-centered">
        <p class="text">File Explorer - Adrien Paturot & Guillaume Blondel</p>
      </div>
    </footer>
  </div>
  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
  <script src="https://unpkg.com/vue"></script>
  <script src="https://unpkg.com/buefy/dist/buefy.min.js"></script>
  <script>
    const example = {
  data() {
    return {
      file: {},
      dropFiles: []
    };
  },
  methods: {
    deleteDropFile(index) {
      this.dropFiles.splice(index, 1);
    }
  }
};

                const app = new Vue(example)
                app.$mount('#app')
  </script>
  </body>
</html>