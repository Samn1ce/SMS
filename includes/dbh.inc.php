<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$dsn = "localhost";
$dbusername = "root";
$dbpassword = "";
$database = "schoolmanagementsystem";

$conn = mysqli_connect($dsn, $dbusername, $dbpassword, $database);

// if($conn) {
//     echo "Shaaarrrrppppp";
// } else {
//     echo "God Abeg";
// };