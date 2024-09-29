<?php
require "Includes/header.php";
global $_SETTINGS;

function buttonSettings(
  Codes $id, 
  string $title, 
  string $description, 
  ) {

  global $_SETTINGS;

  
  if (isset($_SETTINGS["Buttons"][$id->value], $id->value)) {
    $inst = "<br><b class='green'>&check; Installed</b></b>";
  } else {
    $inst = <<<HTML
      <br><b class="red">× Not installed</b>
              <br><button class="install" id="{$id->value}">Install</button>
    HTML;
  }

  return <<<HTML
  <div class="contain">
          <a href="https://musiclab.chromeexperiments.com/" target="_blank"><ul>$title</ul></a>
          <h4>$description
          $inst
          </h4>
        </div>
        <br>
  HTML;
}
?>
      <!--Aotea College Buttons-->
      <a id="aoteaCollege"></a>
      <h2 class="header" id="addNewAotea">Aotea College</h2>
      <br>
      <div style="border: 0px; padding: 0px; padding-top: 0px;" class="contain">
        <?= 
          buttonSettings(
            Codes::ATL, 
            "Aotea College Library", 
            "The Aotea College library website. Used for finding, reserving, and renewing books.",
          ) .

          buttonSettings(
            Codes::DRV,
            "Google Drive",
            "Google drive. Used for storing Docs, Slides, Sheets, Forms and other drive-related items.",
          ) .

          buttonSettings(
            Codes::CML,
            "Chrome Music Lab",
            "Chrome Music Lab is a musical website where you can compose songs, for free!",
          )
        ?>
      </div>
   </body>
</html>