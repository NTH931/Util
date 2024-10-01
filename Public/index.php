<?php
require_once "./Includes/header.php";
include_once "./Includes/settings.php";

function links(string|null $id, string $href, string $text, bool $_blank = true)
{
  global $_SETTINGS;
  if (isset($_SETTINGS["Buttons"][$id]) || $id === null) {
    return "          <button onclick=\"window.open('$href', '" . ($_blank ? '_blank' : '_self') . "')\">$text</button>\n";
  } elseif (isset($_SETTINGS["Buttons"][$id]) && $_SETTINGS["Buttons"][$id] === false) {
    return "          <button class='no'>$text - <b>Unavailable</b></button>\n";
  } else {
    return null;
  }
}

function plus(string $id, bool $avaliable = true, string $text = '+')
{
  if ($avaliable) {
    return "<button id='$id' class='plus' onclick=\"window.location.href='buttons.php#$id'\"><b>$text</b></button>\n";
  } else {
    return null;
  }
}

function classes($i, $text, $href)
{
  return "<h4><a id='classbuttons$i' class='whitebg' href='$href'>$text</a></h4>";
}

define("DIVIDER", "<div style='position: fixed; border-top: 2px solid var(--highlight-color); margin-top: -6px; margin-right: -10px; margin-left: -10px; visibility: visible;'></div>");
?>

<br>
<nav>
  <?=
  links("GGL", "https://www.google.com/", "Google") .
    links(null, "https://whanau.aotea.school.nz", "Whanau Portal") .
    links(null, "quicktype.php", "QuickType", false)
  ?>
  <button id="settingsshow">Settings</button>
