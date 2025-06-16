<?php
include 'database/koneksi.php'; // Pastikan koneksi ke database sudah ada

if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $sql = "SELECT * FROM artikel WHERE judul LIKE ?";

    // Gunakan prepared statement untuk keamanan dari SQL Injection
    $stmt = $db->prepare($sql);
    $searchTerm = "%" . $search . "%";
    $stmt->bind_param("s", $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $result = $db->query("SELECT * FROM artikel"); // Jika tidak ada pencarian, tampilkan semua data
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Hasil Pencarian</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>

    <!-- Header -->
    <?php include 'layout/header.php'; ?>

    <div class="container mt-3">
        <!-- Card Artikel -->
        <div class="row">
            <?php
            include 'database/koneksi.php';


            while ($row = $result->fetch_assoc()) {
                $konten = $row['konten'];
                $judul = $row['judul'];

                $kataKonten = explode(' ', $konten);
                $kataJudul = explode(' ', $judul);
                $kontenTerbatas = implode(' ', array_slice($kataKonten, 0, 50));
                $judulTerbatas = implode(' ', array_slice($kataJudul, 0, 3));
            ?>
                <div class="col-md">
                    <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                        <div class="col p-4 d-flex flex-column position-static"> <strong class="d-inline-block mb-2 text-success-emphasis">Design</strong>
                            <h3 class="mb-0"><?= $judulTerbatas; ?></h3>
                            <div class="mb-1 text-body-secondary"><?= $row['tgl_rilis'] ?></div>
                            <p class=""><?= $kontenTerbatas; ?></p>
                            <a href="artikel.php?id=<?= $row['id'] ?>" class="icon-link gap-1 icon-link-hover stretched-link">
                                Continue reading
                                <svg class="bi" aria-hidden="true">
                                    <use xlink:href="#chevron-right"></use>
                                </svg> </a>
                        </div>
                        <div class="col-auto d-none d-lg-block">
                            <img src="img/<?= $row['gambar'] ?>" alt="<?= $row['gambar'] ?>" class="d-block object-fit-cover" width="400" height="500">
                        </div>
                    </div>
                </div>
            <?php
            }
            $db->close();
            ?>
        </div>
    </div>

    <!-- Footer -->
    <?php include 'layout/footer.php'; ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>

</html>