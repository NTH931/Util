<!DOCTYPE html>
 <html lang="en">
  <?php
  require_once "./Includes/header.php";

  function links(string $href, string $text, bool $_blank = true) {
    if ($_blank === true) {
      return "<a href='$href' target='_blank'><button>$text</button></a>";
    } else {
      return "<a href='$href'><button>$text</button></a>";
    }
  }

  function plus($id) {
    return "<button id='$id' class='plus'><b>+</b></button>";
  }

  ?>
  <style>
    button {
      margin-top: 1px;
    }
  </style>
  <body>
    <h1 style="color: white; display: inline-block; line-height: 10px; cursor: default;"><em>Util</em></h1>
    <br>

    <nav>
      <?=
        links("https://www.google.com/", "Google") .
        links("https://whanau.aotea.school.nz", "Whanau Portal") .
        links("quickwrite.php", "QuickType", false) .
        links("Links.php", "Edit Classes", false)
      ?>
    </nav>

    <div>
      <aside>
        <div>
          <!--Classes & Links to Google Classroom-->
          <br>
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
            <li><a href="#tab-1">Website Links</a></li>
            <li><a href="#tab-2">Timetable</a></li>
          </ul>
          <div id="tab-1">
            <?=
              "<h2>Aotea</h2>" .
              links("https://www.aotea.school.nz/", "Aotea College") .
              links("https://nz.accessit.online/ATC00/#!dashboard", "Aotea Library") .
              plus("addNewAotea") .

              "<h2>Exam Sites</h2>" .
              links("https://taku.nzqa.govt.nz/learner-home/", "NZQA") .
              links("https://www.nzceronline.org.nz/", "NZCER Online") .
              plus("addNewExamSite") .

              "<h2>Google Services</h2>" .
              links("https://drive.google.com/", "Drive") .
              links("https://classroom.google.com/", "Classroom") .
              links("https://docs.google.com/document/", "Docs") .
              links("https://docs.google.com/presentation/", "Slides") .
              links("https://docs.google.com/spreadsheets/", "Sheets") .
              links("https://docs.google.com/forms/", "Forms") .
              links("https://sites.google.com/", "Sites") .
              plus("addNewDrive") .

              "<h4>Others</h4>" .
              links("https://kahoot.it", "Kahoot!") .
              links("https://dashboard.blooket.com/stats", "Blooket") .
              links("https://remove.bg", "Remove.bg") .
              links("https://www.unscreen.com/", "Unscreen") .
              links("https://convertio.co/", "Convertio") .
              plus("addNewOther")
            ?>
          </div>
          <div id="tab-2">

          </div>
        </div>
      </section>
    </div>
    <link rel="stylesheet" href="CSS/jQuery-ui-tabs.css">
    <?php require_once "Includes/footer.php"; ?>
    <script>
      $(document).ready(function() {
        $('#tabs').tabs();
      });
    </script>
  </body>
 </html>