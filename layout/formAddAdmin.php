<main class="col overflow-auto h-100">
    <div class="bg-light border rounded-3 p-3 overflow-auto" style="height: 80vh;">
        <h2>Tambah Admin</h2>
        <form action="database/tambahAdmin.php" method="post">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tr>
                        <td><label for="username">Username</label></td>
                        <td><input type="text" id="username" name="username" class="form-control" placeholder="Username"></td>
                    </tr>
                    <tr>
                        <td><label for="password">Password</label></td>
                        <td><input type="password" id="password" name="password" class="form-control" placeholder="Password"></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <button type="submit" name="tambah" class="btn btn-primary">Tambah Admin</button>
                        </td>
                    </tr>
                </table>
            </div>
        </form>
        <hr>
        <?php include 'daftarAdmin.php'; ?>
    </div>
</main>