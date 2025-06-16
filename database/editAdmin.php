<?php
include 'koneksi.php';
session_start();

$row = ['id' => '', 'username' => '', 'password' => '']; // Nilai default agar tidak error
$error_message = ""; // Tambahkan variabel untuk menampilkan pesan error

if (isset($_GET['id'])) { // Menggunakan GET karena ID dikirim via URL
    $id = $_GET['id'];

    // Query untuk mendapatkan data berdasarkan ID
    $sql = "SELECT * FROM users WHERE id = $id";
    $result = $db->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    }
}

// Jika form dikirimkan, update data di database
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Update data pengguna
    if (!empty($id) && !empty($username) && !empty($password)) {
        $sql = "UPDATE users SET username = '$username', password = '$password' WHERE id = '$id'";

        if ($db->query($sql)) {
            header("Location: ../tambahAdminDashboard.php");
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