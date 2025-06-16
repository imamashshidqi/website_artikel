<?php
include 'database/koneksi.php';
session_start();

$register_message = "";

// Jika sudah login, lempar ke dashboard
if (isset($_SESSION['is_login'])) {
    header("Location: dashboard.php");
    exit(); // Selalu exit setelah header redirect
}

// Proses form jika tombol register ditekan
if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $konfirmasi_password = $_POST['konfirmasi_password'];

    // 1. Pengecekan paling dasar: apakah semua field diisi?
    if (empty($username) || empty($password) || empty($konfirmasi_password)) {
        $register_message = "Semua kolom wajib diisi!";
    }
    // 2. Cek apakah password dan konfirmasi password sama
    elseif ($password !== $konfirmasi_password) {
        $register_message = "Password dan Konfirmasi Password tidak cocok!";
    } else {
        // Jika semua pengecekan lolos, lanjutkan ke proses database

        // 3. Hash password untuk keamanan sebelum disimpan
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // 4. Gunakan Prepared Statements untuk mencegah SQL Injection
        $stmt = $db->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $username, $hashed_password);

        // Coba eksekusi query
        try {
            if ($stmt->execute()) {
                $register_message = "Akun berhasil dibuat! Silakan login.";
                // Anda bisa tambahkan redirect ke halaman login di sini jika mau
                // header("Location: login.php?status=sukses");
                // exit();
            } else {
                $register_message = "Terjadi kesalahan yang tidak diketahui.";
            }
        } catch (mysqli_sql_exception $e) {
            // Tangkap error jika username sudah ada (error code 1062 untuk duplicate entry)
            if ($e->getCode() == 1062) {
                $register_message = "Username '" . htmlspecialchars($username) . "' sudah digunakan, silakan pilih yang lain.";
            } else {
                $register_message = "Terjadi error pada database: " . $e->getMessage();
            }
        }
        $stmt->close();
    }
    $db->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <?php include 'layout/header.php'; ?>
    <div class="container col-xl-10 col-xxl-8 px-4 py-2">
        <div class="row align-items-center g-lg-5 py-5">
            <div class="col-md-10 mx-auto col-lg-5">
                <div>
                    <?php if (!empty($register_message)) : ?>
                        <div class="alert alert-info" role="alert">
                            <?= $register_message; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <form class="p-4 p-md-5 border rounded-3 bg-body-tertiary" action="register.php" method="post">
                    <div class="form-floating mb-3">
                        <input class="form-control" type="text" name="username" placeholder="Username">
                        <label for="floatingInput">Username</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" name="password" placeholder="Password">
                        <label for="floatingPassword">Password</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" name="konfirmasi_password" placeholder="Konfirmasi Password">
                        <label for="floatingPassword">Konfirmasi Password</label>
                    </div>
                    <div class="checkbox mb-3">
                        <label> <input type="checkbox" value="remember-me"> Remember me</label>
                    </div>
                    <button class="w-100 btn btn-lg btn-primary" type="submit" name="register">Sign up</button>
                    <hr class="my-4"> <small class="text-body-secondary">By clicking Sign up, you agree to the terms of use.</small>
                </form>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include 'layout/footer.php'; ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>

</html>