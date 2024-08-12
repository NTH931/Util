<!DOCTYPE html>
<html lang="en">
  <head>
  <title>Util</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="Favicons/favicon.png">
    <link rel="stylesheet" type="text/css" href="CSS/media-queries.css.php">
    <link rel="stylesheet" type="text/css" href="CSS/styles.css.php">
    <?php require_once "../Private/PHP/variables.php" ?>
    <style>
        .container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-direction: row;
            padding: 10px;
        }
        
        #clock {
            font-size: 26px;
            font-weight: bold;
            color: var(--text-color); /* Example color */
            text-align: right;
            margin-left: 20px;
        }
    </style>
  </head>
  <body>
    <div class="container">
      <?php
        if (!function_exists("echofile")) {
          function echofile (string $name) {
            echo <<<HTML
              <h1 id='title' onclick='window.location.href = "index.php"'>\n
                <em>$name</em>\n
              </h1>\n
            HTML;
          }
        }
        // The header on every page
        if   ( THIS_FILE === "index" ) {             echofile("Util");           } 
        else /*THIS_FILE !== "index"*/ { echofile("Util - " . Camel(THIS_FILE)); }
      ?>
      <div id="clock"></div>
    </div>