<?php
session_start();

require_once 'variables.php';
$expiry = 365 * 5;

function post_set_switch(string $postdataname) {
  return isset($_POST[$postdataname]) && $_POST[$postdataname] === "1";
}

function post_set_array_of_switch(string $postdataname) {
  $array = [];
  if (isset($_POST[$postdataname])) {
    foreach ($_POST[$postdataname] as $key => $value) {
      $array[$key] = $value === "1";
    }
  }
  return $array;
}

# Handling if settings cookie dosen't exist
if (!isset($_COOKIE["settings"])) {
  cookie_set("settings", $_ENV["defaultValues"], $expiry);
  header("Location: /Util/Public/index.php");
  exit;
} else {
  $currentSettings = json_decode($_COOKIE["settings"], true);

  # Merge with defaults to handle missing keys
  $currentSettings = array_merge($_ENV["defaultValues"], $currentSettings);
}

# Handle POST Data
if (REQ_METHOD === "POST") {
  $buttons = [];
  foreach ($_POST["Buttons"] as $key => $value) {
    $buttons[$key] = $value === "1" ? true:false;
  }

  cookie_set("settings", json_encode([
    # Value: Common colours
    "Base-Color" => $_POST["Base-Color"],
    # Value: 1=all, 2=important_popup_only, 3=notification_panel_only
    "Notifications" => $_POST["Notifications"],
    # Value: Boolean
    "Tooltips" => post_set_switch("Tooltips"),
    # Value: Boolean
    "Dark-Mode" => post_set_switch("Dark-Mode"),
    # Assoc Array
    "Buttons" => post_set_array_of_switch("Buttons")
  ]), $expiry);
}

header("Location: /Util/Public/index.php");
exit;