<?php
include 'koneksi.php';
session_start();

$addAdmin_masage = "";

if (isset($_POST['tambah'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    try {
        $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
        if ($db->query($sql)) {
            $addAdmin_masage = "Akun berhasil dibuat!";
        } else {
            echo "Gagal tambah akun Admin coyy!";
        }
    } catch (mysqli_sql_exception) {
        $addAdmin_masage = "Username Admin udah ada bro!";
    }
    $db->close();
    header("Location: ../dashboard.php");
    exit();
}
