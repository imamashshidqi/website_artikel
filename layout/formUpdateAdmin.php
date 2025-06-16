<?php
// Ambil ID dari URL dan pastikan berupa integer
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
?>
<main class="col overflow-auto h-100">
    <div class="bg-light border rounded-3 p-3 overflow-auto" style="height: 80vh;">
        <h2>Update Admin</h2>

        <!-- Menampilkan pesan error jika ada -->
        <?php if (!empty($error_message)): ?>
            <div class="alert alert-danger">
                <?= htmlspecialchars($error_message) ?>
            </div>
        <?php endif; ?>

        <div class="form-signin w-25 m-auto p-4">
            <form action="database/editAdmin.php" method="POST">
                <h1 class="h3 mb-3 fw-normal">Update Admin</h1>
                <input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>">
                <div class="form-floating mb-4">
                    <input type="text" name="username" id="username" class="form-control" placeholder="placeholder"
                        required value="<?= htmlspecialchars($row['username'] ?? '') ?>">
                    <label for="username">Username</label>
                </div>

                <div class="form-floating mb-4">
                    <input type="password" class="form-control" id="password" name="password" placeholder="placeholder"
                        required value="<?= htmlspecialchars($row['password'] ?? '') ?>">
                    <label for="password">Password</label>
                </div>

                <button class="btn btn-primary w-100 py-3" type="submit" name="edit">Edit</button>
                <a href="tambahAdminDashboard.php" class="text-end w-100 d-block mt-2">Kembali</a>
            </form>
        </div>
    </div>
</main>