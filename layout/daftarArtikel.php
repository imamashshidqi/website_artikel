<h2>Daftar Artikel</h2>
<form method="GET" action="" id="sortForm">
    <label>Urutkan berdasarkan:</label>
    <select name="sort" id="sort" onchange="document.getElementById('sortForm').submit()">
        <option value="terbaru" <?= !isset($_GET['sort']) || $_GET['sort'] == 'terbaru' ? 'selected' : '' ?>>Terbaru</option>
        <option value="ASC" <?= isset($_GET['sort']) && $_GET['sort'] == 'ASC' ? 'selected' : '' ?>>Judul A-Z</option>
        <option value="DESC" <?= isset($_GET['sort']) && $_GET['sort'] == 'DESC' ? 'selected' : '' ?>>Judul Z-A</option>
    </select>
</form>

<?php
include 'database/koneksi.php';

$jumlah_data_per_halaman = 5;

$query_jumlah = $db->query("SELECT COUNT(*) as total FROM artikel");
$jumlah_seluruh_data = $query_jumlah->fetch_assoc()['total'];

$jumlah_halaman = ceil($jumlah_seluruh_data / $jumlah_data_per_halaman);

$halaman_aktif = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
$halaman_aktif = max(1, min($halaman_aktif, $jumlah_halaman));

$data_awal = ($halaman_aktif - 1) * $jumlah_data_per_halaman;

$sortOption = isset($_GET['sort']) ? $_GET['sort'] : 'terbaru';
$orderByClause = "ORDER BY id DESC";
$sortParam = '&sort=terbaru';

if ($sortOption == 'ASC' || $sortOption == 'DESC') {
    $orderByClause = "ORDER BY judul $sortOption";
    $sortParam = '&sort=' . $sortOption;
}

$sql = "SELECT * FROM artikel $orderByClause LIMIT $data_awal, $jumlah_data_per_halaman";
$result = $db->query($sql);
?>

<table class="table table-striped mt-3">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Judul</th>
            <th scope="col">Konten</th>
            <th scope="col">Gambar</th>
            <th scope="col" colspan="3" class="text-center">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $konten = $row['konten'];
                $judul = $row['judul'];
        ?>
                <tr>
                    <th scope="row"><?= $row['id'] ?></th>
                    <td><?= substr($judul, 0, 50) ?>...</td>
                    <td><?= substr($konten, 0, 100) ?>...</td>
                    <td><img src="img/<?= $row['gambar'] ?>" alt="Gambar <?= $row['gambar'] ?>" style='width:100px;height:auto;'></td>

                    <td>
                        <a href="updateArtikelDashboard.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">
                            <i class="bi bi-pencil-fill"></i>
                        </a>
                    </td>

                    <td>
                        <a href="database/downloadArtikel.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-success">
                            <i class="bi bi-download"></i>
                        </a>
                    </td>

                    <td>
                        <form action="database/hapusArtikel.php" method="post" onsubmit="return confirm('Apakah Anda yakin ingin menghapus artikel ini?');">
                            <input type="hidden" name="id" value="<?= $row['id'] ?>">
                            <button type="submit" class="btn btn-sm btn-danger">
                                <i class="bi bi-trash-fill"></i>
                            </button>
                        </form>
                    </td>
                </tr>
        <?php }
        } else {
            echo "<tr><td colspan='7' class='text-center'>Tidak ada artikel untuk ditampilkan.</td></tr>";
        }
        ?>
    </tbody>
</table>

<nav aria-label="Page navigation">
    <ul class="pagination justify-content-center">
        <li class="page-item <?= ($halaman_aktif <= 1) ? 'disabled' : '' ?>">
            <a class="page-link" href="?page=<?= $halaman_aktif - 1 ?><?= $sortParam ?>">Previous</a>
        </li>

        <?php for ($i = 1; $i <= $jumlah_halaman; $i++) : ?>
            <li class="page-item <?= ($i == $halaman_aktif) ? 'active' : '' ?>">
                <a class="page-link" href="?page=<?= $i ?><?= $sortParam ?>"><?= $i ?></a>
            </li>
        <?php endfor; ?>

        <li class="page-item <?= ($halaman_aktif >= $jumlah_halaman) ? 'disabled' : '' ?>">
            <a class="page-link" href="?page=<?= $halaman_aktif + 1 ?><?= $sortParam ?>">Next</a>
        </li>
    </ul>
</nav>

<?php $db->close(); ?>