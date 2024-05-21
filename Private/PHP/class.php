<?php
$data = array(
    "class2" => array("subject" => NULL),
    "class3" => array("subject" => NULL),
    "class4" => array("subject" => NULL),
    "class5" => array("subject" => NULL),
    "class6" => array("subject" => NULL),
    "class7" => array("subject" => NULL),
);

$jsonFilePath = '../../Private/JSON/storage.json';

// Load existing data from storage.json
$existingData = json_decode(file_get_contents($jsonFilePath), true);
if ($existingData === null) {
    $existingData = [];
}

// Update existing data with new non-empty values
foreach ($data as $classKey => $classValue) {
    if (!empty($classValue['subject'])) {
        $existingData[$classKey] = $classValue;
    }
}

// Write the updated data back to storage.json
try {
    $jsonData = json_encode($existingData, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    file_put_contents($jsonFilePath, $jsonData);
    echo "<script>alert('File updated successfully.')</script>";
    header("Location: ../../Public/index.php");
} catch (Exception $e) {
    echo "<script>alert('Error writing to file: '" . $e->getMessage() . "')</script>";
    header("Location: ../../Public/Links.php");
}