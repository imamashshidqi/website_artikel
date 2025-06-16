<?php
include 'koneksi.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = $_POST['id'];

    $sql = "DELETE FROM artikel WHERE id=?";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $_SESSION['hapusArtikel_message'] = "Artikel berhasil dihapus!";
    } else {
        $_SESSION['hapusArtikel_message'] = "Gagal hapus Artikel!";
    }

    $stmt->close();
    $db->close();

    header("Location: ../dashboard.php");
    exit();
}
