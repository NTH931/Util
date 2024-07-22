<?php 
function modify_color_strength(string $color, string $baseColor, int $enhancment = 100): string {
  // Remove the '#' from the base color if present
  $baseColor = ltrim($baseColor, '#');

  // Validate the color input
  if (!in_array($color, ['RED', 'GREEN', 'BLUE'])) {
      return "Invalid color. Please use 'RED', 'GREEN', or 'BLUE'.";
  }

  // Convert base color hex to RGB
  $rBase = hexdec(substr($baseColor, 0, 2));
  $gBase = hexdec(substr($baseColor, 2, 2));
  $bBase = hexdec(substr($baseColor, 4, 2));

  // Initialize enhanced color components
  $rEnhanced = $rBase;
  $gEnhanced = $gBase;
  $bEnhanced = $bBase;

  // Enhance the specified color
  switch ($color) {
      case "RED":
          $rEnhanced = min(255, $rBase + $enhancment); // Enhance red
          break;
      case "GREEN":
          $gEnhanced = min(255, $gBase + $enhancment); // Enhance green
          break;
      case "BLUE":
          $bEnhanced = min(255, $bBase + $enhancment); // Enhance blue
          break;
  }

  // Return the enhanced color in hex format
  return sprintf("#%02x%02x%02x", $rEnhanced, $gEnhanced, $bEnhanced);
}

function filter_color(array|string $color, string $hex) {
  if (str_starts_with($hex, '#')) {
      $hex = substr($hex, 1);
  } else {
      return "Invalid color or hex format.";
  }

  if (is_array($color) && count($color) === 3 && 
      in_array("RED", $color) && 
      in_array("GREEN", $color) && 
      in_array("BLUE", $color)) {
    return "Usage of all colors is not valid.";
  }

  $r = 0;
  $g = 0;
  $b = 0;

  if (is_array($color)) {
    $r = in_array("RED", $color) ? hexdec(substr($hex, 0, 2)) : 0;
    $g = in_array("GREEN", $color) ? hexdec(substr($hex, 2, 2)) : 0;
    $b = in_array("BLUE", $color) ? hexdec(substr($hex, 4, 2)) : 0;
  } else {
    $r = $color === "RED" || $color === "GREY" ? hexdec(substr($hex, 0, 2)) : 0;
        $g = $color === "GREEN" || $color === "GREY" ? hexdec(substr($hex, 2, 2)) : 0;
        $b = $color === "BLUE" || $color === "GREY" ? hexdec(substr($hex, 4, 2)) : 0;
    if ($color === "GREY") {
      if ($color === "GREY") {
        $grey = ($r + $g + $b) / 3;
        return sprintf("#%02x%02x%02x", $grey, $grey, $grey);
    }
    }
  }

  // Format the RGB values to two digits and return
  return sprintf("#%02x%02x%02x", $r, $g, $b);
}

function greyscale(string $hex) {
  if (str_starts_with($hex, '#') && strlen($hex) === 3) {
    return $hex . substr($hex, 1) . substr($hex, 1);
  }
}

function adjustHue(string $hex, $degrees) {
  $hash = '';
  if (str_starts_with($hex, '#')) {
      $hex = substr($hex, 1);
      $hash = '#';
  }

  // Convert hex to RGB
  $r = hexdec(substr($hex, 0, 2)) / 255;
  $g = hexdec(substr($hex, 2, 2)) / 255;
  $b = hexdec(substr($hex, 4, 2)) / 255;

  // Convert RGB to HSL
  $max = max($r, $g, $b);
  $min = min($r, $g, $b);
  $delta = $max - $min;
  $l = ($max + $min) / 2;

  if ($delta == 0) {
      $h = $s = 0; // achromatic
  } else {
      $s = $delta / (1 - abs(2 * $l - 1));
      switch ($max) {
          case $r:
              $h = 60 * fmod((($g - $b) / $delta), 6);
              if ($b > $g) { $h += 360; }
              break;

          case $g:
              $h = 60 * (($b - $r) / $delta + 2);
              break;

          case $b:
              $h = 60 * (($r - $g) / $delta + 4);
              break;
      }
  }

  // Adjust hue
  $h = fmod(($h + $degrees), 360);
  if ($h < 0) { $h += 360; }

  // Convert HSL back to RGB
  $c = (1 - abs(2 * $l - 1)) * $s;
  $x = $c * (1 - abs(fmod(($h / 60), 2) - 1));
  $m = $l - ($c / 2);

  if ($h >= 0 && $h < 60) { $r = $c; $g = $x; $b = 0; } 
  else if ($h >= 60 && $h < 120) { $r = $x; $g = $c; $b = 0; } 
  else if ($h >= 120 && $h < 180) { $r = 0; $g = $c; $b = $x; } 
  else if ($h >= 180 && $h < 240) { $r = 0; $g = $x; $b = $c; } 
  else if ($h >= 240 && $h < 300) { $r = $x; $g = 0; $b = $c; } 
  else { $r = $c; $g = 0; $b = $x; }
  $r = ($r + $m) * 255;
  $g = ($g + $m) * 255;
  $b = ($b + $m) * 255;

  return $hash . sprintf('%02x%02x%02x', round($r), round($g), round($b));
}

function adjustBrightness(string $hex, $percent) {
  $hash = '';
  if (str_starts_with($hex, '#')) {
      $hex = substr($hex, 1);
      $hash = '#';
  }

  $r = hexdec(substr($hex, 0, 2));
  $g = hexdec(substr($hex, 2, 2));
  $b = hexdec(substr($hex, 4, 2));

  $r = max(0, min(255, $r + $percent * 255 / 100));
  $g = max(0, min(255, $g + $percent * 255 / 100));
  $b = max(0, min(255, $b + $percent * 255 / 100));

  return $hash . sprintf('%02x%02x%02x', $r, $g, $b);
}

function darken(string $hex, $percent) { return adjustBrightness($hex, -$percent); }
function lighten(string $hex, $percent) { return adjustBrightness($hex, $percent); }
function enhance(string $color, string $baseColor, int $enhancment = 100) { return modify_color_strength($color, $baseColor, $enhancment); };
function de_enhance(string $color, string $baseColor, int $enhancment = 100) { return modify_color_strength($color, $baseColor, -$enhancment); };