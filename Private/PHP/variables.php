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

# Arrays

global $subjects;
$subjects = array(
  "HuiAko" => "HuiAko",
  "INT" => "Intergrated Studies",
  "INS" => "Intergrated Studies Neuro-Diverse",
  "ENG" => "English",
  "MAT" => "Maths",
  "SCI" => "Science",
  "AHI" => "Aotearoa Histories",
  "HPE" => "Health & PE",
  "HEA" => "Health & Wellbeing",
  "PEO" => "Physical Education Outdoors",
  "PED" => "Physical Education",
  "PES" => "Sports And Training",
  "TGC" => "Coding For Gaming",
  "TDE" => "Digital Technologies",
  "DTE" => "Digital Technology Enviroments",
  "TPD" => "Product Design And Construction",
  "TBT" => "Bio Technology",
  "TDV" => "Architecture And Product Design",
  "TFD" => "Food Around The World",
  "TTX" => "Fashion And Textiles",
  "JDT" => "Jewellery And Product Design",
  "CAR" => "Carpentry",
  "HOS" => "Hospitality",
  "PHT" => "Photography",
  "ARP" => "Art Painting",
  "ARD" => "Art Design",
  "ART" => "Visual Art",
  "MUS" => "Music",
  "MUJ" => "Music Jazz",
  "DAN" => "Dance",
  "DRA" => "Drama",
  "MPA" => "Maori Performing Arts",
  "FSI" => "Forensics Science",
  "SFC" => "Food Chemistry",
  "SSU" => "Space And Us",
  "SNS" => "The Nature Of Science",
  "SCB" => "Chemistry And Biology",
  "SPS" => "Physics And Space Science",
  "BIO" => "Biology",
  "CHE" => "Chemistry",
  "PHY" => "Physics",
  "ELS" => "Enviromental Life Science",
  "FRE" => "French",
  "FRA" => "French Advanced",
  "JPN" => "Japanese",
  "JPA" => "Japanese Advanced",
  "MDR" => "Mandarin",
  "MDA" => "Mandarin Advanced",
  "MAO" => "Maori",
  "MAA" => "Maori Advanced",
  "SAM" => "Te Kura Samoan",
  "EPS" => "English Proficiency Studies",
  "PWR" => "Power Of The Word",
  "BUS" => "Business Studies",
  "COM" => "Commerce Money Talks",
  "COT" => "Interenational Travel",
  "GEO" => "Geography",
  "HIS" => "History",
  "CLS" => "Classical Studies",
  "ECC" => "Economics",
  "FIN" => "Financial Capability",
  "MED" => "Media Studies",
  "PSY" => "Pyschology",
  "TOU" => "Tourism",
  "ENGA" => "Sport And Society",
  "ENGB" => "English And The Enviroment",
  "ENGC" => "Maori And Pacific Voices",
  "ENGD" => "Conspiracy Theories",
  "ENGF" => "Dystopia",
  "ENGG" => "Messages In Music",
  "ENGH" => "Modern Mythic",
  "ENGJ" => "NZ Culture In Film",
  "ENGK" => "It's The Little Things",
  "ENGL" => "What Do They Have To Say?",
  "ENGM" => "Poetry Power",
  "ENGN" => "Maori And Pacific Voices 2",
  "ENGQ" => "Wahine Toa",
  "MAC" => "Mathematics With Calculus",
  "MAS" => "Mathematics With Statistics",
  "GAT" => "Pathways Gateway Level",
  "PAT" => "Pathways Pathways Level",
  "WTA" => "Pathways Wellington Trades Academy",
  "SPEC" => "Learning Support - SPEC",
  "LST" => "Learning Support Transition"
);