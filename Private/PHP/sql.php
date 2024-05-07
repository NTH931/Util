<?php
define("host", "localhost");
define("rootusr", "root");
define("password", "passwd");

function mysqli_C($host, $user, $password, $database) {
  $connection = mysqli_connect($host, $user, $password, $database);
  if (!$connection) {
    echo "Error: Unable to connect to MySQL.". PHP_EOL;
    echo "Debugging errno: ". mysqli_connect_errno(). PHP_EOL;
    echo "Debugging error: ". mysqli_connect_error(). PHP_EOL;
    exit;
  }
  return $connection;
}
$connect = array();

$connect['UserNames'] = mysqli_C(host, rootusr, password, "UserNames");
$connect['Preferences'] = mysqli_C(host, rootusr, password, "preferences");