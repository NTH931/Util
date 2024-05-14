<!DOCTYPE html>
 </html>
    <?php
  require "Includes/header.php";
  require_once "Includes/process.php"; 
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
            width: calc(70vw + 2px) !important;
            border-radius: 10px !important;
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
            padding-top: 4px;
            padding-bottom: 8px;
            padding-right: 288px;
            border-radius: 10px;
            margin-left: 5px;
            margin-right: 18px;
            background-color: white;
            color: blue;
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
<body>
    <!-- Your HTML content here -->
    <h1>Links</h1>
    <hr>
    <h4 style="margin-left: 10px;">The link MUST start with 'https://classroom.google.com/', then your class ID (Found in the addres bar after https://classroom.google.com/)</h4>
    <!--HuiAko-->
    <div>
    <form method="post" action="./../Private/PHP/class.php">
        <label for="class1" style="white-space: nowrap;">HuiAko</label>
        <input pattern="https?://classroom\.google\.com/.*|" style="cursor: text;" type="text" size="30px" id="class1" name="class1" class="button" autocomplete="off">

        <br><br>

        <select name="selection2"><?php include "Includes/classes.php" ?></select>
        <input pattern="https?://classroom\.google\.com/.*|" style="cursor: text;" type="text" size="30px" id="class2"name="class2" class="button" autocomplete="off">

        <br><br>

        <select name="selection3"><?php include "Includes/classes.php" ?></select>
        <input pattern="https?://classroom\.google\.com/.*|" style="cursor: text;" type="text" size="30px" id="class3" name="class3" class="button" autocomplete="off">

        <br><br>

        <select name="selection4"><?php include "Includes/classes.php" ?></select>
        <input pattern="https?://classroom\.google\.com/.*|" style="cursor: text;" type="text" size="30px" id="class4" name="class4" class="button" autocomplete="off">

        <br><br>


        <select name="selection5"><?php include "Includes/classes.php" ?></select>
        <input pattern="https?://classroom\.google\.com/.*|" style="cursor: text;" type="text" size="30px" id="class5" name="class5" class="button" autocomplete="off">

        <br><br>

        <select name="selection6"><?php include "Includes/classes.php" ?></select>
        <input pattern="https?://classroom\.google\.com/.*|" style="cursor: text;" type="text" size="30px" id="class6" name="class6" class="button" autocomplete="off">
        <br><br>

        <select name="selection7"><?php include "Includes/classes.php" ?></select>
        <input pattern="https?://classroom\.google\.com/.*|" style="cursor: text;" type="text" size="30px" id="class7" name="class7" class="button" autocomplete="off">
        <br><br>

        <select name="selection8"><?php include "Includes/classes.php" ?></select>
        <input pattern="https?://classroom\.google\.com/.*|" style="cursor: text;" type="text" size="30px" id="class8" name="class8" class="button" autocomplete="off">
        <br>

        <button style="margin-top: 14px; margin-left: 5px; border-radius: 8px;" id="submit" type="submit" class="button" autocomplete="off">Submit</button>
    </form>
    </div>
    <?php include "Includes/footer.php"; ?>
  </body>
</html>