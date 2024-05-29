<<<<<<< HEAD
<?php
require "Includes/header.php";
  global $subLink;
  global $classLink;

  $buttonfound = false;
=======
<!DOCTYPE html>
<html>
  <?php
  require "Includes/header.php";
  require_once "Includes/process.php";

>>>>>>> 21276100a7496e93e1737a23934a634c49fac588
  $file_path = "../Private/JSON/lists.json";
  $currentfile = $_EXEC["file"];

  if (file_exists($file_path)) {
    $jsonFile = file_get_contents($file_path);
  } else {
    die("<b>Fatal Error:</b> File '$file_path' does not exists");
  }
  $file = json_decode($jsonFile, true);
  $subjects = $file['classbuttons'];
<<<<<<< HEAD
  $jsonpath = $subjects[$subLink]
=======
>>>>>>> 21276100a7496e93e1737a23934a634c49fac588
  ?>


    <body onload="timeout(15000)">
    <div>
      <h1 id="title"><em>Util</em></h1>
    </div>
      <h3 class="hrcolor"><a href="<?php echo $classLink; ?>" style="font-size: larger;" target="_blank" id="storedLinkButton1" class="spanA storedLinkButton"><?php echo $subLink; ?></a></h3>
      <?php
<<<<<<< HEAD
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

=======
        if (isset($subjects[$subLink])) {
          for ($i = 0; $i < 3; $i++) {
            echo $subjects[$subLink][$i];
          }
        } else {
          echo "<h4>No buttons found for $subLink.</h4>";
        }
>>>>>>> 21276100a7496e93e1737a23934a634c49fac588
      ?>


    </body>
    <?php include "Includes/footer.php"; ?>
</html>