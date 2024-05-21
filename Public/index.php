<!DOCTYPE html>
 <html lang="en">
  <?php
  require "./Includes/header.php";
  require "../Public/Includes/process.php";
  ?>
  <style>
    button {
      margin-top: 1px;
    }
  </style>
  <body>
    <!--<embed src="Favicons/Util.png" width="100" height="65">-->
    <h1 style="color: white; display: inline-block; line-height: 10px; cursor: default;"><em>Util</em></h1>
    <br>
    <!--Header Buttons-->
    <nav>
      <a href="https://www.google.com/?pli=1&safe=active&ssui=on" target="_blank"><button>Google</button></a>
      <a href="https://whanau.aotea.school.nz" target="_blank"><button>Whanau Portal</button></a>
      <a href="quickwrite.php"><button>QuickType</button></a>
      <a href="Links.php"><button>Edit Classes</button></a>
    </nav>

    <div>
      <aside>
        <div>
          <!--Classes & Links to Google Classroom-->
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

      <h5 style="position: absolute; bottom: 20px; left: 25%;">Right-click on the class to go straight to the classroom, or left click to go to the 3 most used links in the class.</h5>
      <?php require_once "Includes/footer.php"; ?>

      <section class="main">
        <div style="width: 49vw; border-left: 2px solid var(--hr-color); padding-left: 10px;">
          <h2><u>Website Links</u></h2>

          <!--Links to different useful websites-->
          <h4>Aotea</h4>

          <a href="https://www.aotea.school.nz/" target="_blank"><button>Aotea Homepage</button></a>

          <a href="https://nz.accessit.online/ATC00/#!dashboard" target="_blank"><button>Aotea Library</button></a>

          <!--<a href="buttons.php"><button id="addNewAotea" class="plus"><b>+</b></button></a>-->

          <!--Exam Sites-->
          <h4>Exam Sites</h4>

          <a href="https://taku.nzqa.govt.nz/learner-home/" target="_blank"><button>NZQA - New Website</button></a>

          <a href="https://secure.nzqa.govt.nz/for-learners/records/index.do" target="_blank"></a><button>NZQA - Old Website</button></a>

          <a href="https://www.nzceronline.org.nz/" target="_blank"><button>NZCER Online</button></a>

          <!--<a href="buttons.php"><button id="addNewExamSites" class="plus"><b>+</b></button></a>-->

          <!--Drive-->
          <h4>Drive</h4>

          <a href="https://drive.google.com" target=”_blank”><button>Drive</button></a>

          <a href="https://classroom.google.com/" target=”_blank”><button>Classroom</button></a>

          <a href="https://docs.google.com/document/u/0/?tgif=d" target=”_blank”><button>Docs</button></a>

          <a href="https://docs.google.com/presentation/u/0/?tgif=d" target=”_blank”><button>Slides</button></a>

          <a href="https://docs.google.com/spreadsheets/u/0/?tgif=d" target="_blank"><button>Sheets</button></a>

          <a href="https://docs.google.com/forms/u/0/?tgif=d"><button>Forms</button></a>

          <a href="https://sites.google.com/u/0/?tgif=d" target=”_blank”><button>Sites</button></a>

          <!--<a href="buttons.php"><button id="addNewDrive" class="plus"><b>+</b></button></a>-->



          <!--Other-->
          <h4>Other</h4>

          <a href="https://kahoot.it" target="_blank"><button>Kahoot!</button></a>

          <a href="https://dashboard.blooket.com/stats" target="_blank"><button>Blooket</button></a>

          <a href="https://epro8challenge.co.nz/epro8-school-equipment-activity-menu.php" target="_blank"><button>Epro 8</button></a>

          <a href="https://remove.bg"target="_blank"><button>Remove.bg</button></a>

          <a href="https://www.unscreen.com/"target="_blank"><button>Unscreen</button></a>

          <a href="https://convertio.co/" target="_blank"><button>Convertio</button></a>


          <!--<a href="buttons.php"><button id="addNewOther" class="plus"><b>+</b></button></a>-->
        </div>
      </section>
    </div>
    <script>
      rclick = 2
      lclick = 1

      document.querySelectorAll('h4 > a').forEach(h4 => {
          h4.addEventListener("mousedown", function(e) {
            if (this.id !== "todo") {
              e.stopPropagation(); // Stop the event from bubbling up
              if (e.button === 2) {
                const classhref = this.getAttribute('classhref');
                e.preventDefault();
                if (classhref != null) {
                    window.open(classhref, '_blank');
                } else {
                    alert("No class has been specified for " + this.textContent);
                };
              };
            };
          });
      });
      document.addEventListener("contextmenu", function(e) {
        e.preventDefault(); // Prevent the context menu from appearing
      });
    </script>
  </body>
 </html>