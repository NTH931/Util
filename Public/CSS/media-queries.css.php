<?php

require_once '../../Private/PHP/variables.php';
require_once './css-functions.php';
header("Content-Type: text/css");

##########
# COLORS #
##########

$theme = "";
$baseColor = "";
$baseTheme = $_SETTINGS["Base-Color"];

switch ($baseTheme) {
  case "red":
  case "orange":
    $theme = "RED";
    $confilct = "GREEN";
    $baseColor = "#ff7700";
    break;
  case "yellow":
    $theme = "RED";
    $confilct = "GREEN";
    $baseColor = "#ffaa00";
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
    $baseColor = "#ab00ff";
    break;
  default:
    $theme = "BLUE";
    $confilct = "GREEN";
    $baseColor = "#0077ff";
    break;
}

$light = cookie_get("settings")["Dark-Mode"];

function ifTheme(string|array $testcolor, int $darkenBy, int $darkenFilterColorBy = null) {
  global $baseTheme;
  global $baseColor;
  global $theme;
  if ($baseTheme === $testcolor) {
    return darken($baseColor, $darkenBy);
  } else {
    return filter_color($theme, darken($baseColor,  isset($darkenFilterColorBy) ? $darkenFilterColorBy : $darkenBy));
  }
}

# Defaults
$textColor = greyscale("#dd");
$redText   = lighten(enhance($theme, $baseColor, 225), 15);
$green     = filter_color(["GREEN", $theme], darken($baseColor, 20));
$darkGreen = darken(enhance("GREEN", $green), 80);
$darkRed   = filter_color("RED", enhance("RED", $baseColor, 60));

if (!$light) { # Dark mode
  $buttonBg           = filter_color([$theme, $confilct], darken($baseColor, 85));
  $buttonBgL          = filter_color([$theme, $confilct], darken($baseColor, 70));
  $buttonBgLL         = filter_color([$theme, $confilct], darken($baseColor, 75));
  $buttonBgLLL        = filter_color([$theme, $confilct], darken($baseColor, 60));
  $backgroundColor    = darken($baseColor, 99);
  $backgroundColorL   = darken($baseColor, 95);
  $backgroundColorLL  = filter_color([$theme, $confilct], darken($baseColor, 80));
  $backgroundColorLLL = filter_color([$theme, $confilct], darken($baseColor, 55));
  $highlightColor     = $baseColor;
} else { # Light Mode
  $buttonBg           = darken(filter_color([$theme, $confilct], $baseColor), 75);
  $buttonBgL          = filter_color([$theme, $confilct], darken($baseColor, 70));
  $buttonBgLL         = filter_color([$theme, $confilct], darken($baseColor, 65));
  $buttonBgLLL        = filter_color([$theme, $confilct], darken($baseColor, 62));
  $backgroundColor    = darken($baseColor, 55);
  $backgroundColorL   = filter_color([$theme, $confilct], darken($baseColor, 60));
  $backgroundColorLL  = filter_color([$theme, $confilct], darken($baseColor, 35));
  $backgroundColorLLL = filter_color([$theme, $confilct], darken($baseColor, 30));
  $highlightColor     = lighten($baseColor, 100);
}

echo <<<CSS
:root {
  --button-bg: $buttonBg;
  --button-bg-l: $buttonBgL;
  --button-bg-ll: $buttonBgLL;
  --button-bg-lll: $buttonBgLLL;
  --text-color: $textColor; /* color of text */
  --background-color: $backgroundColor; /* color of background */
  --background-color-l: $backgroundColorL; /* color of light background */
  --background-color-ll: $backgroundColorLL;
  --background-color-lll: $backgroundColorLLL;
  --highlight-color: $highlightColor; /* color of dividers */
  --red-text: $redText;
  --green: $green;
  --darkgreen: $darkGreen;
  --darkred: $darkRed
}
CSS;