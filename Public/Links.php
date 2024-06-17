<?php
require "Includes/header.php";

function input($name, $autocomplete = false) {
    return "<input pattern='https?://classroom\.google\.com/.*||Reset' style='cursor: text;' type='text' size='30px' id='$name' name='$name' class='button' autocomplete='" . ($autocomplete ? "on" : "off") . "'>";
}
?>
  <style>
        /* Your CSS styles here */
        div {
            width: 300px;
            clear: both;
            white-space: nowrap;
        }

        div > label, div > input, div > button, div > span {
            display: inline-block;
            width: 100px;
        }

        input[type="text"] {
            width: calc(70vw + 2px);
            border-radius: 10px;
            padding: 3px;
        }

        input[type="text"]:hover {
            transform: scale(1.02);
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
            top: 4px;
            padding-left: 10px;
            padding-top: 7px;
            padding-bottom: 6px;
            padding-right: 290px;
            border-radius: 10px;
            margin-left: 5px;
            margin-right: 18px;
            background-color: var(--color);
            color: var(--a-color);
            font-size: .97rem;
        }
        label:hover {
            cursor: pointer;
        }

        #submit:hover {
          cursor: pointer;
        }

        .storedLinkButton {
            margin-left: 20px;
            margin-right: 20px;
        }

  </style>
    <hr>
    <h4 style="margin-left: 10px;">The link MUST start with 'https://classroom.google.com/', then your class ID (Found in the addres bar after https://classroom.google.com/)</h4>
    <!--HuiAko-->
    <div>
    <form id="classes" name="classes" method="post" action="js/classes.js">
        <label id="huiakolabel" for="class1" style="white-space: nowrap;">HuiAko</label>
        <input type="hidden" name="HuiAko" value="HuiAko">
        <?= input("class1", false) ?>
        <br><br>

        <select name="selection2"><?php include "Includes/classes.php" ?></select>
        <?= input("class2", false) ?>

        <br><br>

        <select name="selection3"><?php include "Includes/classes.php" ?></select>
        <?= input("class3", false) ?>

        <br><br>

        <select name="selection4"><?php include "Includes/classes.php" ?></select>
        <?= input("class4", false) ?>

        <br><br>

        <select name="selection5"><?php include "Includes/classes.php" ?></select>
        <?= input("class5", false) ?>

        <br><br>

        <select name="selection6"><?php include "Includes/classes.php" ?></select>
        <?= input("class6", false) ?>

        <br><br>

        <select name="selection7"><?php include "Includes/classes.php" ?></select>
        <?= input("class7", false) ?>

        <br><br>

        <select name="selection8"><?php include "Includes/classes.php" ?></select>
        <?= input("class1", false) ?>

        <br>

        <button style="margin-top: 14px; margin-left: 5px; border-radius: 8px;" id="submit" type="submit" class="button">Submit</button>

        <button style="margin-top: 14px; margin-left: 5px; border-radius: 8px;" id="reset" class="button">Reset</button>

    </form>
    </div>
    <?php include "Includes/footer.php"; ?>
    <script type="module" src="js/classes.js"></script>
  </body>
</html>