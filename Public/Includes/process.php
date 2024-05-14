<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL | E_STRICT);
//set_error_handler("errorHandler"); // Set all Errors as Fatal Errors, and show all details

$_EXEC_SCRIPT = $_SERVER['SCRIPT_FILENAME'];
define("STORAGE_FILE__INCLUDES", "../../Private/JSON/storage.json"); //For files in Includes
define("STORAGE_FILE", "/Private/JSON/storage.json"); //For other positions

if (!function_exists("list_directory")) {
  function listDirectory($dir) {
    $files = scandir($dir);
    foreach($files as $file) {
        if ($file == '.' || $file == '..') continue;
        echo $dir . '/' . $file . PHP_EOL;
        if (is_dir($dir . '/' . $file)) {
            listDirectory($dir . '/' . $file);
        }
    }
  }
}

if (!function_exists('detect_int')) {
  function detect_int($string) {
    if (preg_match('/\d+/', $string, $matches)) {
      $number = $matches[0];
      return $number;
    } else {
      return null;
    }
  }
}

if (!function_exists('getUrl')) {
  function getUrl($jsonFile, $classid) {
      $jsonString = file_get_contents($jsonFile);// ?? exit("ERROR: File does not exist.");
      $data = json_decode($jsonString, true);
      if (isset($data[$classid])) {
          return [
              'link' => $data[$classid]['link'] ?? "#",
              'subject' => $data[$classid]['subject'] ?? "No Class Specified"
          ];
      }
      return null;
  }
}

if (!function_exists('allErrors')) {
  function allErrors($errno, $errstr, $errfile, $errline) {
    throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
  }
}


$jsonData = "/home/noahharan/Util/Private/JSON/storage.json";


for ($i = 1; $i < 9; $i++) {
  try {
  $classData = getUrl($jsonData, "class$i");
  ${"class$i"} = isset($classData["link"]) ? $classData['link'] : "#";
  if ($i == 1) continue;
  ${"sub$i"} = isset($classData["subject"]) ? $classData["subject"] : "HIDE_NULL";
  } catch (Exception $e) {
    exit("Error on iteration $i: $e");
  }
}