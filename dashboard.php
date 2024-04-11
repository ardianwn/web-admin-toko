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

// membatasi halaman sesuai user login
if ($_SESSION["level"] != 1 and $_SESSION["level"] != 2) {
    echo "<script>
            alert('Perhatian anda tidak punya hak akses');
            document.location.href = 'akun.php';
          </script>";
    exit;
}

$title = 'Data Pelanggan';

include 'layout/header.php';

$data_pelanggan = select("SELECT * FROM pelanggan ORDER BY id_pelanggan DESC");

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Pelanggan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Data Pelanggan</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Main content -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Tabel Data Pelanggan</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <a href="tambah-pelanggan.php" class="btn btn-primary btn-sm mb-2"><i class="fas fa-plus"></i> Tambah Pelanggan</a>

                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>Email</th>
                                <th>No. Telepon</th>
                                <th>Tanggal Bergabung</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach ($data_pelanggan as $pelanggan) : ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $pelanggan['nama']; ?></td>
                                    <td><?= $pelanggan['alamat']; ?></td>
                                    <td><?= $pelanggan['email']; ?></td>
                                    <td><?= $pelanggan['telepon']; ?></td>
                                    <td><?= date('d/m/Y | H:i:s', strtotime($pelanggan['tanggal_bergabung'])); ?></td>
                                    <td width="20%" class="text-center">
                                        <a href="ubah-pelanggan.php?id_pelanggan=<?= $pelanggan['id_pelanggan']; ?>" class="btn btn-success btn-sm"><i class="fas fa-edit"></i> Ubah</a>
                                        <a href="hapus-pelanggan.php?id_pelanggan=<?= $pelanggan['id_pelanggan']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin Data Pelanggan Akan Dihapus.?');"><i class="fas fa-trash-alt"></i> Hapus</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include 'layout/footer.php'; ?>
