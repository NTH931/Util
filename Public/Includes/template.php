<?php
require "Includes/header.php";
  global $subLink;
  global $classLink;

  $buttonfound = false;
  $file_path = "../Private/JSON/lists.json";

  if (file_exists($file_path)) {
    $jsonFile = file_get_contents($file_path);
  } else {
    die("<b>Fatal Error:</b> File '$file_path' does not exists");
  }
  $file = json_decode($jsonFile, true);
  $file['classbuttons'];
  $subs = array_flip($subjects);

  $jsonpath = $file["classbuttons"][$subs[$sublink]];
  echo $jsonpath;
  ?>


    <body onload="timeout(15000)">
      <h3 class="hrcolor" style="padding-bottom: 25px; padding-top: 10px;">
        <a href="<?php echo $classLink; ?>" style="font-size: larger;" target="_blank" class="spanA">
          <?php echo $subLink; ?>
        </a>
      </h3>

      <?php
        //Buttons from links.json
        if (isset($jsonpath)) {
          for ($i = 0; $i < 3; $i++) {
            $int = $i + 1;
            $buttonfound = false;
            $buttonsnotfound = 1;
            if ($jsonpath[$i] !== "<button onclick=\"window.location.href=''\"></button>"){
              echo $jsonpath[$i];
              $buttonfound = true;
            }
            if (!$buttonfound){
              echo "<h4>Button $int not found for $subLink.</h4>";
            }
          }
        } else {
          echo "<h4>No Buttons found for $subLink.</h4>";
        }

      ?>


    </body>
    <?php include "Includes/footer.php"; ?>
</html>