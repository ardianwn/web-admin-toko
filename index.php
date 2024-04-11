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

$title = 'Data Barang';

include 'layout/header.php';

$data_barang = select("SELECT * FROM barang ORDER BY id_barang DESC");

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Barang</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Data Barang</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Info boxes -->
            <div class="row">
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-shopping-cart"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Total Orders</span>
                            <span class="info-box-number">
                                150
                                <small></small>
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-dollar-sign"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Total Revenue</span>
                            <span class="info-box-number">$50,000</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->

                <!-- fix for small devices only -->
                <div class="clearfix hidden-md-up"></div>

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-user-plus"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">New Customers</span>
                            <span class="info-box-number">44</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-users"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Total Customers</span>
                            <span class="info-box-number">65</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- Main content -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Tabel Data Barang</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <a href="tambah-barang.php" class="btn btn-primary btn-sm mb-2"><i class="fas fa-plus"></i> Tambah</a>
                    <a href="download-excel-barang.php" class="btn btn-success btn-sm mb-2"><i class="fas fa-file-excel"></i> Download Data</a>
                    <a href="download-pdf-barang.php" class="btn btn-danger btn-sm mb-2"><i class="fas fa-file-pdf"></i> Download Data</a>

                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Jumlah</th>
                                <th>Harga</th>
                                <th>Barcode</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach ($data_barang as $barang) : ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $barang['nama']; ?></td>
                                    <td><?= $barang['jumlah']; ?></td>
                                    <td>Rp. <?= number_format($barang['harga'], 0, ',', '.'); ?></td>
                                    <td class="text-center">
                                        <img alt="barcode" src="barcode.php?codetype=Code128&size=15&text=<?= $barang['barcode']; ?>&print=true" />
                                    </td>
                                    <td><?= date('d/m/Y | H:i:s', strtotime($barang['tanggal'])); ?></td>
                                    <td width="20%" class="text-center">
                                        <a href="detail-barang.php?id_barang=<?= $barang['id_barang']; ?>" class="btn btn-secondary btn-sm"><i class="fas fa-eye"></i> Detail</a>
                                        <a href="ubah-barang.php?id_barang=<?= $barang['id_barang']; ?>" class="btn btn-success btn-sm"><i class="fas fa-edit"></i> Ubah</a>
                                        <a href="hapus-barang.php?id_barang=<?= $barang['id_barang']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin data barang akan dihapus?');"><i class="fas fa-trash-alt"></i> Hapus</a>
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
<div style="margin-top: 140px;"> <!-- Atur margin sesuai kebutuhan -->
    <?php include 'layout/footer.php'; ?>
</div>
