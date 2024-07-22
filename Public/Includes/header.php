<!DOCTYPE html>
<html lang="en">
  <head>
  <title>Util</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="Favicons/favicon.png">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">
    <link rel="stylesheet" type="text/css" href="CSS/styles.css.php">
    <link rel="stylesheet" type="text/css" href="CSS/media-queries.css.php">
    <?php
      function cookie_set(string $name, string|array $value, $time_days = 1): void {
        setcookie($name, is_array($value) ? json_encode($value) : $value, time() + ($time_days * (24 * 60 * 60)), '/');
      }
      
      if (!isset($_COOKIE["settings"])) {
        cookie_set("settings", [
          # Value: Common colours
          "Base-Color" => "default",
          # Value: 1=all, 2=important_popup_only, 3=notification_panel_only
          "Notifications" => 1,
          # Value: Boolean
          "Tooltips" => true,
          # Assoc Array
          "Buttons" => [
            "GGL" => null,
            "WNP" => true,
            "QCT" => false,
            "EDC" => true,
      
            "ATC" => true,
            "ATL" => true,
            "ATN" => null,
      
            "NQA" => true,
            "NCR" => true,
      
            "GML" => true,
            "DRV" => true,
            "CLR" => true,
            "DCS" => true,
            "SLD" => true,
            "SHT" => true,
            "FRM" => true,
            "STS" => true,
      
            "KHT" => true,
            "BLK" => true,
            "RMB" => true,
            "USC" => true,
            "CVT" => true
          ]
        ], 365 * 5);
      }
    ?>
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
            echo "
              <h1 id='title'>\n
                <em>$name</em>\n
              </h1>\n
            ";
          }
        }
        // The header on every page
        if   ( THIS_FILE === "index" ) {             echofile("Util");           } 
        else /*THIS_FILE !== "index"*/ { echofile("Util - " . Camel(THIS_FILE)); }
      ?>
      <div id="clock"></div>
    </div>