<!DOCTYPE html>
 <html lang="en">
  <?php
  require "./Includes/header.php";
  require "../Public/Includes/process.php";
  ?>
  <style>
    div.vl {
      border-left: 1px solid white !important;
      top: 16vh;
      height: 20vh;
    }

    button {
      margin-top: 1px;
    }
  </style>
  <body>
    <h1 style="color:white; display: inline-block; line-height: 10px; cursor: default;"><em>Util</em></h1>
    <br>
    <!--Header Buttons-->
    <nav>
      <a href="https://www.google.com/?pli=1&safe=active&ssui=on" target="_blank"><button>Google</button></a>
      <a href="quickwrite.php"><button>QuickType</button></a>
      <a href="https://whanau.aotea.school.nz" target="_blank"><button>Whanau Portal</button></a>
      <a href="Links.php"><button>Edit Classes</button></a>
      <hr>
    </nav>

    <div>
      <aside>
        <div>
          <!--Classes & Links to Google Classroom-->
          <h4 class="whitebg" style="max-width: 40px;"><a href="https://classroom.google.com/a/not-turned-in/all" target="_blank">To-do</a></h4>

          <h4><a id="classbutton1" class="whitebg" style="max-width: 60px;" href="Subject-1.php">HuiAko</a>

          <h4><a id="classbutton2" class="whitebg" style="max-width: 60px;" href="Subject-2.php"><?php echo $sub2; ?></a></h4>

          <h4><a id="classbutton3" class="whitebg" style="max-width: 60px;" href="Subject-3.php"><?php echo $sub3; ?></a></h4>

          <h4><a id="classbutton4" class="whitebg" style="max-width: 60px;" href="Subject-4.php"><?php echo $sub4; ?></a></h4>

          <h4><a id="classbutton5" class="whitebg" style="max-width: 60px;" href="Subject-5.php"><?php echo $sub5; ?></a></h4>

          <h4><a id="classbutton6" class="whitebg" style="max-width: 60px;" href="Subject-6.php"><?php echo $sub6; ?></a></h4>

          <h4><a id="classbutton7" class="whitebg" style="max-width: 60px;" href="Subject-7.php"><?php echo $sub7; ?></a></h4>

          <h4><a id="classbutton8" class="whitebg" style="max-width: 60px;" href="Subject-8.php"><?php echo $sub8; ?></a></h4>

          <!--
            <hr style="width: 97%; margin-left: -10px;">
            <button id="showButton">Show custom buttons</button>
            <span class="hidden-text" id="hiddenText">
      

            </span>
          -->

<!-----------------------------Version No--------------------------------->
      <?php include "Includes/footer.php"; ?>

      </aside>
      <section class="main">
      <div style=" width: 49vw; border-left: 1px solid white; padding-left: 10px;">
       <h2 style="color: black;"><u>Website Links</u></h2>
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

       <a href="https://new.express.adobe.com/tools/remove-background"target="_blank"><button>Adobe Background Remover</button></a>

       <a href="https://www.unscreen.com/"target="_blank"><button>Unscreen.com</button></a>

       <a href="https://convertio.co/" target="_blank"><button>Convertio</button></a>


       <!--<a href="buttons.php"><button id="addNewOther" class="plus"><b>+</b></button></a>-->

      </div>
      </section>
    </div>
    <script>
      $('document').ready( () => {
        for (let i = 1; i < 9; i++) {
          const element = document.querySelector("#classbutton" + i);
          if (element.innerHTML === "HIDE_NULL") {
            $(element).css("display", "none");
          };
        };
      });
    </script>
  </body>
 </html>