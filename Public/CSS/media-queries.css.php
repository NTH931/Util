<?php
require_once '../../Private/PHP/variables.php';
require_once './css-functions.php';
header("Content-Type: text/css");

##########
# COLORS #
##########

$theme = "";
$baseColor = "";

switch ($_SETTINGS["Base-Color"]) {
  case "red":
    $theme = "RED";
    $confilct = "GREEN";
    $baseColor = "#ff7700";
    break;
  case "orange":
    $theme = "RED";
    $confilct = "GREEN";
    $baseColor = "#ffaa00";
    break;
  case "yellow":
    $theme = "GREEN";
    $confilct = "RED";
    $baseColor = "#ffff00";
    break;
  case "green":
    $theme = "GREEN";
    $confilct = "BLUE";
    $baseColor = "#77ff77";
    break;
  case "blue":
    $theme = "BLUE";
    $confilct = "GREEN";
    $baseColor = "#0077ff";
    break;
  case "purple":
    $theme = "BLUE";
    $confilct = "RED";
    $baseColor = "#ed00ed";
    break;
  default:
    $theme = "BLUE";
    $confilct = "GREEN";
    $baseColor = "#0077ff";
    break;
}

$buttonBg = filter_color([$theme, $confilct], darken($baseColor, 85));
$buttonBgL = filter_color([$theme, $confilct], darken($baseColor, 70));
$buttonBgLL = filter_color([$theme, $confilct], darken($baseColor, 60));
$buttonBgLLL = filter_color([$theme, $confilct], darken($baseColor, 5));
$textColor = greyscale("#cc");
$backgroundColor = darken($baseColor, 99);
$backgroundColorL = darken($baseColor, 95);
$backgroundColorLL = filter_color([$theme, $confilct], darken($baseColor, 80));
$backgroundColorLLL = filter_color([$theme, $confilct], darken($baseColor, 55));
$highlightColor = $baseColor;
$redText = lighten(enhance($theme, $baseColor, 225), 15);
$green = filter_color(["GREEN", $theme], darken($baseColor, 20));
?>

:root {
  --button-bg: <?= $buttonBg ?>;
  --button-bg-l: <?= $buttonBgL ?>;
  --button-bg-ll: <?= $buttonBgLL ?>;
  --button-bg-lll: <?= $buttonBgLLL ?>;
  --text-color: <?= $textColor ?>; /* color of text */
  --background-color: <?= $backgroundColor ?>; /* color of background */
  --background-color-l: <?= $backgroundColorL ?>; /* color of light background */
  --background-color-ll: <?= $backgroundColorLL ?>;
  --background-color-lll: <?= $backgroundColorLLL ?>;
  --highlight-color: <?= $highlightColor ?>; /* color of dividers */
  --red-text: <?= $redText ?>;
  --green: <?= $green ?>;
}