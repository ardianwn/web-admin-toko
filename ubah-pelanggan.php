<?php

session_start();

// membatasi halaman sebelum login
if (!isset($_SESSION["login"])) {
    echo "<script>
            alert('Silahkan Login untuk masuk ke dashboard ');
            document.location.href = 'login.php';
          </script>";
    exit;
}

$title = 'Ubah Pelanggan';

include 'layout/header.php';

// mengambil id_pelanggan dari url
$id_pelanggan = (int)$_GET['id_pelanggan'];

$pelanggan = select("SELECT * FROM pelanggan WHERE id_pelanggan = $id_pelanggan")[0];

// check apakah tombol ubah ditekan
if (isset($_POST['ubah'])) {
    if (update_pelanggan($_POST) > 0) {
        echo "<script>
                alert('Data Pelanggan Berhasil Diubah');
                document.location.href = 'dashboard.php';
              </script>";
    } else {
        echo "<script>
                alert('Data Pelanggan Gagal Diubah');
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
                    <h1 class="m-0"><i class="fas fa-edit"></i> Ubah Pelanggan</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Data Pelanggan</a></li>
                        <li class="breadcrumb-item active">Ubah Pelanggan</li>
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

                <input type="hidden" name="id_pelanggan" value="<?= $pelanggan['id_pelanggan']; ?>">

                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Pelanggan</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="<?= $pelanggan['nama']; ?>" placeholder="Nama pelanggan..." required>
                </div>

                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $pelanggan['alamat']; ?>" placeholder="Alamat pelanggan..." required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?= $pelanggan['email']; ?>" placeholder="Email pelanggan..." required>
                </div>

                <div class="mb-3">
                    <label for="telepon" class="form-label">Telepon</label>
                    <input type="text" class="form-control" id="telepon" name="telepon" value="<?= $pelanggan['telepon']; ?>" placeholder="Telepon pelanggan..." required>
                </div>

                <div class="mb-3">
                    <label for="tanggal_bergabung" class="form-label">Tanggal Bergabung</label>
                    <input type="date" class="form-control" id="tanggal_bergabung" name="tanggal_bergabung" value="<?= $pelanggan['tanggal_bergabung']; ?>" required>
                </div>
                <a href="dashboard.php" class="btn btn-secondary btn-sm" style="float: right ;">Kembali</a>
                <button type="submit" name="ubah" class="btn btn-primary btn-sm" style="float: right; margin-right: 8px">Ubah</button>
            </form>
        </div>
    </section>
    <!-- /.content -->
</div>
