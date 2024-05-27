<!DOCTYPE html>
<html>
  <?php
    include "Includes/header.php";
    include "Includes/process.php";
  ?>
  <style>
    :root {
      --txt-color: --text-color;
    }

    label {
      color: var(--text-color);
    }

  </style>
  <body>
    <h1 style="text-decoration: underline;">Settings</h1>
    <form action="Includes/setprocess.php" method="post">

      <label for="tooltips"><b>ToolTips:</b></label>
      <input id="tooltips" type="checkbox" checked>
      <br><hr><br>
      <label for="text-color"><b>Text Color:</b></label>
      <input id="text-color" type="text">
      <br><hr><br>
      <label for="bgcolor"><b>Background Color:</b></label>
      <input id="bgcolor" type="input" value="Default">
      <br><hr><br>
      <label for="rightclick"><b>Right Click Classrooms:</b></label>
      <input id="rightclick" type="checkbox" checked>
      <br><hr><br>
      <label for=""><b>:</b></label>
      <input id="" type="checkbox" checked>

    </form>
  </body>
</html>