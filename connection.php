<?php

$host = "localhost";
$user = "root";
$pass = "";
$db = "phpcrud";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    // No need to show any message on connection failure
    die("Connection failed: " . mysqli_connect_error());
}

?>
