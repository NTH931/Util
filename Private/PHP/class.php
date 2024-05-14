<?php
require_once "../../Public/Includes/process.php";

set_error_handler("allErrors");
$jsonFile = "../../" . STORAGE_FILE;


$subjects = array(
  "INVALID" => null,
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


$valid_urls = true;
$existing_data = [];

$data = file_get_contents($jsonFile);
$existing_data = json_decode($data, true);

for ($i = 1; $i < 8; $i++) {
    $post_key = "class" . $i;
    $post_key2 = "selection" . $i;
    $subject_name = $_POST["selection" . $i] ?? null;
    $class_url = $_POST["class" . $i] ?? null;

    // Check if both class URL and subject name are provided
    if (!empty($class_url) && !empty($subject_name)) {
        $existing_data["class" . $i] = array(
            "subject" => $subjects[$subject_name],
            "link" => $class_url
        );
    } elseif (!empty($class_url) && empty($subject_name)) {
        // Check if only class URL is provided
        $existing_data["class" . $i] = array(
            "link" => $class_url
        );
    } elseif (!empty($subject_name) && empty($class_url)) {
        // Check if only subject name is provided
        $existing_data["class" . $i] = array(
            "subject" => $subjects[$subject_name]
        );
    } else {
        // If neither class URL nor subject name is provided, unset the entry
        unset($existing_data["class" . $i]);
    }
}

unset($subjects);
var_dump($existing_data);

// Write the updated data back to the JSON file
if(!empty($existing_data)) {
    file_put_contents($jsonFile, json_encode($existing_data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
} else {
    header("Location: ../../Public/index.php?error=1");
    exit();
}

if ($valid_urls) {
    header("Location: ../../Public/index.php");
    exit();
}