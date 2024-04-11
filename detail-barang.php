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

$title = 'Detail Barang';

include 'layout/header.php';

// mengambil id barang dari url
$id_barang = (int)$_GET['id_barang'];

// menampilkan data barang
$barang = select("SELECT * FROM barang WHERE id_barang = $id_barang")[0];

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">
                        <ia class="fas fa-box"></ia> Detail Barang : <?= $barang['nama']; ?>
                    </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Data Barang</a></li>
                        <li class="breadcrumb-item active">Detail Barang</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 mb-5">
                    <table class="table table-bordered table-striped mt-3">
                        <tr>
                            <td>Nama</td>
                            <td>: <?= $barang['nama']; ?></td>
                        </tr>

                        <tr>
                            <td>Jumlah</td>
                            <td>: <?= $barang['jumlah']; ?></td>
                        </tr>

                        <tr>
                            <td>Harga</td>
                            <td>: Rp. <?= number_format($barang['harga'], 0, ',', '.'); ?></td>
                        </tr>

                        <tr>
                            <td>Barcode</td>
                            <td>
                                <img src="barcode.php?codetype=Code128&size=15&text=<?= $barang['barcode']; ?>&print=true" alt="barcode">
                            </td>
                        </tr>

                        <tr>
                            <td>Tanggal</td>
                            <td>: <?= date('d/m/Y | H:i:s', strtotime($barang['tanggal'])); ?></td>
                        </tr>

                        <tr>
                            <td>Product</td>
                            <td class="text-center">
                                <img src="assets-template/img/<?= $barang['foto']; ?>" alt="foto product" width="20%">
                            </td>
                        </tr>
                    </table>

                    <a href="index.php" class="btn btn-secondary btn-sm" style="float: right ;">Kembali</a>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>

<?php include 'layout/footer.php'; ?>
