<?php
require_once "./Includes/header.php";
require_once "../Private/PHP/settings.php";
function links(string|null $id, string $href, string $text, bool $_blank = true) {
  global $_SETTINGS;
  if (isset($_SETTINGS["Buttons"][$id]) || $id === null) {
    return "<button onclick=\"window.open('$href', '" . ($_blank ? '_blank' : '_self') . "')\">$text</button>\n";
  } elseif (isset($_SETTINGS["Buttons"][$id]) && $_SETTINGS["Buttons"][$id] === null) {
    return "<button class='no'>$text - <b>Unavailable</b></button>\n";
  } else {
    return null;
  }
}

function plus(string $id, bool $avaliable = true) {
  if ($avaliable) {
    return "<button id='$id' class='plus' onclick=\"window.location.href='buttons.php#$id'\"><b>+</b></button>\n";
  } else {
    return null;
  }
}

define("DIVIDER", "<div style='position: fixed; border-top: 2px solid var(--highlight-color); margin-top: -6px; margin-right: -10px; margin-left: -10px; visibility: visible;'></div>");

function classes($i, $text, $href) { return "<h4><a id='classbuttons$i' class='whitebg' href='$href'>$text</a></h4>"; }
?>

<body>
  <br>
  <nav>
    <?=
      links("GGL", "https://www.google.com/", "Google") .
      links(null, "https://whanau.aotea.school.nz", "Whanau Portal") .
      links(null, "quickwrite.php", "QuickType", false) .
      links("EDC", "links.php", "Edit Classes", false)
    ?>
    <button id="settingsshow">Settings</button>
  </nav>
  <div class="content">
    <aside>
      <h4 id="todo"><a id="todo" class="whitebg" style="max-width: 45px;" href="https://classroom.google.com/a/not-turned-in/all" target="_blank">To-do</a></h4>

    </aside>

    <h6 style="position: absolute; bottom: 40px; left: 6px;">left-click on the class to go straight to the classroom, or hover to find the 3 most used links in the class.</h6>

    <section class="main" tabindex="-1">
      <div id="tabs">
        <ul>
          <li id="child-1"><a href="#tab-1">Website Links</a></li>
          <li id="child-2"><a href="#tab-2">Timetable</a></li>
          <li id="child-3"><a href="#tab-3">Classes</a></li>
          <!--<li id="child-3"><a href="#tab-3">Settings</a></li>-->
        </ul>
        <div id="tab-1">
          <?= DIVIDER ?> <?=
            "<h4>Aotea</h4>\n" .
              links("ATC", "https://www.aotea.school.nz/", "Aotea College") .
              links("ATL", "https://nz.accessit.online/ATC00/#!dashboard", "Aotea Library") .
              links("ATN", "https://soraapp.com/home", "New Library") .
              plus("addNewAotea", false) .

              "<h4>Exam Sites</h4>\n" .
              links("NQA", "https://taku.nzqa.govt.nz/learner-home/", "NZQA") .
              links("NCR", "https://www.nzceronline.org.nz/", "NZCER Online") .
              plus("addNewExamSite", false) .

              "<h4>Google Services</h4>\n" .
              links("GML", "https://mail.google.com", "Gmail") .
              links("DRV", "https://drive.google.com/", "Drive") .
              links("CLR", "https://classroom.google.com/", "Classroom") .
              links("DCS", "https://docs.google.com/document/", "Docs") .
              links("SLD", "https://docs.google.com/presentation/", "Slides") .
              links("SHT", "https://docs.google.com/spreadsheets/", "Sheets") .
              links("FRM", "https://docs.google.com/forms/", "Forms") .
              links("STS", "https://sites.google.com/", "Sites") .
              plus("addNewDrive", false) .

              "<h4>Others</h4>\n" .
              links("KHT", "https://kahoot.it", "Kahoot!") .
              links("BLK", "https://dashboard.blooket.com/stats", "Blooket") .
              links("RMB", "https://remove.bg", "Remove.bg") .
              links("USC", "https://www.unscreen.com/", "Unscreen") .
              links("CVT", "https://convertio.co/", "Convertio") .
              plus("addNewOther", false)
            ?>
        </div>
        <div id="tab-2">
          <?= DIVIDER ?>
        </div>
        <div id="tab-3">
          <?= DIVIDER ?>
          <input 
            style="width: 100%" 
            type="search" 
            search-content="classes"  
            placeholder="Class"
            elements=".class-item"
          >
          <div id="classes">
            <div class="class-item"><b>Home </b>  HuiAko</div>
            <div class="class-item"><b>INT: </b>  Intergrated Studies</div>
            <div class="class-item"><b>INS: </b>  Intergrated Studies - Neuro-Diverse</div>
            <div class="class-item"><b>ENG: </b>  English</div>
            <div class="class-item"><b>MAT: </b>  Maths</div>
            <div class="class-item"><b>SCI: </b>  Science</div>
            <div class="class-item"><b>AHI: </b>  Aotearoa Histories</div>
            <div class="class-item"><b>HPE: </b>  Health & PE</div>
            <div class="class-item"><b>HEA: </b>  HPE - Health & Wellbeing</div>
            <div class="class-item"><b>PEO: </b>  HPE - Physical Education Outdoors</div>
            <div class="class-item"><b>PED: </b>  HPE - Physical Education</div>
            <div class="class-item"><b>PES: </b>  HPE - Sports And Training</div>
            <div class="class-item"><b>TGC: </b>  Technology - Coding For Gaming</div>
            <div class="class-item"><b>TDE: </b>  Technology - Digital Technologies</div>
            <div class="class-item"><b>DTE: </b>  Technology - Digital Technology Environments</div>
            <div class="class-item"><b>TPD: </b>  Technology - Product Design And Construction</div>
            <div class="class-item"><b>TBT: </b>  Technology - Bio Technology</div>
            <div class="class-item"><b>TDV: </b>  Technology - Architecture And Product Design</div>
            <div class="class-item"><b>TFD: </b>  Technology - Food Around The World</div>
            <div class="class-item"><b>TTX: </b>  Technology - Fashion And Textiles</div>
            <div class="class-item"><b>JDT: </b>  Technology - Jewellery And Product Design</div>
            <div class="class-item"><b>CAR: </b>  Technology - Carpentry</div>
            <div class="class-item"><b>HOS: </b>  Technology - Hospitality</div>
            <div class="class-item"><b>PHT: </b>  Technology - Photography</div>
            <div class="class-item"><b>ARP: </b>  Art - Painting</div>
            <div class="class-item"><b>ARD: </b>  Art - Design</div>
            <div class="class-item"><b>ART: </b>  Visual Art - Art</div>
            <div class="class-item"><b>MUS: </b>  Performing Arts - Music General</div>
            <div class="class-item"><b>MUJ: </b>  Performing Arts - Music Jazz</div>
            <div class="class-item"><b>DAN: </b>  Performing Arts - Dance</div>
            <div class="class-item"><b>DRA: </b>  Performing Arts - Drama</div>
            <div class="class-item"><b>MPA: </b>  Performing Arts - Maori Performing Arts</div>
            <div class="class-item"><b>FSI: </b>  Science - Forensics Science</div>
            <div class="class-item"><b>SFC: </b>  Science - Food Chemistry</div>
            <div class="class-item"><b>SSU: </b>  Science - Space And Us</div>
            <div class="class-item"><b>SNS: </b>  Science - The Nature Of Science</div>
            <div class="class-item"><b>SCB: </b>  Science - Chemistry And Biology</div>
            <div class="class-item"><b>SPS: </b>  Science - Physics And Space Science</div>
            <div class="class-item"><b>BIO: </b>  Science - Biology</div>
            <div class="class-item"><b>CHE: </b>  Science - Chemistry</div>
            <div class="class-item"><b>PHY: </b>  Science - Physics</div>
            <div class="class-item"><b>ELS: </b>  Science - Environmental Life Science</div>
            <div class="class-item"><b>FRE: </b>  Languages - French</div>
            <div class="class-item"><b>FRA: </b>  Languages - French Advanced</div>
            <div class="class-item"><b>JPN: </b>  Languages - Japanese</div>
            <div class="class-item"><b>JPA: </b>  Languages - Japanese Advanced</div>
            <div class="class-item"><b>MDR: </b>  Languages - Mandarin</div>
            <div class="class-item"><b>MDA: </b>  Languages - Mandarin Advanced</div>
            <div class="class-item"><b>MAO: </b>  Languages - Maori</div>
            <div class="class-item"><b>MAA: </b>  Languages - Maori Advanced</div>
            <div class="class-item"><b>SAM: </b>  Languages - Te Kura Samoan</div>
            <div class="class-item"><b>EPS: </b>  Languages - English Proficiency Studies</div>
            <div class="class-item"><b>PWR: </b>  English - Power Of The Word</div>
            <div class="class-item"><b>BUS: </b>  Social Science - Business Studies</div>
            <div class="class-item"><b>COM: </b>  Social Science - Commerce - Money Talks</div>
            <div class="class-item"><b>COT: </b>  Social Science - International Travel</div>
            <div class="class-item"><b>GEO: </b>  Social Science - Geography</div>
            <div class="class-item"><b>HIS: </b>  Social Science - History</div>
            <div class="class-item"><b>CLS: </b>  Social Science - Classical Studies</div>
            <div class="class-item"><b>ECC: </b>  Social Science - Economics</div>
            <div class="class-item"><b>FIN: </b>  Social Science - Financial Capability</div>
            <div class="class-item"><b>MED: </b>  Social Science - Media Studies</div>
            <div class="class-item"><b>PSY: </b>  Social Science - Psychology</div>
            <div class="class-item"><b>TOU: </b>  Social Science - Tourism</div>
            <div class="class-item"><b>ENGA:</b>  11 ENG 1 - Sport And Society</div>
            <div class="class-item"><b>ENGB:</b>  11 ENG 1 - English And The Environment</div>
            <div class="class-item"><b>ENGC:</b>  11 ENG 1 - Maori And Pacific Voices</div>
            <div class="class-item"><b>ENGD:</b>  11 ENG 1 - Conspiracy Theories</div>
            <div class="class-item"><b>ENGF:</b>  11 ENG 1 - Dystopia</div>
            <div class="class-item"><b>ENGG:</b>  11 ENG 1 - Messages In Music</div>
            <div class="class-item"><b>ENGH:</b>  11 ENG 1 - Modern Mythic</div>
            <div class="class-item"><b>ENGJ:</b>  11 ENG 2 - NZ Culture In Film</div>
            <div class="class-item"><b>ENGK:</b>  11 ENG 2 - It's The Little Things</div>
            <div class="class-item"><b>ENGL:</b>  11 ENG 2 - What Do They Have To Say?</div>
            <div class="class-item"><b>ENGM:</b>  11 ENG 2 - Poetry Power</div>
            <div class="class-item"><b>ENGN:</b>  11 ENG 2 - Maori And Pacific Voices 2</div>
            <div class="class-item"><b>ENGQ:</b>  11 ENG 2 - Wahine Toa</div>
            <div class="class-item"><b>MAC: </b>  Mathematics - Mathematics With Calculus</div>
            <div class="class-item"><b>MAS: </b>  Mathematics - Mathematics With Statistics</div>
            <div class="class-item"><b>GAT: </b>  Pathways - Gateway Level ()</div>
            <div class="class-item"><b>PAT: </b>  Pathways - Pathways Level ()</div>
            <div class="class-item"><b>WTA: </b>  Pathways - Wellington Trades Academy</div>
            <div class="class-item"><b>SPE: </b>  Learning Support - SPEC</div>
            <div class="class-item"><b>LST: </b>  Learning Support - Transition</div>
          </div> 
        </div> 
      </div>
    </section>
  </div>
  <link rel="stylesheet" href="CSS/jQuery-ui-tabs.css.php">
  <?php require_once "Includes/footer.php"; ?>
  <script type="module" src="js/index.js"></script>
  <script>
    $(document).ready(function() {
      $("#tabs").tabs({
        beforeActivate: (event, ui) => {
          ui.oldPanel.removeClass("ui-container-active")
        },
        activate: (event, ui) => {
          ui.newPanel.addClass("ui-container-active")
        }
      });
      $("#tabs .ui-tabs-panel").first().addClass("ui-container-active");
    });
  </script>
</body>

</html>