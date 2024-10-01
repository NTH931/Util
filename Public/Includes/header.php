<!DOCTYPE html>
<html lang="en">
  <head>
  <title>Util</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="Favicons/favicon.png">
    <script src="./CSS/media-queries.js"></script>
    <link rel="stylesheet" type="text/css" href="CSS/styles.css">
    <?php require_once "../Private/PHP/variables.php" ?>

  </head>
  <body>
    <div class="container">
      <?php
        $thisFile = Camel(THIS_FILE);
        if (THIS_FILE === 'index') {
        echo <<<HTML
        <h1 id='title' onclick='window.location.href = "index.php"'><em>Util</em></h1>
              <div id="clock"></div>
        HTML;
        } else {
        echo <<<HTML
        <h1 id='title' onclick='window.location.href = "index.php"'><em>Util - $thisFile</em></h1>
        HTML;
        }
      ?>

    </div>