</nav>
<div class="content">

  <!--Where the Class Links go-->
  <aside>
    <h4 id="todo"><a id="todo" class="whitebg" style="max-width: 45px;" href="https://classroom.google.com/a/not-turned-in/all" target="_blank">To-do</a></h4>

    <h4 id="addClasses" class="addSave" onclick="window.open('links.php', '_self')"></h4>
  </aside>

  <h6 style="position: absolute; bottom: 40px; left: 6px;">left-click on the class to go straight to the classroom, or hover to find the 3 most used links in the class.</h6>

  <section class="main" tabindex="-1">
    <div id="tabs">
      <ul>
        <li id="child-1"><a href="#tab-1">Website Links</a></li>
        <li id="child-2"><a href="#tab-2">Periods</a></li>
        <li id="child-3"><a href="#tab-3">Classes</a></li>
        <li id="child-4"><a href="#tab-4">Rooms</a></li>
      </ul>

      <!--Buttons-->
      <div id="tab-1">
        <?= DIVIDER . nl ?>
        <?=
        "\n          <h4>Aotea</h4>\n" .
          links("ATC", "https://www.aotea.school.nz/", "Aotea College") .
          links("ATL", "https://nz.accessit.online/ATC00/#!dashboard", "Aotea Library") .
          links("ATN", "https://soraapp.com/home", "New Library") .
          plus("addNewAotea", false) .

          "\n          <h4>Exam Sites</h4>\n" .
          links("NQA", "https://taku.nzqa.govt.nz/learner-home/", "NZQA") .
          links("NCR", "https://www.nzceronline.org.nz/", "NZCER Online") .
          plus("addNewExamSite", false) .

          "\n          <h4>Google Services</h4>\n" .
          links("GML", "https://mail.google.com", "Gmail") .
          links("DRV", "https://drive.google.com/", "Drive") .
          links("CLR", "https://classroom.google.com/", "Classroom") .
          links("DCS", "https://docs.google.com/document/", "Docs") .
          links("SLD", "https://docs.google.com/presentation/", "Slides") .
          links("SHT", "https://docs.google.com/spreadsheets/", "Sheets") .
          links("FRM", "https://docs.google.com/forms/", "Forms") .
          links("STS", "https://sites.google.com/", "Sites") .
          plus("addNewDrive", false) .

          "\n          <h4>Others</h4>\n" .
          links("KHT", "https://kahoot.it", "Kahoot!") .
          links("BLK", "https://dashboard.blooket.com/stats", "Blooket") .
          links("RMB", "https://remove.bg", "Remove.bg") .
          links("USC", "https://www.unscreen.com/", "Unscreen") .
          links("CVT", "https://convertio.co/", "Convertio") .
          plus("addNewOther", false)
        ?>
      </div>

      <!--Periods-->
      <div id="tab-2">
        <?= DIVIDER ?>
        <h3 class="periods">Monday, Wednesday, Friday</h3>
        <ul class="periods">
          <li><b>Period 1:</b> 08:50am - 10:05am</li>
          <li><b>Period 2:</b> 10:10am - 11:25am</li>
          <li><b>Interval:</b> 11:25am - 11:45am</li>
          <li><b>Period 3:</b> 11:50am - 01:05pm</li>
          <li><b>Lunch:</b> 01:05pm - 01:50pm</li>
          <li><b>Period 4:</b> 01:55pm - 03:10pm</li>
        </ul>

        <h3 class="periods">Tuesday, Thursday</h3>
        <ul class="periods">
          <li><b>Period 1:</b> 08:50am - 10:05am</li>
          <li><b>Period 2:</b> 10:10am - 10:40am</li>
          <li><b>Interval:</b> 10:40am - 11:00am</li>
          <li><b>Period 3:</b> 11:05am - 12:20pm</li>
          <li><b>Lunch:</b> 12:20am - 01:00pm</li>
          <li><b>Period 4:</b> 01:05pm - 02:20pm</li>
        </ul>
      </div>

      <!--Classes-->
      <div id="tab-3">
        <?= DIVIDER ?>
        <input
          style="width: 100%; position: sticky; top: 1px; z-index: 10;"
          type="search"
          search-content="classes"
          placeholder="Search For Classes..."
          elements=".class-item">
        <!--All of the classes-->
        <div id="classes">
          <div class="class-item"><b style="background-color: var(--highlight-color); padding-right: 58px"></b> HuiAko</div>
          <div class="class-item"><b>INT: </b> Intergrated Studies</div>
          <div class="class-item"><b>INS: </b> Intergrated Studies - Neuro-Diverse</div>
          <div class="class-item"><b>ENG: </b> English</div>
          <div class="class-item"><b>MAT: </b> Maths</div>
          <div class="class-item"><b>SCI: </b> Science</div>
          <div class="class-item"><b>AHI: </b> Aotearoa Histories</div>
          <div class="class-item"><b>HPE: </b> Health & PE</div>
          <div class="class-item"><b>HEA: </b> HPE - Health & Wellbeing</div>
          <div class="class-item"><b>PEO: </b> HPE - Physical Education Outdoors</div>
          <div class="class-item"><b>PED: </b> HPE - Physical Education</div>
          <div class="class-item"><b>PES: </b> HPE - Sports And Training</div>
          <div class="class-item"><b>TGC: </b> Technology - Coding For Gaming</div>
          <div class="class-item"><b>TDE: </b> Technology - Digital Technologies</div>
          <div class="class-item"><b>DTE: </b> Technology - Digital Technology Environments</div>
          <div class="class-item"><b>TPD: </b> Technology - Product Design And Construction</div>
          <div class="class-item"><b>TBT: </b> Technology - Bio Technology</div>
          <div class="class-item"><b>TDV: </b> Technology - Architecture And Product Design</div>
          <div class="class-item"><b>TFD: </b> Technology - Food Around The World</div>
          <div class="class-item"><b>TTX: </b> Technology - Fashion And Textiles</div>
          <div class="class-item"><b>JDT: </b> Technology - Jewellery And Product Design</div>
          <div class="class-item"><b>CAR: </b> Technology - Carpentry</div>
          <div class="class-item"><b>HOS: </b> Technology - Hospitality</div>
          <div class="class-item"><b>PHT: </b> Technology - Photography</div>
          <div class="class-item"><b>ARP: </b> Art - Painting</div>
          <div class="class-item"><b>ARD: </b> Art - Design</div>
          <div class="class-item"><b>ART: </b> Visual Art - Art</div>
          <div class="class-item"><b>MUS: </b> Performing Arts - Music General</div>
          <div class="class-item"><b>MUJ: </b> Performing Arts - Music Jazz</div>
          <div class="class-item"><b>DAN: </b> Performing Arts - Dance</div>
          <div class="class-item"><b>DRA: </b> Performing Arts - Drama</div>
          <div class="class-item"><b>MPA: </b> Performing Arts - Maori Performing Arts</div>
          <div class="class-item"><b>FSI: </b> Science - Forensics Science</div>
          <div class="class-item"><b>SFC: </b> Science - Food Chemistry</div>
          <div class="class-item"><b>SSU: </b> Science - Space And Us</div>
          <div class="class-item"><b>SNS: </b> Science - The Nature Of Science</div>
          <div class="class-item"><b>SCB: </b> Science - Chemistry And Biology</div>
          <div class="class-item"><b>SPS: </b> Science - Physics And Space Science</div>
          <div class="class-item"><b>BIO: </b> Science - Biology</div>
          <div class="class-item"><b>CHE: </b> Science - Chemistry</div>
          <div class="class-item"><b>PHY: </b> Science - Physics</div>
          <div class="class-item"><b>ELS: </b> Science - Environmental Life Science</div>
          <div class="class-item"><b>FRE: </b> Languages - French</div>
          <div class="class-item"><b>FRA: </b> Languages - French Advanced</div>
          <div class="class-item"><b>JPN: </b> Languages - Japanese</div>
          <div class="class-item"><b>JPA: </b> Languages - Japanese Advanced</div>
          <div class="class-item"><b>MDR: </b> Languages - Mandarin</div>
          <div class="class-item"><b>MDA: </b> Languages - Mandarin Advanced</div>
          <div class="class-item"><b>MAO: </b> Languages - Maori</div>
          <div class="class-item"><b>MAA: </b> Languages - Maori Advanced</div>
          <div class="class-item"><b>SAM: </b> Languages - Te Kura Samoan</div>
          <div class="class-item"><b>EPS: </b> Languages - English Proficiency Studies</div>
          <div class="class-item"><b>PWR: </b> English - Power Of The Word</div>
          <div class="class-item"><b>BUS: </b> Social Science - Business Studies</div>
          <div class="class-item"><b>COM: </b> Social Science - Commerce - Money Talks</div>
          <div class="class-item"><b>COT: </b> Social Science - International Travel</div>
          <div class="class-item"><b>GEO: </b> Social Science - Geography</div>
          <div class="class-item"><b>HIS: </b> Social Science - History</div>
          <div class="class-item"><b>CLS: </b> Social Science - Classical Studies</div>
          <div class="class-item"><b>ECC: </b> Social Science - Economics</div>
          <div class="class-item"><b>FIN: </b> Social Science - Financial Capability</div>
          <div class="class-item"><b>MED: </b> Social Science - Media Studies</div>
          <div class="class-item"><b>PSY: </b> Social Science - Psychology</div>
          <div class="class-item"><b>TOU: </b> Social Science - Tourism</div>
          <div class="class-item"><b>ENGA:</b> 11 ENG 1 - Sport And Society</div>
          <div class="class-item"><b>ENGB:</b> 11 ENG 1 - English And The Environment</div>
          <div class="class-item"><b>ENGC:</b> 11 ENG 1 - Maori And Pacific Voices</div>
          <div class="class-item"><b>ENGD:</b> 11 ENG 1 - Conspiracy Theories</div>
          <div class="class-item"><b>ENGF:</b> 11 ENG 1 - Dystopia</div>
          <div class="class-item"><b>ENGG:</b> 11 ENG 1 - Messages In Music</div>
          <div class="class-item"><b>ENGH:</b> 11 ENG 1 - Modern Mythic</div>
          <div class="class-item"><b>ENGJ:</b> 11 ENG 2 - NZ Culture In Film</div>
          <div class="class-item"><b>ENGK:</b> 11 ENG 2 - It's The Little Things</div>
          <div class="class-item"><b>ENGL:</b> 11 ENG 2 - What Do They Have To Say?</div>
          <div class="class-item"><b>ENGM:</b> 11 ENG 2 - Poetry Power</div>
          <div class="class-item"><b>ENGN:</b> 11 ENG 2 - Maori And Pacific Voices 2</div>
          <div class="class-item"><b>ENGQ:</b> 11 ENG 2 - Wahine Toa</div>
          <div class="class-item"><b>MAC: </b> Mathematics - Mathematics With Calculus</div>
          <div class="class-item"><b>MAS: </b> Mathematics - Mathematics With Statistics</div>
          <div class="class-item"><b>GAT: </b> Pathways - Gateway Level ()</div>
          <div class="class-item"><b>PAT: </b> Pathways - Pathways Level ()</div>
          <div class="class-item"><b>WTA: </b> Pathways - Wellington Trades Academy</div>
          <div class="class-item"><b>MAHI:</b> Learning Support - Mahi Ora</div>
          <div class="class-item"><b>SPE: </b> Learning Support - SPEC</div>
          <div class="class-item"><b>LST: </b> Learning Support - Transition</div>
        </div>
      </div>

      <!--Classrooms-->
      <div id="tab-4">
        <?= DIVIDER ?>
        <input
          style="width: 100%; position: sticky; top: 1px; z-index: 10;"
          type="search"
          search-content="rooms"
          placeholder="Search For Rooms..."
          elements=".room-item">
        <!--All of the classrooms -->
        <div id="rooms">
          <div class="room-item"><b>PK01: </b><b>Main Building</b> Pukeko</div>
          <div class="room-item"><b>PK02: </b><b>Main Building</b> Pukeko</div>
          <div class="room-item"><b>PK03: </b><b>Main Building</b> Pukeko</div>
          <div class="room-item"><b>PK04: </b><b>Main Building</b> Pukeko</div>
          <div class="room-item"><b>PK05: </b><b>Main Building</b> Pukeko</div>
          <div class="room-item"><b>PK06: </b><b>Main Building</b> Pukeko</div>
          <div class="room-item"><b>PK07: </b><b>Main Building</b> Pukeko</div>
          <div class="room-item"><b>PK08: </b><b>Main Building</b> Pukeko</div>
          <div class="room-item"><b>PK09: </b><b>Main Building</b> Pukeko</div>
          <div class="room-item"><b>PK10: </b><b>Main Building</b> Pukeko</div>
          <div class="room-item"><b>PK11: </b><b>Main Building</b> Pukeko</div>
          <div class="room-item"><b>PK12: </b><b>Main Building</b> Pukeko</div>
          <div class="room-item"><b>KR01: </b><b>Main Building</b> Kereru</div>
          <div class="room-item"><b>KR02: </b><b>Main Building</b> Kereru</div>
          <div class="room-item"><b>KR03: </b><b>Main Building</b> Kereru</div>
          <div class="room-item"><b>KR04: </b><b>Main Building</b> Kereru</div>
          <div class="room-item"><b>KR05: </b><b>Main Building</b> Kereru</div>
          <div class="room-item"><b>KR06: </b><b>Main Building</b> Kereru</div>
          <div class="room-item"><b>KR07: </b><b>Main Building</b> Kereru</div>
          <div class="room-item"><b>KR08: </b><b>Main Building</b> Kereru</div>
          <div class="room-item"><b>KR09: </b><b>Main Building</b> Kereru</div>
          <div class="room-item"><b>KR10: </b><b>Main Building</b> Kereru</div>
          <div class="room-item"><b>KR11: </b><b>Main Building</b> Kereru</div>
          <div class="room-item"><b>KR12: </b><b>Main Building</b> Kereru</div>
          <div class="room-item"><b>KT01: </b><b>Main Building</b> Kotuku</div>
          <div class="room-item"><b>KT02: </b><b>Main Building</b> Kotuku</div>
          <div class="room-item"><b>KT03: </b><b>Main Building</b> Kotuku</div>
          <div class="room-item"><b>KT04: </b><b>Main Building</b> Kotuku</div>
          <div class="room-item"><b>KT05: </b><b>Main Building</b> Kotuku</div>
          <div class="room-item"><b>KT06: </b><b>Main Building</b> Kotuku</div>
          <div class="room-item"><b>KT07: </b><b>Main Building</b> Kotuku</div>
          <div class="room-item"><b>KT08: </b><b>Main Building</b> Kotuku</div>
          <div class="room-item"><b>KT09: </b><b>Main Building</b> Kotuku</div>
          <div class="room-item"><b>KT10: </b><b>Main Building</b> Kotuku</div>
          <div class="room-item"><b>KT11: </b><b>Main Building</b> Kotuku</div>
          <div class="room-item"><b>KT12: </b><b>Main Building</b> Kotuku</div>
          <div class="room-item"><b>KM01: </b><b>Main Building</b> Korimako</div>
          <div class="room-item"><b>KM02: </b><b>Main Building</b> Korimako</div>
          <div class="room-item"><b>KM03: </b><b>Main Building</b> Korimako</div>
          <div class="room-item"><b>KM04: </b><b>Main Building</b> Korimako</div>
          <div class="room-item"><b>KM05: </b><b>Main Building</b> Korimako</div>
          <div class="room-item"><b>KM06: </b><b>Main Building</b> Korimako</div>
          <div class="room-item"><b>KM07: </b><b>Main Building</b> Korimako</div>
          <div class="room-item"><b>KM08: </b><b>Main Building</b> Korimako</div>
          <div class="room-item"><b>KM09: </b><b>Main Building</b> Korimako</div>
          <div class="room-item"><b>KM10: </b><b>Main Building</b> Korimako</div>
          <div class="room-item"><b>KM11: </b><b>Main Building</b> Korimako</div>
          <div class="room-item"><b>KM12: </b><b>Main Building</b> Korimako</div>
          <div class="room-item"><b>TN01: </b><b>Main Building</b> Technology</div>
          <div class="room-item"><b>TN02: </b><b>Main Building</b> Technology</div>
          <div class="room-item"><b>TN03: </b><b>Main Building</b> Technology</div>
          <div class="room-item"><b>TN04: </b><b>Main Building</b> Technology</div>
          <div class="room-item"><b>VA01: </b><b>Main Building</b> Art</div>
          <div class="room-item"><b>VA02: </b><b>Main Building</b> Art</div>
          <div class="room-item"><b>FT01: </b><b>Main Building</b> Food</div>
          <div class="room-item"><b>SC01: </b><b>Main Building</b> Science</div>
          <div class="room-item"><b>SC02: </b><b>Main Building</b> Science</div>
          <div class="room-item"><b>SC03: </b><b>Main Building</b> Science</div>
          <div class="room-item"><b>TM01: </b><b>Main Building</b> Music</div>
          <div class="room-item"><b>TM02: </b><b>Main Building</b> Music</div>
          <div class="room-item"><b>TM03: </b><b>Main Building</b> Music</div>
          <div class="room-item"><b>TM04: </b><b>Main Building</b> Music</div>
          <div class="room-item"><b>TM05: </b><b>Main Building</b> Music</div>
          <div class="room-item"><b>TM06: </b><b>Main Building</b> Music</div>
          <div class="room-item"><b>TM07: </b><b>Main Building</b> Music</div>
          <div class="room-item"><b>TM08: </b><b>Main Building</b> Music</div>
          <div class="room-item"><b>GM01: </b><b>Main Building</b> Gym</div>
          <div class="room-item"><b>GM02: </b><b>Main Building</b> Gym</div>
          <div class="room-item"><b>MS1: </b><b>Outside</b> MultiSpace</div>
          <div class="room-item"><b>MS2: </b><b>Outside</b> MultiSpace</div>
          <div class="room-item"><b>MS3: </b><b>Outside</b> MultiSpace</div>
          <div class="room-item"><b>V1: </b><b>Outside</b> Village</div>
          <div class="room-item"><b>V2: </b><b>Outside</b> Village</div>
          <div class="room-item"><b>V3: </b><b>Outside</b> Village</div>
          <div class="room-item"><b>V4: </b><b>Outside</b> Village</div>
          <div class="room-item"><b>V5: </b><b>Outside</b> Village</div>
          <div class="room-item"><b>V6: </b><b>Outside</b> Village</div>
          <div class="room-item"><b>V7: </b><b>Outside</b> Village</div>
          <div class="room-item"><b>V8: </b><b>Outside</b> Village</div>

          <!--<div class="room-item"><b></b><b></b></div>-->

        </div>

      </div>

    </div>
  </section>

</div>
<link rel="stylesheet" href="CSS/jQuery-ui-tabs.css">
<?php require_once "Includes/footer.php"; ?>
</body>
</html>