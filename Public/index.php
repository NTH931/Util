<?php
require_once "./Includes/header.php";
  function links(string $href, string $text, bool $_blank = true, bool $avaliable = true) {
    if ($avaliable) {
        return "<button onclick=\"window.open('$href', '" . ($_blank ? '_blank' : '_self') . "')\">$text</button>\n";
    } else {
        return "<button style='cursor: not-allowed'>$text - <b>Unavailable</b></button>\n";
    }
  }
  function plus(string $id, bool $avaliable = true) {
    if ($avaliable) {
      return "<button id='$id' class='plus' onclick=\"window.location.href='buttons.php#$id'\"><b>+</b></button>\n";
    } else {
      return null;
    }
  }

  define("DIVIDER", "<div style='position: fixed; border-top: 2px solid var(--hr-color); margin-top: -6px; margin-right: -10px; margin-left: -10px; visibility: visible;'></div>");

  function classes($i, $text, $href) {
    return "<h4><a id='classbuttons$i' class='whitebg' href='$href'>$text</a></h4>";
  }
  ?>
  <style>
    button {
      margin-top: 1px;
    }
  </style>
  <body>
    <br>
    <nav>
      <?=
        links("https://www.google.com/", "Google") .
        links("https://whanau.aotea.school.nz", "Whanau Portal") .
        links("quickwrite.php", "QuickType", false, false) .
        links("Links.php", "Edit Classes", false)
      ?>
    </nav>
    <div>
      <aside>
        <h4><a id="todo" class="whitebg" style="max-width: 45px;" href="https://classroom.google.com/a/not-turned-in/all" target="_blank">To-do</a></h4>

      </aside>

      <h6 style="position: absolute; bottom: 20px; left: 6px;">left-click on the class to go straight to the classroom, or hover to find the 3 most used links in the class.</h6>

      <section class="main" tabindex="-1">
        <div id="tabs">
          <ul>
            <li id="child-1"><a href="#tab-1">Website Links</a></li>
            <li id="child-2"><a href="#tab-2">Timetable</a></li>
            <!--<li id="child-3"><a href="#tab-3">Settings</a></li>-->
          </ul>
          <div id="tab-1">
            <?= DIVIDER ?> <?=
              "<h4>Aotea</h4>\n" .
              links("https://www.aotea.school.nz/", "Aotea College") .
              links("https://nz.accessit.online/ATC00/#!dashboard", "Aotea Library") .
              links("https://soraapp.com/home", "New Library") .
              plus("addNewAotea", false) .

              "<h4>Exam Sites</h4>\n" .
              links("https://taku.nzqa.govt.nz/learner-home/", "NZQA") .
              links("https://www.nzceronline.org.nz/", "NZCER Online") .
              plus("addNewExamSite", false) .

              "<h4>Google Services</h4>\n" .
              links("https://drive.google.com/", "Drive") .
              links("https://classroom.google.com/", "Classroom") .
              links("https://docs.google.com/document/", "Docs") .
              links("https://docs.google.com/presentation/", "Slides") .
              links("https://docs.google.com/spreadsheets/", "Sheets") .
              links("https://docs.google.com/forms/", "Forms") .
              links("https://sites.google.com/", "Sites") .
              plus("addNewDrive", false) .

              "<h4>Others</h4>\n" .
              links("https://kahoot.it", "Kahoot!") .
              links("https://dashboard.blooket.com/stats", "Blooket") .
              links("https://remove.bg", "Remove.bg") .
              links("https://www.unscreen.com/", "Unscreen") .
              links("https://convertio.co/", "Convertio") .
              plus("addNewOther", false)
            ?>
          </div>
          <div id="tab-2">
            <?= DIVIDER ?>
          </div>
          <div id="tab-3">
            <?= DIVIDER ?>
          </div>
        </div>
      </section>
    </div>
    <link rel="stylesheet" href="CSS/jQuery-ui-tabs.css">
    <?php require_once "Includes/footer.php"; ?>
    <script type="module" src="js/classbuilder.js"></script>
    <script>
      $(document).ready(function() {
        $("#tabs").tabs({
          beforeActivate: (event, ui) => { ui.oldPanel.removeClass("ui-container-active") },
          activate: (event, ui) => { ui.newPanel.addClass("ui-container-active") }
        });
        $("#tabs .ui-tabs-panel").first().addClass("ui-container-active");
      });
    </script>
  </body>
 </html>