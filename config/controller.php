<?php

// fungsi menampilkan
function select($query)
{
    // panggil koneksi database
    global $db;

    $result = mysqli_query($db, $query);
    $rows = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}


// fungsi menambah data pelanggan
function create_pelanggan($post)
{
    global $db;

    $nama       = strip_tags($post['nama']);
    $alamat     = strip_tags($post['alamat']);
    $email      = strip_tags($post['email']);
    $telepon    = strip_tags($post['telepon']);


    // query tambah data
    $query = "INSERT INTO pelanggan VALUES(null, '$nama', '$alamat', '$email', '$telepon', CURRENT_TIMESTAMP())";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}


// fungsi menghapus data pelanggan
function delete_pelanggan($id_pelanggan)
{
    global $db;

    // query hapus data pelanggan
    $query = "DELETE FROM pelanggan WHERE id_pelanggan = $id_pelanggan";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

// fungsi ubah pelanggan
function update_pelanggan($post)
{
    global $db;

    $id_pelanggan         = strip_tags($post['id_pelanggan']);
    $nama                 = strip_tags($post['nama']);
    $alamat               = strip_tags($post['alamat']);
    $email                = strip_tags($post['email']);
    $telepon              = strip_tags($post['telepon']);


    // query ubah data
    $query = "UPDATE pelanggan 
              SET nama = '$nama', alamat = '$alamat', email = '$email', telepon = '$telepon' WHERE id_pelanggan = $id_pelanggan";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}



// Fungsi menambah data barang
function create_barang($post)
{
    global $db;

    $nama       = strip_tags($post['nama']);
    $jumlah     = strip_tags($post['jumlah']);
    $harga      = strip_tags($post['harga']);
    $barcode    = rand(100000, 999999);
    $foto       = upload_file();

    // check upload foto
    if (!$foto) {
        return false;
    }

    // Query tambah data
    $query = "INSERT INTO barang VALUES(null, '$nama', '$jumlah', '$harga', '$barcode', CURRENT_TIMESTAMP(), '$foto')";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}



// Fungsi mengubah data barang
function update_barang($post)
{
    global $db;

    $id_barang  = strip_tags($post['id_barang']);
    $nama       = strip_tags($post['nama']);
    $jumlah     = strip_tags($post['jumlah']);
    $harga      = strip_tags($post['harga']);
    $fotoLama   = strip_tags($post['fotoLama']);

    // check upload foto baru atau tidak
    if ($_FILES['foto']['error'] == 4) {
        $foto = $fotoLama;
    } else {
        $foto = upload_file();
    }

    // Query ubah data
    $query = "UPDATE barang
              SET nama = '$nama', jumlah = '$jumlah', harga = '$harga', foto = '$foto' WHERE id_barang = $id_barang";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

// Fungsi menghapus data barang
function delete_barang($id_barang)
{
    global $db;

    // ambil foto sesuai data yang dipilih
    $foto = select("SELECT * FROM barang WHERE id_barang = $id_barang")[0];
    unlink("assets-template/img/". $foto['foto']);

    // Query hapus data barang
    $query = "DELETE FROM barang WHERE id_barang = $id_barang";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

// Fungsi mengupload file
function upload_file()
{
    $namaFile   = $_FILES['foto']['name'];
    $ukuranFile = $_FILES['foto']['size'];
    $error      = $_FILES['foto']['error'];
    $tmpName    = $_FILES['foto']['tmp_name'];

    // check file yang diupload
    $extensifileValid = ['jpg', 'jpeg', 'png'];
    $extensifile      = explode('.', $namaFile);
    $extensifile      = strtolower(end($extensifile));

    // check format/extensi file
    if (!in_array($extensifile, $extensifileValid)) {
        // pesan gagal
        echo "<script>
                alert('Format File Tidak Valid');
                document.location.href = 'tambah-barang.php';
              </script>";
        die();
    }

     // check ukuran file 2 MB
     if ($ukuranFile > 2048000) {
        // pesan gagal
        echo "<script>
                alert('Ukuran File Max 2 MB');
                document.location.href = 'tambah-mahasiswa.php';
              </script>";
        die();
    }

    // generate nama file baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $extensifile;

    // pindahkan ke folder local
    move_uploaded_file($tmpName, 'assets-template/img/' . $namaFileBaru);
    return $namaFileBaru;
}

// fungsi tambah akun
function create_akun($post)
{
    global $db;

    $nama       = strip_tags($post['nama']);
    $username   = strip_tags($post['username']);
    $email      = strip_tags($post['email']);
    $password   = strip_tags($post['password']);
    $level      = strip_tags($post['level']);

    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // query tambah data
    $query = "INSERT INTO akun VALUES(null, '$nama', '$username', '$email', '$password', '$level')";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

// fungsi ubah akun
function update_akun($post)
{
    global $db;

    $id_akun    = strip_tags($post['id_akun']);
    $nama       = strip_tags($post['nama']);
    $username   = strip_tags($post['username']);
    $email      = strip_tags($post['email']);
    $password   = strip_tags($post['password']);
    $level      = strip_tags($post['level']);

    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // query ubah data
    $query = "UPDATE akun SET nama = '$nama', username = '$username', email = '$email', password = '$password', level = '$level' WHERE id_akun = $id_akun";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

// fungsi menghapus data akun
function delete_akun($id_akun)
{
    global $db;

    // query hapus data akun
    $query = "DELETE FROM akun WHERE id_akun = $id_akun";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}
