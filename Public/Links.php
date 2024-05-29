<<<<<<< HEAD
<?php
require "Includes/header.php";
?>
  <style>
=======
<!DOCTYPE html>
 </html>
    <?php
  require "Includes/header.php";
  require_once "Includes/process.php";
  ?>
    <style>
>>>>>>> 21276100a7496e93e1737a23934a634c49fac588
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
<<<<<<< HEAD
            width: calc(70vw + 2px);
            border-radius: 10px;
=======
            width: calc(70vw + 2px) !important;
            border-radius: 10px !important;
>>>>>>> 21276100a7496e93e1737a23934a634c49fac588
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
<<<<<<< HEAD
            padding-top: 7px;
            padding-bottom: 7px;
=======
            padding-top: 4px;
            padding-bottom: 8px;
>>>>>>> 21276100a7496e93e1737a23934a634c49fac588
            padding-right: 288px;
            border-radius: 10px;
            margin-left: 5px;
            margin-right: 18px;
            background-color: var(--color);
<<<<<<< HEAD
            color: var(--a-color);
            font-size: .97rem;
=======
            color: blue;
>>>>>>> 21276100a7496e93e1737a23934a634c49fac588
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

<<<<<<< HEAD
  </style>
=======
    </style>
<body>
>>>>>>> 21276100a7496e93e1737a23934a634c49fac588
    <!-- Your HTML content here -->
    <h1>Links</h1>
    <hr>
    <h4 style="margin-left: 10px;">The link MUST start with 'https://classroom.google.com/', then your class ID (Found in the addres bar after https://classroom.google.com/)</h4>
    <!--HuiAko-->
    <div>
<<<<<<< HEAD
    <form name="classes" method="post" action="../Private/PHP/class.php">
        <label id="huiakolabel" for="class1" style="white-space: nowrap;">HuiAko</label>
        <input pattern="https?://classroom\.google\.com/.*||Reset" style="cursor: text;" type="text" size="30px" id="class1" name="class1" class="button" autocomplete="off">
=======
    <form method="post" action="../Private/PHP/class.php">
        <label for="class1" style="white-space: nowrap;">HuiAko</label>
        <input pattern="https?://classroom\.google\.com/.*|" style="cursor: text;" type="text" size="30px" id="class1" name="class1" class="button" autocomplete="off">
>>>>>>> 21276100a7496e93e1737a23934a634c49fac588

        <br><br>

        <select name="selection2"><?php include "Includes/classes.php" ?></select>
<<<<<<< HEAD
        <input pattern="https?://classroom\.google\.com/.*||Reset" style="cursor: text;" type="text" size="30px" id="class2"name="class2" class="button" autocomplete="off">
=======
        <input pattern="https?://classroom\.google\.com/.*|" style="cursor: text;" type="text" size="30px" id="class2"name="class2" class="button" autocomplete="off">
>>>>>>> 21276100a7496e93e1737a23934a634c49fac588

        <br><br>

        <select name="selection3"><?php include "Includes/classes.php" ?></select>
<<<<<<< HEAD
        <input pattern="https?://classroom\.google\.com/.*||Reset" style="cursor: text;" type="text" size="30px" id="class3" name="class3" class="button" autocomplete="off">
=======
        <input pattern="https?://classroom\.google\.com/.*|" style="cursor: text;" type="text" size="30px" id="class3" name="class3" class="button" autocomplete="off">
>>>>>>> 21276100a7496e93e1737a23934a634c49fac588

        <br><br>

        <select name="selection4"><?php include "Includes/classes.php" ?></select>
<<<<<<< HEAD
        <input pattern="https?://classroom\.google\.com/.*||Reset" style="cursor: text;" type="text" size="30px" id="class4" name="class4" class="button" autocomplete="off">

        <br><br>

        <select name="selection5"><?php include "Includes/classes.php" ?></select>
        <input pattern="https?://classroom\.google\.com/.*||Reset" style="cursor: text;" type="text" size="30px" id="class5" name="class5" class="button" autocomplete="off">
=======
        <input pattern="https?://classroom\.google\.com/.*|" style="cursor: text;" type="text" size="30px" id="class4" name="class4" class="button" autocomplete="off">

        <br><br>


        <select name="selection5"><?php include "Includes/classes.php" ?></select>
        <input pattern="https?://classroom\.google\.com/.*|" style="cursor: text;" type="text" size="30px" id="class5" name="class5" class="button" autocomplete="off">
>>>>>>> 21276100a7496e93e1737a23934a634c49fac588

        <br><br>

        <select name="selection6"><?php include "Includes/classes.php" ?></select>
<<<<<<< HEAD
        <input pattern="https?://classroom\.google\.com/.*||Reset" style="cursor: text;" type="text" size="30px" id="class6" name="class6" class="button" autocomplete="off">
        <br><br>

        <select name="selection7"><?php include "Includes/classes.php" ?></select>
        <input pattern="https?://classroom\.google\.com/.*||Reset" style="cursor: text;" type="text" size="30px" id="class7" name="class7" class="button" autocomplete="off">
        <br><br>

        <select name="selection8"><?php include "Includes/classes.php" ?></select>
        <input pattern="https?://classroom\.google\.com/.*||Reset" style="cursor: text;" type="text" size="30px" id="class8" name="class8" class="button" autocomplete="off">
=======
        <input pattern="https?://classroom\.google\.com/.*|" style="cursor: text;" type="text" size="30px" id="class6" name="class6" class="button" autocomplete="off">
        <br><br>

        <select name="selection7"><?php include "Includes/classes.php" ?></select>
        <input pattern="https?://classroom\.google\.com/.*|" style="cursor: text;" type="text" size="30px" id="class7" name="class7" class="button" autocomplete="off">
        <br><br>

        <select name="selection8"><?php include "Includes/classes.php" ?></select>
        <input pattern="https?://classroom\.google\.com/.*|" style="cursor: text;" type="text" size="30px" id="class8" name="class8" class="button" autocomplete="off">
>>>>>>> 21276100a7496e93e1737a23934a634c49fac588
        <br>

        <button style="margin-top: 14px; margin-left: 5px; border-radius: 8px;" id="submit" type="submit" class="button" autocomplete="off">Submit</button>
    </form>
    </div>
    <?php include "Includes/footer.php"; ?>
  </body>
</html>