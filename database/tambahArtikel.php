<?php
include 'koneksi.php';
session_start();

$addArtikel_massage = "";

if (isset($_POST['tambah'])) {
    $judul = $_POST['judul'];
    $konten = $_POST['konten'];

    $namaFile = $_FILES['gambar']['name'];
    $namaSementara = $_FILES['gambar']['tmp_name'];

    $dirUpload = "../img/";
    $terupload = move_uploaded_file($namaSementara, $dirUpload . $namaFile);

    $sql = "INSERT INTO artikel (judul, konten, gambar) VALUES ('$judul', '$konten', '$namaFile')";
    if ($db->query($sql)) {
        $addArtikel_massage = "Berhasil tambah Artikel!";
    } else {
        $addArtikel_massage = "Gagal tambah Artikel coyy!";
    }
    $db->close();
    header("Location: ../tambahArtikelDashboard.php");
    exit();
}
