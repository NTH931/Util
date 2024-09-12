<?php
  require "Includes/header.php";

  function input($name, $autocomplete = false) {
    return "<input pattern='https?://classroom\.google\.com/.*' type='text' size='30px' id='$name' name='$name' class='button invalid' autocomplete='" . ($autocomplete ? "on" : "off") . "'>";
  }
?>
  <style>

    div {
      width: 300px;
      clear: both;
      white-space: nowrap;
    }

    div > label, div > input, div > button, div > span {
      display: inline-block;
      width: 100px;
    }

    select {
      width: 350px;
      height: fit-content;
      padding: 6px;
      border-radius: 10px;
      border: none;
      margin-right: 18px;
      margin-left: 5px;
      transform: none;
    }

    select:focus {
      border: none;
    }

    select:hover {
      transform: none;
    }

    label {
      display: inline-block;
      width: fit-content;
      padding-left: 10px;
      padding-top: 7px;
      padding-bottom: 6px;
      padding-right: 290px;
      border-radius: 10px;
      margin-left: 5px;
      margin-right: 18px;
      color: var(--highlight-color);
      font-size: .97rem;
    }

    label:hover {
      cursor: pointer;
    }

    .storedLinkButton {
      margin-left: 20px;
      margin-right: 20px;
    }

    input[type=text] { width: calc(70vw + 2px) }

  </style>
    <hr>

    <h4 style="margin-left: 10px;">The link MUST start with 'https://classroom.google.com/', then your class ID (Found in the addres bar after https://classroom.google.com/)</h4>
    
    <form id="template" name="template" method="post" enctype="multipart/form-data">

      <label id="fileInput" for="file" style="padding-right: 10px;">Insert Util.json Template File Here</label>
      <input style="display: none" type="file" name="file" id="file" accept=".json">

    </form>

    <br>

    <form id="classes" name="classes" method="post">
      
      <!--HuiAko-->
      <?php $selectedIndex = null ?>
      <label id="huiakolabel" for="class1" style="white-space: nowrap;">HuiAko</label>

      <input type="hidden" name="HuiAko" value="HuiAko">
      <?= input("class1", false) ?>
      <br><br>

      <!--Class2-->
      <select name="selection2"><?php $selectedIndex = 1; require "Includes/classes.php" ?></select>
      <?= input("class2", false) ?>
      <br><br>
      
      <!--Class3-->
      <select name="selection3"><?php $selectedIndex = 4; require "Includes/classes.php" ?></select>
      <?= input("class3", false) ?>
      <br><br>
      
      <!--Class4-->
      <select name="selection4"><?php $selectedIndex = 5; require "Includes/classes.php" ?></select>
      <?= input("class4", false) ?>
      <br><br>
      
      <!--Class5-->
      <select name="selection5"><?php $selectedIndex = null; require "Includes/classes.php" ?></select>
      <?= input("class5", false) ?>
      <br><br>
      
      <!--Class6-->
      <select name="selection6"><?php $selectedIndex = null; require "Includes/classes.php" ?></select>
      <?= input("class6", false) ?>
      <br><br>
      
      <!--Class7-->
      <select name="selection7"><?php $selectedIndex = null; require "Includes/classes.php" ?></select>
      <?= input("class7", false) ?>
      <br>
      
      <!--Submit-->
      <input style="margin-top: 14px; margin-left: 5px; border-radius: 8px;" id="submit" type="submit" class="button">
      
      <!--Save Template and Submit-->
      <input style="margin-top: 14px; margin-left: 5px; border-radius: 8px;" id="submit&save" type="submit" class="button" value="Save as Template">
      
      <!--Reset-->
      <button style="margin-top: 14px; margin-left: 5px; border-radius: 8px;" id="reset" class="button">Reset</button>

    </form>
    <?php require "Includes/footer.php"; ?>
  </body>
</html>