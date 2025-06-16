<main class="col overflow-auto h-100">
    <div class="bg-light border rounded-3 p-3 overflow-auto" style="height: 80vh;">
        <h2>Tambah Artikel</h2>
        <form action="database/tambahArtikel.php" method="post" enctype="multipart/form-data">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tr>
                        <td>Masukan Judul Artikel</td>
                        <td>: <input type="text" name="judul" placeholder="Judul Artikel"></td>
                    </tr>
                    <tr>
                        <td>Upload Gambar</td>
                        <td>
                            : <input type="file" name="gambar" required>
                        </td>
                    </tr>
                    <tr>
                        <td>Masukan isi Artikel</td>
                        <td><textarea class="ckeditor" id="ckedtor" name="konten"></textarea></td>
                    </tr>
                    <tr>
                        <td colspan="2"><button class="btn btn-primary" type="submit" name="tambah">Kirim</button></td>
                    </tr>
                </table>
            </div>
        </form>
        <hr>
        <?php include 'daftarArtikel.php'; ?>
    </div>
</main>