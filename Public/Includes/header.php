<!DOCTYPE html>
<html lang="en">
  <head>
  <title>Util</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="Favicons/favicon.png">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">
    <link rel="stylesheet" type="text/css" href="CSS/styles.css">
    <?php require_once "Includes/process.php" ?>
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
            echo "
              <h1 id='title'>\n
                <em>$name</em>\n
              </h1>\n
            ";
          }
        }
        // The header on every page
        if   ( REAL_FILE === "index" ) {             echofile("Util");           } 
        else /*REAL_FILE !== "index"*/ { echofile("Util - " . Camel(REAL_FILE)); }
      ?>
      <div id="clock"></div>
    </div>