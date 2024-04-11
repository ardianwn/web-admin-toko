<?php

session_start();

// Memastikan pengguna telah login sebelum mengakses halaman
if (!isset($_SESSION["login"])) {
    echo "<script>
            alert('Silahkan login terlebih dahulu');
            document.location.href = 'login.php';
          </script>";
    exit;
}

// Memastikan hak akses sesuai dengan level pengguna
if ($_SESSION["level"] != 1 and $_SESSION["level"] != 3) {
    echo "<script>
            alert('Anda tidak memiliki hak akses');
            document.location.href = 'crud-modal.php';
          </script>";
    exit;
}

require 'config/app.php';
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setCellValue('A2', 'No');
$sheet->setCellValue('B2', 'Nama');
$sheet->setCellValue('C2', 'Jumlah');
$sheet->setCellValue('D2', 'Harga');
$sheet->setCellValue('E2', 'Barcode');
$sheet->setCellValue('F2', 'Tanggal Ditambahkan');
$sheet->setCellValue('G2', 'Foto');

$data_barang = select("SELECT * FROM barang");

$no = 1;
$start = 3;

foreach ($data_barang as $barang) {
    $sheet->setCellValue('A' . $start, $no++)->getColumnDimension('A')->setAutoSize(true);
    $sheet->setCellValue('B' . $start, $barang['nama'])->getColumnDimension('B')->setAutoSize(true);
    $sheet->setCellValue('C' . $start, $barang['jumlah'])->getColumnDimension('C')->setAutoSize(true);
    $sheet->setCellValue('D' . $start, $barang['harga'])->getColumnDimension('D')->setAutoSize(true);
    $sheet->setCellValue('E' . $start, $barang['barcode'])->getColumnDimension('E')->setAutoSize(true);
    $sheet->setCellValue('F' . $start, $barang['tanggal'])->getColumnDimension('F')->setAutoSize(true);
    $sheet->setCellValue('G' . $start, 'http://localhost/crud-php/assets/img/' . $barang['foto'])->getColumnDimension('G')->setAutoSize(true);

    $start++;
}

// Mengatur border untuk tabel
$styleArray = [
    'borders' => [
        'allBorders' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
        ],
    ],
];

$border = $start - 1;

$sheet->getStyle('A2:G' . $border)->applyFromArray($styleArray);

$writer = new Xlsx($spreadsheet);
$filename = 'Laporan Data Barang.xlsx'; // Nama file Excel yang akan diunduh
$writer->save('Laporan Data Barang.xlsx');

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheet.sheet');
header('Content-Disposition: attachment;filename="Laporan Data Barang.xlsx"');
readfile('Laporan Data Barang.xlsx');
header('Cache-Control: max-age=0');
$writer->save('php://output');
unlink($filename); // Menghapus file setelah diunduh

exit;