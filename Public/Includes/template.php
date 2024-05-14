<!DOCTYPE html>
<html>
  <?php
  require "Includes/header.php";
  require_once "Includes/process.php"; 
  ?>
    <body onload="timeout(15000)">
    <div>
      <h1 style="color:white; display: inline-block; line-height: 10px;"><em>Util</em></h1>
      <hr style="width:110%;">
    </div>
      <h3><a href="<?php echo $classLink; ?>" style="font-size: larger;" target="_blank" id="storedLinkButton1" class="spanA storedLinkButton"><?php echo $subLink ?></a></h3>
      <br>
      <br>

      
    </body>
    <?php include "Includes/footer.php"; ?>
</html>