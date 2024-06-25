<!DOCTYPE html>
<html lang="en">
  <head>
  <title>Util</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="Favicons/favicon.png">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">
    <link rel="stylesheet" type="text/css" href="CSS/Laptop.css">
    <?php require_once "Includes/process.php" ?>
  </head>
  <body>
    <?php
      if (!function_exists("echofile")) {
        function echofile (string $name) {
          echo "
            <h1 style='color: white; display: inline-block; line-height: 25px; width: 50% ; cursor: default;'>\n
              <em>$name</em>\n
            </h1>\n
          ";
        }
      }
      #The header on every page
      $pos = strpos(REAL_FILE, "Subject-");
      switch (REAL_FILE) {
        case "index" :
          echofile("Util");
          break;

        case "Subject-1" :
        case "Subject-2" :
        case "Subject-3" :
        case "Subject-4" :
        case "Subject-5" :
        case "Subject-6" :
        case "Subject-7" :
        case "Subject-8" :
          #echofile("Util - $subLink");
          break;

        case "quickwrite" :
          echofile("Util - QuickType");
          break;

        default:
          echofile("Util - " . Camel(REAL_FILE, false));
          break;
      }
    ?>