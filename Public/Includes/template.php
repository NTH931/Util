<?php
require "Includes/header.php";
  global $subLink;
  global $classLink;

  $buttonfound = false;
  $file_path = "../Private/JSON/lists.json";
  $currentfile = $_EXEC["file"];

  if (file_exists($file_path)) {
    $jsonFile = file_get_contents($file_path);
  } else {
    die("<b>Fatal Error:</b> File '$file_path' does not exists");
  }
  $file = json_decode($jsonFile, true);
  $subjects = $file['classbuttons'];
  $jsonpath = $subjects[$subLink]
  ?>


    <body onload="timeout(15000)">
    <div>
      <h1 id="title"><em>Util</em></h1>
    </div>
      <h3 class="hrcolor"><a href="<?php echo $classLink; ?>" style="font-size: larger;" target="_blank" id="storedLinkButton1" class="spanA storedLinkButton"><?php echo $subLink; ?></a></h3>
      <?php
        if (isset($jsonpath)) {
          for ($i = 0; $i < 3; $i++) {
            $int = $i + 1;
            $buttonfound = false;
            if ($jsonpath[$i] !== "<a href='' target='_blank'><button></button></a>"){
              echo $jsonpath[$i];
              $buttonfound = true;
            }
            if (!$buttonfound){
              echo "<h4>No button found for Button $int.</h4>";
            }
          }
        } else {
          echo "<h4>No Buttons found for $subLink.</h4>";
        }

      ?>


    </body>
    <?php include "Includes/footer.php"; ?>
</html>