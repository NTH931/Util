<?php


// Ensure that the data is being sent via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Define the subjects array
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

    $data = array();
    for ($i = 1; $i < 9; $i++) {
        if ($i === 1) {
            $class = "HuiAko";
        } else {
            $class = isset($_POST["selection$i"]) ? $_POST["selection$i"] : null;
        }
        $link = isset($_POST["class$i"]) ? $_POST["class$i"] : null;
        $data["class$i"] = array();

        if ($class != null && $class != "" && isset($subjects[$class])) {
            $data["class$i"]["subject"] = $subjects[$class];
        }

        if ($link != null && $link != "") {
            $data["class$i"]["link"] = $link;
        }
    }

    $jsonFilePath = '../../Private/JSON/storage.json';

    // Load existing data from storage.json
    $existingData = json_decode(file_get_contents($jsonFilePath), true);
    if ($existingData === null) {
        $existingData = [];
    }

    // Update existing data with new values
    foreach ($data as $classKey => $classValue) {
        if ($classValue !== null) {
            // Check if the class key exists in the existing data
            if (isset($existingData[$classKey])) {
                // Update only the non-null values
                foreach ($classValue as $key => $value) {
                    if ($value !== null) {
                        $existingData[$classKey][$key] = $value;
                    }
                }
            } else {
                // Add the new class key-value pair
                $existingData[$classKey] = $classValue;
            }
        }
    }

    // Write the updated data back to storage.json
    try {
        $jsonData = json_encode($existingData, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
        file_put_contents($jsonFilePath, $jsonData);

        // Display success alert
        echo "<script>alert('File updated successfully.');</script>";

        // Redirect to the specified page
        header("Location: ../../Public/index.php");
        exit();
  } catch (Exception $e) {
    // Display error alert
    echo "<script>alert('Error writing to file: " . $e->getMessage() . "');</script>";

    // Redirect to the error page
    header("Location: ../../Public/Links.php");
    exit();
  }
}