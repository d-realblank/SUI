<?php

$serverName = "localhost";
$dBUseremail = "root";
$dBPassword = "";
$dBName = "sui";

$conn = mysqli_connect($serverName, $dBUseremail, $dBPassword, $dBName);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

?>