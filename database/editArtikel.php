<?php
include 'koneksi.php';
session_start();

$row = ['id' => '', 'judul' => '', 'konten' => ''];
$error_message = "";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM artikel WHERE id = $id";
    $result = $db->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];
    $judul = $_POST['judul'];
    $konten = $_POST['konten'];

    if (!empty($id) && !empty($judul) && !empty($konten)) {
        $sql = "UPDATE artikel SET judul = '$judul', konten = '$konten' WHERE id = '$id'";

        if ($db->query($sql)) {
            header("Location: ../tambahArtikelDashboard.php");
            exit();
        } else {
            echo "Gagal memperbarui data: " . $db->error;
        }
    } else {
        echo "Error: Data tidak lengkap!";
    }
}

var_dump($_POST); // Untuk melihat isi dari $_POST
exit(); // Hentikan eksekusi sementara