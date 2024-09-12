<?php
  global $selectedIndex;
  $selectedIndex = $_GET["selectedindex"] ?? null; // Use the null coalescing operator to assign a default value if not set

  if (!isset($selectedIndex) || $selectedIndex < 0) {
      $selectedIndex = null; // Reset to null if the index is invalid
  }

  if (!function_exists("i")) {
    function i(int $thisIndex): string {
      global $selectedIndex;
      return ($selectedIndex === $thisIndex) ? "selected" : "";
    }
  }

  $default = ($selectedIndex === null) ? "selected" : "";
?>
        <option value="INVALID" hidden <?= $default ?>>Pick a Subject</option>
        <option value="INT" <?= i(1) ?>>Intergrated Studies</option>
        <option value="INS" <?= i(2) ?>>Intergrated Studies - Neuro-Diverse</option>
        <option value="ENG" <?= i(3) ?>>English</option>
        <option value="MAT" <?= i(4) ?>>Maths</option>
        <option value="SCI" <?= i(5) ?>>Science</option>
        <option value="AHI" <?= i(6) ?>>Aotearoa Histories</option>
        <option value="HPE" <?= i(7) ?>>Health & PE</option>

        <option value="HEA" <?= i(8) ?>>HPE - Health & Wellbeing</option>
        <option value="PEO" <?= i(9) ?>>HPE - Physical Education Outdoors</option>
        <option value="PED" <?= i(10) ?>>HPE - Physical Education</option>
        <option value="PES" <?= i(11) ?>>HPE - Sports And Training</option>

        <option value="TGC" <?= i(12) ?>>Technology - Coding For Gaming</option>
        <option value="TDE" <?= i(13) ?>>Technology - Digital Technologies</option>
        <option value="DTE" <?= i(14) ?>>Technology - Digital Technology Enviroments</option>
        <option value="TPD" <?= i(15) ?>>Technology - Product Design And Construction</option>
        <option value="TBT" <?= i(16) ?>>Technology - Bio Technology</option>
        <option value="TDV" <?= i(17) ?>>Technology - Architecture And Product Design</option>
        <option value="TFD" <?= i(18) ?>>Technology - Food Around The World</option>
        <option value="TTX" <?= i(19) ?>>Technology - Fashion And Textiles</option>
        <option value="JDT" <?= i(20) ?>>Technology - Jewellery And Product Design</option>
        <option value="CAR" <?= i(21) ?>>Technology - Carpentry</option>
        <option value="HOS" <?= i(22) ?>>Technology - Hospitality</option>
        <option value="PHT" <?= i(23) ?>>Technology - Photography</option>

        <option value="ARP" <?= i(24) ?>>Art - Painting</option>
        <option value="ARD" <?= i(25) ?>>Art - Design</option>
        <option value="ART" <?= i(26) ?>>Visual Art - Art</option>

        <option value="MUS" <?= i(27) ?>>Performing Arts - Music General</option>
        <option value="MUJ" <?= i(28) ?>>Performing Arts - Music Jazz</option>
        <option value="DAN" <?= i(29) ?>>Performing Arts - Dance</option>
        <option value="DRA" <?= i(30) ?>>Performing Arts - Drama</option>
        <option value="MPA" <?= i(31) ?>>Performing Arts - Maori Performing Arts</option>

        <option value="FSI" <?= i(32) ?>>Science - Forensics Science</option>
        <option value="SFC" <?= i(33) ?>>Science - Food Chemistry</option>
        <option value="SSU" <?= i(34) ?>>Science - Space And Us</option>
        <option value="SNS" <?= i(35) ?>>Science - The Nature Of Science</option>
        <option value="SCB" <?= i(36) ?>>Science - Chemistry And Biology</option>
        <option value="SPS" <?= i(37) ?>>Science - Physics And Space Science</option>
        <option value="BIO" <?= i(38) ?>>Science - Biology</option>
        <option value="CHE" <?= i(39) ?>>Science - Chemistry</option>
        <option value="PHY" <?= i(40) ?>>Science - Physics</option>
        <option value="ELS" <?= i(41) ?>>Science - Enviromental Life Science</option>

        <option value="FRE" <?= i(42) ?>>Languages - French</option>
        <option value="FRA" <?= i(43) ?>>Languages - French Advanced</option>
        <option value="JPN" <?= i(44) ?>>Languages - Japanese</option>
        <option value="JPA" <?= i(45) ?>>Languages - Japanese Advanced</option>
        <option value="MDR" <?= i(46) ?>>Languages - Mandarin</option>
        <option value="MDA" <?= i(47) ?>>Languages - Mandarin Advanced</option>
        <option value="MAO" <?= i(48) ?>>Languages - Maori</option>
        <option value="MAA" <?= i(49) ?>>Languages - Maori Advanced</option>
        <option value="SAM" <?= i(50) ?>>Languages - Te Kura Samoan</option>
        <option value="EPS" <?= i(51) ?>>Languages - English Proficiency Studies</option>
        <option value="PWR" <?= i(52) ?>>English - Power Of The Word</option>

        <option value="BUS" <?= i(53) ?>>Social Science - Business Studies</option>
        <option value="COM" <?= i(54) ?>>Social Science - Commerce - Money Talks</option>
        <option value="COT" <?= i(55) ?>>Social Science - Interenational Travel</option>
        <option value="GEO" <?= i(56) ?>>Social Science - Geography</option>
        <option value="HIS" <?= i(57) ?>>Social Science - History</option>
        <option value="CLS" <?= i(58) ?>>Social Science - Classical Studies</option>
        <option value="ECC" <?= i(59) ?>>Social Science - Economics</option>
        <option value="FIN" <?= i(60) ?>>Social Science - Financial Capability</option>
        <option value="MED" <?= i(61) ?>>Social Science - Media Studies</option>
        <option value="PSY" <?= i(62) ?>>Social Science - Pyschology</option>
        <option value="TOU" <?= i(63) ?>>Social Science - Tourism</option>

        <option value="ENGA" <?= i(64) ?>>11 ENG 1 - Sport And Society</option>
        <option value="ENGB" <?= i(65) ?>>11 ENG 1 - English And The Enviroment</option>
        <option value="ENGC" <?= i(66) ?>>11 ENG 1 - Maori And Pacific Voices</option>
        <option value="ENGD" <?= i(67) ?>>11 ENG 1 - Conspiracy Theories</option>
        <option value="ENGF" <?= i(68) ?>>11 ENG 1 - Dystopia</option>
        <option value="ENGG" <?= i(69) ?>>11 ENG 1 - Messages In Music</option>
        <option value="ENGH" <?= i(70) ?>>11 ENG 1 - Modern Mythic</option>
        <option value="ENGJ" <?= i(71) ?>>11 ENG 2 - NZ Culture In Film</option>
        <option value="ENGK" <?= i(72) ?>>11 ENG 2 - It's The Little Things</option>
        <option value="ENGL" <?= i(73) ?>>11 ENG 2 - What Do They Have To Say?</option>
        <option value="ENGM" <?= i(74) ?>>11 ENG 2 - Poetry Power</option>
        <option value="ENGN" <?= i(75) ?>>11 ENG 2 - Maori And Pacific Voices 2</option>
        <option value="ENGQ" <?= i(76) ?>>11 ENG 2 - Wahine Toa</option>

        <option value="MAC" <?= i(77) ?>>Mathematics - Mathematics With Calculus</option>
        <option value="MAS" <?= i(78) ?>>Mathematics - Mathematics With Statistics</option>

        <option value="GAT" <?= i(79) ?>>Pathways - Gateway Level ()</option>
        <option value="PAT" <?= i(80) ?>>Pathways - Pathways Level ()</option>
        <option value="WTA" <?= i(81) ?>>Pathways - Wellington Trades Academy</option>

        <option value="SPEC" <?= i(82) ?>>Learning Support - SPEC</option>
        <option value="LST" <?= i(83) ?>>Learning Support - Transition</option>