<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PAKUAN News | Tugas Akhir Teknologi Website</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <?php include 'layout/header.php'; ?>
    <?php
    include 'database/koneksi.php';
    session_start();
    $id = isset($_GET['id']) ? $_GET['id'] : null;
    $sql = "SELECT * FROM artikel where id = '$id'";
    $result = $db->query($sql);
    $data = $result->fetch_assoc();
    ?>

    <!-- Container untuk Artikel -->
    <div class="container mt-4">
        <div class="row">
            <!-- Artikel -->
            <div class="col-md-8">
                <div class="card p-4">
                    <h1 class="fw-bold"><?= $data['judul'] ?></h1>
                    <p class="text-muted">Ditulis oleh <strong>Nama Penulis</strong> - <?= $data['tgl_rilis'] ?></p>
                    <img src="img/<?= $data['gambar'] ?>" class="img-fluid rounded mb-3" alt="Gambar Artikel">
                    <p><?= $data['konten'] ?></p>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-md-4">
                <div class="card p-3 sticky-top " style="top: 70px;">
                    <h4 class="fw-bold">Artikel Lainnya</h4>
                    <ul class="list-group">
                        <?php
                        $sql = "SELECT * FROM artikel WHERE id != '$id' ORDER BY RAND() LIMIT 3";
                        $result = $db->query($sql);
                        while ($row = $result->fetch_assoc()) { ?>
                            <li class="list-group-item"><a href="artikel.php?id=<?= $row['id'] ?>"><?= $row['judul'] ?></a></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <?php $db->close(); ?>

    <!-- Footer -->
    <?php include 'layout/footer.php'; ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>

</html>