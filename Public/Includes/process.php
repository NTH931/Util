<?php
#############
# IMPORTANT #
#############
# Need to replace the JSON file storage with the localStorage($key, $value) variable in javascript.



# php.ini settings
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL | E_STRICT);

# Constants
# Current Folder for __FILE__
@define("BASE_DIR", basename(__DIR__));
# The path before /Util
@define("SYS_DIR", systemPath(__DIR__) . "/Util/");
# The full path of the Directory
@define("FULL_DIR", realpath(__DIR__));
# The exact location of the current file
@define("FULL_PATH", realpath(__DIR__) . "/" . basename(__FILE__));
# Current file exact
@define("CURR_FILE", basename(__FILE__));
# Current file executing
@define("EXT_FILE", basename($_SERVER["SCRIPT_FILENAME"]));
# Current file executing (without extension)
@define("REAL_FILE", pathinfo(EXT_FILE, PATHINFO_FILENAME));
# JSON storage file
@define("STORAGE_FILE", "Private/JSON/storage.json");


# Functions
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

function detect_int($string) {
  if (preg_match('/\d+/', $string, $matches)) {
    $number = $matches[0];
    return $number;
  } else {
    return null;
  }
}

function getUrl($jsonFile, $classid) {
  $jsonString = file_get_contents($jsonFile) ?? die("ERROR: File does not exist.");
  $data = json_decode($jsonString, true);
  if (isset($data[$classid])) {
    return [
      'link' => $data[$classid]['link'] ?? null,
      'subject' => $data[$classid]['subject'] ?? null
    ];
  }
}

function echo_buttons($jsonFile, $class) {
  $file = file_get_contents($jsonFile);
  $data = json_decode($file, true);
  for ($i = 0; $i <= 2; $i++) {
    echo $data["classbuttons"][$class][$i];
    echo "<br><br>";
  }
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

# Global Array
global $subjects;
$subjects = array(
  "INVALID" => "null",
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

# Setting Class Names and Links
for ($i = 1; $i < 9; $i++) {
  try {
    $classData = getUrl(SYS_DIR . "Private/JSON/storage.json", "class$i");
    ${"class$i"} = isset($classData["link"]) ? htmlspecialchars($classData['link']) : "#";
    if ($i == 1) continue;
    ${"sub$i"} = isset($classData["subject"]) ? htmlspecialchars($classData["subject"]) : "";
  } catch (Exception $e) {
    exit("Error on iteration $i: $e");
  }
}