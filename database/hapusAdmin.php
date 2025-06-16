<?php
include 'koneksi.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = $_POST['id'];

    $sql = "DELETE FROM users WHERE id=?";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $_SESSION['hapusAdmin_message'] = "Akun berhasil dihapus!";
    } else {
        $_SESSION['hapusAdmin_message'] = "Gagal hapus akun Admin!";
    }

    $stmt->close();
    $db->close();

    header("Location: ../dashboard.php");
    exit();
}
