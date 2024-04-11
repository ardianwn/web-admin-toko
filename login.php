<?php

session_start();

include 'config/app.php';

// check apakah tmbol login ditekan
if (isset($_POST['login'])) {
    // ambil input username dan password
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    // check username
    $result = mysqli_query($db, "SELECT * FROM akun WHERE username = '$username'");

    // jika ada usernya
    if (mysqli_num_rows($result) == 1) {
        // check passwordnya
        $hasil = mysqli_fetch_assoc($result);

        if (password_verify($password, $hasil['password'])) {
            // set session
            $_SESSION['login']      = true;
            $_SESSION['id_akun']    = $hasil['id_akun'];
            $_SESSION['nama']       = $hasil['nama'];
            $_SESSION['username']   = $hasil['username'];
            $_SESSION['email']      = $hasil['email'];
            $_SESSION['level']      = $hasil['level'];

            // jika login benar arahkan ke file home.php
            header("Location: home.php");
            exit;
        }
    }
    // jika tidak ada usernya/login salah
    $error = true;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="assets-template/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="assets-template/dist/css/adminlte.min.css">
    <!-- Custom styles -->
    <style>
        body {
            background-color: #f0f0f0;
        }

        .login-box {
            margin: 50px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .login-logo a {
            font-size: 32px;
            font-weight: bold;
            color: #333;
        }

        .login-box-msg {
            font-size: 18px;
            margin-bottom: 20px;
        }

        .login-box .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            transition: background-color 0.3s;
        }

        .login-box .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
    </style>
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo text-center">
            <img src="assets-template/dist/img/Logo.png" alt="Logo" width="57" height="57" >
            <a href="#"><b>Admin</b></a>
        </div>

        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Masukkan username dan password</p>

                <?php if (isset($error)) : ?>
                    <div class="alert alert-danger text-center">
                        <b>Username/Password SALAH</b>
                    </div>
                <?php endif; ?>

                <form action="" method="post">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="username" placeholder="username" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <input type="password" class="form-control" name="password" placeholder="password" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-4">
                            <button type="submit" name="login" class="btn btn-primary btn-block btn-sm">Masuk</button>
                        </div>
                    </div>
                </form>

                <hr>
                <p class="mb-1 text-center">
                    <span class="mt-5 mb-3 text-muted">&copy;Developer Felicity Store <?= date('Y') ?></span>
                </p>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="assets-template/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="assets-template/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="assets-template/dist/js/adminlte.min.js"></script>
</body>

</html>
