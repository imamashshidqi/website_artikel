<?php
// Ambil ID dari URL dan pastikan berupa integer
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
?>
<main class="col overflow-auto h-100">
    <div class="bg-light border rounded-3 p-3 overflow-auto" style="height: 80vh;">

        <!-- Menampilkan pesan error jika ada -->
        <?php if (!empty($error_message)): ?>
            <div class="alert alert-danger">
                <?= htmlspecialchars($error_message) ?>
            </div>
        <?php endif; ?>

        <div class="form-signin m-auto p-4">
            <form action="database/editArtikel.php" method="POST" enctype="multipart/form-data">
                <h1 class="h3 mb-3 fw-normal">Update Artikel</h1>
                <input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>">
                <div class="form-floating mb-4">
                    <input type="text" name="judul" id="judul" class="form-control" placeholder="Judul Artikel"
                        required value="<?= htmlspecialchars($row['judul'] ?? '') ?>">
                    <label for="judul">Judul</label>
                </div>
                <div class="">
                    <input type="file" name="gambar" id="gambar" class="form-control"
                        required value="<?= htmlspecialchars($row['gambar'] ?? '') ?>" required>
                    <label for="gambar"></label>
                </div>
                <div class="mb-4">
                    <textarea class="ckeditor" type="konten" id="ckedtor" name="konten" placeholder="placeholder"
                        required value="<?= htmlspecialchars($row['konten'] ?? '') ?>"></textarea>
                </div>
                <button class="btn btn-primary w-100 py-3" type="submit" name="edit">Edit</button>
                <a href="tambahArtikelDashboard.php" class="text-end w-100 d-block mt-2">Kembali</a>
            </form>
        </div>
    </div>
</main>