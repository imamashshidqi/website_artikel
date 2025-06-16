<?php
include 'database/koneksi.php';
session_start();
$login_masage = "";

if (isset($_SESSION['is_login'])) {
    header("Location: dashboard.php");
}

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password' AND password='$confirm_password'";
    $result = $db->query($sql);
    while ($row = $result->fetch_assoc()) {
        $_SESSION['username'] = $row['username'];
        $_SESSION['is_login'] = true;

        header("Location: dashboard.php");
    }

    $login_masage = "Username atau password salah!";
    $db->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <?php include 'layout/header.php'; ?>
    <div class="container col-xl-10 col-xxl-8 px-4 py-5">
        <div class="row align-items-center g-lg-5 py-5">
            <div class="col-md-10 mx-auto col-lg-5">
                <div>
                    <?php if ($login_masage != ""): ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $login_masage; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <form class="p-4 p-md-5 border rounded-3 bg-body-tertiary" action="login.php" method="post">
                    <div class="form-floating mb-3">
                        <input class="form-control" type="text" name="username" id="floatingInput" placeholder="Username">
                        <label for="floatingInput">Username</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" name="password" id="floatingPassword" placeholder="Password">
                        <label for="floatingPassword">Password</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" name="confirm_password" id="floatingConfirmPassword" placeholder="Konfirmasi Password">
                        <label for="floatingConfirmPassword">Konfirmasi Password</label>
                    </div>
                    <div class="checkbox mb-3">
                        <label>
                            <input type="checkbox" value="remember-me"> Remember me
                        </label>
                    </div>
                    <button class="w-100 btn btn-lg btn-primary" type="submit" name="login">Sign in</button>
                    <hr class="my-4">
                    <small class="text-body-secondary">By clicking Sign in, you agree to the terms of use.</small>
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