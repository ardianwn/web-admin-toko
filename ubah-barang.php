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

$title = 'Ubah Barang';

include 'layout/header.php';

// check apakah tombol ubah ditekan
if (isset($_POST['ubah'])) {
    if (update_barang($_POST) > 0) {
        echo "<script>
                alert('Data Barang Berhasil Diubah');
                document.location.href = 'index.php';
              </script>";
    } else {
        echo "<script>
                alert('Data Barang Gagal Diubah');
                document.location.href = 'index.php';
              </script>";
    }
}

// ambil id barang dari URL
$id_barang = (int)$_GET['id_barang'];

// query ambil data barang
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
                        <i class="fas fa-edit"></i> Ubah Barang
                    </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="barang.php">Data Barang</a></li>
                        <li class="breadcrumb-item active">Ubah Barang</li>
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
                    <form action="" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id_barang" value="<?= $barang['id_barang']; ?>">
                        <input type="hidden" name="fotoLama" value="<?= $barang['foto']; ?>">

                        <div class="form-group">
                            <label for="nama" class="form-label">Nama Barang</label>
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama barang..." required value="<?= $barang['nama']; ?>">
                        </div>

                        <div class="form-group">
                            <label for="jumlah" class="form-label">Jumlah</label>
                            <input type="number" class="form-control" id="jumlah" name="jumlah" placeholder="Jumlah barang..." required value="<?= $barang['jumlah']; ?>">
                        </div>

                        <div class="form-group">
                            <label for="harga" class="form-label">Harga</label>
                            <input type="number" class="form-control" id="harga" name="harga" placeholder="Harga barang..." required value="<?= $barang['harga']; ?>">
                        </div>

                        <div class="form-group">
                            <label for="file"><b>Foto</b></label><br>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="foto" name="foto" onchange="previewImg()">
                                <label class="custom-file-label" for="file">Pilih ulang gambar</label>
                            </div>
                            <div class="mt-1">
                                <img src="assets-template/img/<?= $barang['foto']; ?>" alt="" class="img-thumbnail img-preview" width="100px">
                            </div>
                        </div>
                        
                        <a href="index.php" class="btn btn-secondary btn-sm" style="float: right ;">Kembali</a>
                        <button type="submit" name="ubah" class="btn btn-primary btn-sm" style="float: right; margin-right: 8px;">Ubah</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>

<!-- preview image -->
<script>
    function previewImg() {
        const gambar = document.querySelector('#foto');
        const gambarLabel = document.querySelector('.custom-file-label');
        const imgPreview = document.querySelector('.img-preview');

        gambarLabel.textContent = gambar.files[0].name;

        const fileGambar = new FileReader();
        fileGambar.readAsDataURL(gambar.files[0]);

        fileGambar.onload = function(e) {
            imgPreview.src = e.target.result;
        }
    }
</script>

<?php include 'layout/footer.php'; ?>
