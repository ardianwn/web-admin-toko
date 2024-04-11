<?php

session_start();

// membatasi halaman sebelum login
if (!isset($_SESSION["login"])) {
    echo "<script>
            alert('login dulu dong');
            document.location.href = 'login.php';
          </script>";
    exit;
}

$title = 'Tambah Pelanggan';

include 'layout/header.php';

// check apakah tombol tambah ditekan
if (isset($_POST['tambah'])) {
    if (create_pelanggan($_POST) > 0) {
        echo "<script>
                alert('Data Pelanggan Berhasil Ditambahkan');
                document.location.href = 'dashboard.php';
              </script>";
    } else {
        echo "<script>
                alert('Data Pelanggan Gagal Ditambahkan');
                document.location.href = 'dashboard.php';
              </script>";
    }
}

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><i class="fas fa-plus"></i> Tambah Pelanggan</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="dashboard.php">Data Pelanggan</a></li>
                        <li class="breadcrumb-item active">Tambah Pelanggan</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <form action="" method="post">
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Pelanggan</label>
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama pelanggan..." required>
                </div>

                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat pelanggan..." required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email pelanggan..." required>
                </div>

                <div class="mb-3">
                    <label for="telepon" class="form-label">Telepon</label>
                    <input type="text" class="form-control" id="telepon" name="telepon" placeholder="Telepon pelanggan..." required>
                </div>

                <div class="mb-3">
                    <label for="tanggal_bergabung" class="form-label">Tanggal Bergabung</label>
                    <input type="date" class="form-control" id="tanggal_bergabung" name="tanggal_bergabung" required>
                </div>

                <button type="submit" name="tambah" class="btn btn-primary" style="float: right;">Tambah</button>
            </form>
        </div>
    </section>
    <!-- /.content -->
</div>
