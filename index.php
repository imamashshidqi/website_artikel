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

    <!-- Body -->
    <div class="container mt-2">
        <div class="p-4 p-md-5 mb-4 rounded text-body-emphasis bg-body-secondary" style="background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.3)), url('img/banner.webp'); background-size: cover; background-position: center; background-repeat: no-repeat; ">
            <div class="col-lg-6 px-0" style="color: wheat;">
                <h1 class="display-4 fst-italic">Selamat Datang di Layanan Informasi Universitas Pakuan</h1>
                <p class="lead my-3">Multiple lines of text that form the lede, informing new readers quickly and efficiently about what’s most interesting in this post’s contents.</p>
                <p class="lead mb-0"><a href="#" class="text-body-emphasis fw-bold">Continue reading...</a></p>
            </div>
        </div>

        <!-- Card Artikel -->
        <div class="row mb-2">
            <?php
            include 'database/koneksi.php';

            $sql = "SELECT * FROM artikel ORDER BY id DESC LIMIT 4";
            $result = $db->query($sql);

            while ($row = $result->fetch_assoc()) {
                $konten = $row['konten'];
                $judul = $row['judul'];

                $kataKonten = explode(' ', $konten);
                $kataJudul = explode(' ', $judul);
                $kontenTerbatas = implode(' ', array_slice($kataKonten, 0, 10));
                $judulTerbatas = implode(' ', array_slice($kataJudul, 0, 3));
            ?>
                <div class="col-md-6">
                    <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                        <div class="col p-4 d-flex flex-column position-static"> <strong class="d-inline-block mb-2 text-success-emphasis">Berita</strong>
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
                            <img src="img/<?= $row['gambar'] ?>" alt="<?= $row['gambar'] ?>" class="d-block object-fit-cover" width="200" height="250">
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