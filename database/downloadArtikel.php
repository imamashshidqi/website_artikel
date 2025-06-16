<?php
// Pastikan file ini hanya bisa diakses jika ada ID
if (isset($_GET['id'])) {
    // Sertakan file koneksi database Anda
    include 'koneksi.php';

    // Ambil ID artikel dan pastikan itu adalah angka
    $id = intval($_GET['id']);

    // Gunakan prepared statement untuk keamanan dari SQL Injection
    $stmt = $db->prepare("SELECT judul, konten FROM artikel WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $artikel = $result->fetch_assoc();
        $judul = $artikel['judul'];
        $konten = $artikel['konten'];

        // Buat nama file yang valid dari judul artikel
        $nama_file = strtolower(str_replace(' ', '_', $judul)) . '.txt';

        // Gabungkan judul dan konten untuk isi file
        $isi_file = "Judul: " . $judul . "\n\n";
        $isi_file .= "---------------------------------\n\n";
        $isi_file .= $konten;

        // Atur header untuk memberitahu browser agar mengunduh file
        header('Content-Type: text/plain');
        header('Content-Disposition: attachment; filename="' . $nama_file . '"');

        // Keluarkan isi file
        echo $isi_file;

        $stmt->close();
        $db->close();
        exit();
    } else {
        echo "Artikel tidak ditemukan.";
    }
} else {
    echo "ID Artikel tidak valid.";
}
