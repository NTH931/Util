<?php
if (!isset($_GET['subject'])) {
  die("Subject parameter is missing.");
}

$subject = $_GET['subject'];
$subLink = $subject;  // Adjust this based on how you handle subject linking in your application
$buttonfound = false;
$file_path = "../Private/JSON/lists.json";

if (file_exists($file_path)) {
  $jsonFile = file_get_contents($file_path);
} else {
  die("<b>Fatal Error:</b> File '$file_path' does not exists");
}

$file = json_decode($jsonFile, true);
$subjects = array_flip($subjects);
$file = $file["classbuttons"][$subjects[$subLink]] ?? null;

$html = '';
if ($file) {
  for ($i = 0; $i < 3; $i++) {
    $int = $i + 1;
    $buttonfound = false;
    if ($file[$i] !== "<button onclick=\"window.location.href=''\"></button>") {
      $html .= $file[$i];
      $buttonfound = true;
    }
    if (!$buttonfound) {
      $html .= "<h4>Button $int not found for $subLink.</h4>";
    }
  }
} else {
  $html .= "<h4>No Buttons found for $subLink.</h4>";
}

echo $html;
?>