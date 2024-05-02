<?php

function mysqli($host, $user, $password, $database, $num) {
  $connection[$num] = mysqli_connect($host, $user, $password, $database);
  if (!$connection) {
    echo "Error: Unable to connect to MySQL.";
    echo "Debugging errno: ". mysqli_connect_errno(). PHP_EOL;
    echo "Debugging error: ". mysqli_connect_error(). PHP_EOL;
    exit;
  }
  $num ++;
  return $connection[$num];
}

?>