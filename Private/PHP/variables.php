<?php
# php.ini settings
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL | E_STRICT);

# Constants
# Current Folder for __FILE__
@define("BASE_DIR", basename(__DIR__));
# The path before /Util
@define("SYS_DIR", systemPath(__DIR__) . DIRECTORY_SEPARATOR . "Util" . DIRECTORY_SEPARATOR);
# The full path of the Directory
@define("FULL_DIR", realpath(__DIR__));
# The exact location of the current file
@define("FULL_PATH", realpath(__DIR__) . "/" . basename(__FILE__));
# Current file exact
@define("CURR_FILE", basename(__FILE__));
# Current file executing
@define("EXEC_FILE", basename($_SERVER["SCRIPT_FILENAME"]));
# Current file executing (without extension)
@define("THIS_FILE", pathinfo(EXEC_FILE, PATHINFO_FILENAME));
# Servers Request Method
@define("REQ_METHOD", $_SERVER["REQUEST_METHOD"]);
# PHP_SELF
@define("PHP_SELF", $_SERVER["PHP_SELF"]);
# Newline
@define("nl", "\n");
@define("start", "s");
@define("end", "e");

if (isset($_COOKIE["settings"]) && isset($_COOKIE["page_visited"])) {
  $_SETTINGS = [
    "Tooltips" => cookie_get("settings")["Tooltips"],
    "Base-Color" => cookie_get("settings")["Base-Color"],
    "Notifications" => cookie_get("settings")["Notifications"],
    "Buttons" => cookie_get("settings")["Buttons"]
  ];
}

# Functions

function cookie_get(string $name): string|array|null {
  if (isset($_COOKIE["$name"])) {
    $namejson = json_decode($_COOKIE["$name"], true) ?? null;
    return $namejson;
  } else {
    return null;
  }
}

function cookie_set(string $name, string|array $value, $time_days = 1): void {
  setcookie($name, is_array($value) ? json_encode($value) : $value, time() + ($time_days * (24 * 60 * 60)), '/');
}

function Camel(string $string, bool $concat = false) {
  $lower = strtolower($string);
  $words = preg_split('/[^a-z0-9]+/', $lower);
  $CamelCase = ucfirst($words[0]);

  for ($i = 1; $i < count($words); $i++) {
      $CamelCase .= ucfirst($words[$i]);
      if (!$concat) {
          $CamelCase .= " ";
      }
  }

  return $CamelCase;
}

function systemPath($path) {
  $path = trim($path, '\\/');
  $directories = explode(DIRECTORY_SEPARATOR, $path);
  $utilPosition = array_search('Util', $directories);
  if ($utilPosition === false) {
      return null; # Or handle the error as needed
  }

  $directoriesBeforeUtil = array_slice($directories, 0, $utilPosition);
  $result = implode(DIRECTORY_SEPARATOR, $directoriesBeforeUtil);
  return $result ? $result : '.'; // Return '.' if result is empty (no directories before 'Util')
}

function substr_slice(string $type, string $string, string $character) {
  if ($type === "e" || $type === "end") {
    $position = strpos($string, $character);
    if ($position !== false) {
      // Remove the substring from the start to the position of the character (inclusive)
      $string = substr($string, $position + 1);
    }
  
    return $string;
  } elseif ($type === "s" || $type === "start") {
    $position = strpos($string, $character);
    if ($position !== false) {
      // Remove the substring from the character to the end of the string
      $string = substr($string, 0, $position);
    }
    
    return $string;
  }
}

# Arrays As SuperGlobals
$_ENV = [
  "defaultValues" => [
    # Value: Common colours
    "Base-Color" => "default",
    # Value: 1=all, 2=important_popup_only, 3=notification_panel_only
    "Notifications" => 1,
    # Value: Boolean
    "Tooltips" => true,
    # Value: Boolean
    "Dark-Mode" => true,
    # Assoc Array
    "Buttons" => [
      "GGL" => true,
      "WNP" => true,
      "QCT" => false,
      "EDC" => true,

      "ATC" => true,
      "ATL" => true,
      "ATN" => null,

      "NQA" => true,
      "NCR" => true,

      "GML" => true,
      "DRV" => true,
      "CLR" => true,
      "DCS" => true,
      "SLD" => true,
      "SHT" => true,
      "FRM" => true,
      "STS" => true,

      "KHT" => true,
      "BLK" => true,
      "RMB" => true,
      "USC" => true,
      "CVT" => true
    ]
  ]
];