<?php
require "Includes/header.php";

function links(string $link, string $text, string $target = "_blank") {
  return "<a href='$link' target='$target'><button class='none'>$text</button></a>\n";
}

function plus(string $id) {
  return "<a href='buttons.php'><button id='$id' class='none'><b>+</b></button></a>";
}
?>
<style>
  * {
    -webkit-user-select: none;
    -moz-user-select: none;
    user-select: none;
  }
</style>
  <h1 style="color: white; display: inline-block; line-height: 10px; cursor: default;"><em>Util</em></h1>
  <br>
  <nav>
    <a href="https://www.google.com/?pli=1&safe=active&ssui=on" target="_blank"><button>Google</button></a>
    <a href="https://whanau.aotea.school.nz" target="_blank"><button>Whanau Portal</button></a>
    <a href="quickwrite.php"><button>QuickType</button></a>
    <a href="Links.php"><button>Edit Classes</button></a>
  </nav>

    <div>
      <aside>
        <div>
          <h4 class="whitebg" style="max-width: 45px;"><a id="todo" href="https://classroom.google.com/a/not-turned-in/all" target="_blank">To-do</a></h4>

          <h4><a id="classbutton1" class="whitebg" style="max-width: 60px;" href="Subject-1.php" classhref="<?= $class1 ?>">HuiAko</a>

          <?php
            for ($i = 2; $i <= 8; $i++) :
              if (${"class$i"} && ${"sub$i"}) : ?>
                <h4><a id="classbutton<?= $i ?>" class="whitebg" style="max-width: 60px;" href="Subject-<?= $i ?>.php" classhref="<?= ${"class$i"} ?>"><?= ${"sub$i"} ?></a></h4>
          <?php
              endif;
            endfor;
          ?>

        </div>
      </aside>

      <h6 style="position: absolute; bottom: 20px; left: 6px;">Right-click on the class to go straight to the classroom, or left click to go to the 3 most used links in the class.</h6>

      <section class="main">
        <div id="tabs">
          <ul>
            <li><a href="#tabs-1">Website Links</a></li>
            <li><a href="#tabs-2">Current Timetable</a></li>
          </ul>
          <div id="tabs-1">
              <?=
                "\n<h4>Aotea</h4>\n" .
                links("https://www.aotea.school.nz", "Aotea Homepage") .
                links("https://nz.accessit.online/ATC00/#!dashboard", "Aotea Library") .
                plus("addNewAotea") .

                "\n\n<h4>Exam Sites</h4>\n" .
                links("https://taku.nzqa.govt.nz/learner-home/", "NZQA Home") .
                links("https://www.nzceronline.org.nz/", "NZCER Online") .
                plus("addNewExamSite") .

                "\n\n<h4>Drive</h4>\n" .
                links("https://drive.google.com", "Drive") .
                links("https://classroom.google.com/", "Classroom") .
                links("https://docs.google.com/document/", "Docs") .
                links("https://docs.google.com/presentation/", "Slides") .
                links("https://docs.google.com/spreadsheets/", "Sheets") .
                links("https://docs.google.com/forms/", "Forms") .
                links("https://sites.google.com/", "Sites") .
                plus("addNewDrive") .

                "\n\n<h4>Other</h4>\n" .
                links("https://kahoot.it", "Kahoot") .
                links("https://dashboard.blooket.com/stats", "Blooket") .
                links("https://remove.bg", "Remove.bg") .
                links("https://www.unscreen.com", "Unscreen") .
                links("https://convertio.co/", "Convertio") .
                links("https://www.arealme.com/category/ability-tests/en", "Arealme - Ability Tests") .
                plus("addNewOther");
              ?>
          </div>
          <div id="tabs-2">
            <?= "<button class='none'></button>" ?>
          </div>
        </div>
      </section>
    </div>
    <?php require_once "Includes/footer.php"; ?>
    <link rel="stylesheet" href="CSS/jQuery-ui-tabs.css">
    <script>
      $(document).ready(function () {
        $("#tabs").tabs({

        })
      });
    </script>
  </body>
</html>