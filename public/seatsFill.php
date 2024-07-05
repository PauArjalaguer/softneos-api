<?php
$mysqli = new mysqli("localhost", "root", "", "softneos_api");
mysqli_set_charset($mysqli, "utf8mb4");

// Check connection
if ($mysqli->connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli->connect_error;
  exit();
}
for ($x = 1; $x <= 10; $x++) {
    for ($y = 1; $y <= 10; $y++) {
        $sql = "insert into seats values (null,now(),now(),$x,$y)";
    //  $mysqli->query($sql);
    }
}