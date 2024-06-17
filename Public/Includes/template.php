<?php
  require "Includes/header.php";
  global $subLink;
  global $classLink;

  $buttonfound = false;
  $file_path = "../Private/JSON/lists.json";

  # For getting the buttons from lists.json
  if (file_exists($file_path)) {
    $jsonFile = file_get_contents($file_path);
  } else {
    die("<b>Fatal Error:</b> File '$file_path' does not exists");
  }

  # Turning the data into the class buttons selector
  $file = json_decode($jsonFile, true);
  $subs = array_flip($subjects);
  $file = $file["classbuttons"][$subs[$subLink]] ?? null;
?>

  <body>
    <script defer>
      $(document).ready(() => {
        const data = localStorage.getItem(`class${pageno}`);
        const parsedData = JSON.parse(data);
  
        if (parsedData && parsedData.link) {
          const headElement = document.getElementById("head");
          const linkElement = document.createElement("a");
          linkElement.href = parsedData.link;
          linkElement.textContent = parsedData.subject;
          linkElement.target = "_blank";
          $(linkElement).css("font-size: larger");

          headElement.appendChild(linkElement);
        }
      });
    </script>
    <h3 id="head" class='hrcolor' style='padding-bottom: 25px; padding-top: 10px;'></h3>
    <?php
      # Buttons from links.json
      if ($file) {
        for ($i = 0; $i < 3; $i++) {
          $int = $i + 1;
          $buttonfound = false;
          $buttonsnotfound = 1;
          if ($file[$i] !== "<button onclick=\"window.location.href=''\"></button>") {
            echo $file[$i];
            $buttonfound = true;
          }
          if (!$buttonfound) {
            echo "<h4>Button $int not found for $subLink.</h4>";
          }
        }
      } else {
        echo "<h4>No Buttons found for $subLink.</h4>";
      }
    ?>
    </body>
    <?php include "Includes/footer.php"; ?>
    <script>
      $(document).ready(() => {
        setTimeout(() => window.location = "index.php", 600000);
      });
    </script>
</html>