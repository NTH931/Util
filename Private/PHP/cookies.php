<?php
session_start();

require_once 'variables.php';
$expiry = 365 * 5;

function cookie_set(string $name, string|array $value, $time_days = 1): void {
  setcookie($name, is_array($value) ? json_encode($value) : $value, time() + ($time_days * (24 * 60 * 60)), '/');
}

if (!isset($_COOKIE["settings"])) {
  cookie_set("settings", [
    # Value: Common colours
    "Base-Color" => "default",
    # Value: 1=all, 2=important_popup_only, 3=notification_panel_only
    "Notifications" => 1,
    # Value: Boolean
    "Tooltips" => true,
    # Assoc Array
    "Buttons" => [
      "GGL" => null,
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
  ], $expiry);
  header("Location: /Util/Public/index.php");
  exit;
}

if (REQ_METHOD === "POST") {
  if (isset($_POST["tooltips"])) {
    $tooltips = $_POST["tooltips"] === "1" ? true:false;
  }
  if (isset($_POST["default"]) && $_POST["default"] === "1") {
    $buttons = [
      "GGL" => null,
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
    ];
  } else {
    $buttons = [];
    foreach ($_POST["Buttons"] as $key => $value) {
      $buttons[$key] = $value === "1" ? true:false;
    }
  }

  cookie_set("settings", [
    # Value: Common colours
    "Base-Color" => $_POST["Base-Color"],
    # Value: 1=all, 2=important_popup_only, 3=notification_panel_only
    "Notifications" => $_POST["Notifications"],
    # Value: Boolean
    "Tooltips" => $_POST["tooltips"] === "1" ? true:false,
    # Assoc Array
    "Buttons" => $buttons
  ], $expiry);
}

header("Location: /Util/Public/index.php");
exit;