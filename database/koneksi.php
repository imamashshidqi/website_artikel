<?php

$hostname = "localhost";
$username = "root";
$password = "";
$database = "project_tekweb";

$db = mysqli_connect($hostname, $username, $password, $database);

if ($db->connect_error) {
    die("Koneksi gagal: " . $db->connect_error);
}
