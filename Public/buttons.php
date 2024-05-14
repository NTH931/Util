<!DOCTYPE html>
 <html lang="en">
  <?php
  require "Includes/header.php";
  require_once "Includes/process.php"; 
  ?>
     <style>
      h4 {
        margin-top: 0;
        margin-bottom: 0;
      }

      h2, h3, h5, h6 {
        margin-top: 5px;
        margin-bottom: 5px;
      }

      div {
        border: var(--normal-border);
        padding: 5px;
        padding-top: 0px;
      }

      div > div {
        background-color: var(--dark-aquamarine);
      }

      b {
        color: var(--light-green);
      }

      div > a {
        display: block;
        font-size: 1.17em; /* Equivalent to the font-size of h3 */
        font-weight: bold;
        margin-top: 4px;
        margin-bottom: 2px;
        color: white;
      }

      button {
        background-color: var(--light-green);
        margin-top: 0px;
        width: 100px;
      }

      button.red {
        background-color: var(--light-red);
        margin-top: 0px;
      }

      b.red {
        color: red;
        border-bottom: 3px solid red;
      }

      .notDiv {
        border-bottom: var(--normal-border);
        padding: 5px;
        margin-left: -10px;
        margin-right: -10px;
        margin-top: -10px;
        margin-bottom: -10px;
        padding-left: 15px;
        background-color: rgb(100, 100, 100);
      }

      .space {
        padding: 2px;
        border: 0px;
      }
     </style>
   
   <body>
      <div class="notDiv cancel">
        <h1 style="color:white; display: inline-block; line-height: 10px; cursor: default;"><em>Buttons</em></h1>

      </div>
      <!--Aotea College Buttons-->
      <div class="space"></div>
      <a id="aoteaCollege"></a>
      <h2 class="header">Aotea College</h2>
      <br>
      <div style="border: 0px; padding: 0px; padding-top: 0px;">
        <div id="library">
          <a href="https://nz.accessit.online/ATC00/#!dashboard" target="_blank"><u>Aotea College Library</u></a>
          <h4>The Aotea College library website. Used for finding, reserving, and renewing books.<br>Status: <b>Active
          <br>&check; Installed</b>
          </h4>
        </div>
        <br>
        <div id="Drive">
          <a href="https://drive.google.com" target="_blank"><u>Google Drive</u></a>
          <h4>Google drive. Used for storing Docs, Slides, Sheets, Forms and other drive-related items.
          <br>Status: <b>Active
          <br>&check; Installed</b>
          </h4>
        </div>
        <br>

        <div id="chromeMusicLab">
          <a href="https://musiclab.chromeexperiments.com/" target="_blank"><u>Chrome Music Lab</u></a>
          <h4>Chrome Music Lab is a musical website where you can compose songs, for free!
          <br>Status <b>Active</b>
          <br><b class="red">&cross; Not installed</b>
          <br><a href=""><button class="wide">Install</button></a>
          </h4>
        </div>
        <br>
        <!--
        <div id="">

        </div>
        <br>
        <div id="">

        </div>
        <br>
        <div id="">

        </div>
        <br>
        <div id="">

        </div>
        <br>
        <div id="">

        </div>
        -->
      </div>
   </body>
</html>