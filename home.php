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

$title = 'Dashboard';

include 'layout/header.php';

// Set zona waktu ke WIB (Waktu Indonesia Barat)
date_default_timezone_set('Asia/Jakarta');
// Mendapatkan waktu saat ini
$current_time = date("H");

// Inisialisasi ucapan
$greeting = "";
if ($current_time >= 24 && $current_time < 9) {
    $greeting = "Selamat Pagi";
} elseif ($current_time >= 9 && $current_time < 15) {
    $greeting = "Selamat Siang";
}elseif ($current_time >= 15 && $current_time < 18) {
    $greeting = "Selamat Sore";
} else {
    $greeting = "Selamat Malam";
}

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1 class="m-0">Dashboard</h1><br>
                    <h1 class="m-0 text-md"><?php echo $greeting; ?> Min, Semangat ya kerjanya.</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Home</li>
                    </ol>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <!-- Box 1 -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>9999+</h3>
                            <p>Jumlah Barang</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                    </div>
                </div>
                <!-- /.col -->

                <!-- Box 2 -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>9999+</h3>
                            <p>Jumlah Pelanggan</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person"></i>
                        </div>
                    </div>
                </div>
                <!-- /.col -->

                <!-- Box 3 -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>9999+</h3>
                            <p>Jumlah Transaksi</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                    </div>
                </div>
                <!-- /.col -->

                <!-- Box 4 -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>9</h3>
                            <p>Jumlah Kategori</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-ios-list"></i>
                        </div>
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- Bar chart -->
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Grafik Penjualan Bulanan</h3>
                        </div>
                        <div class="card-body">
                            <div class="chart">
                                <!-- Chart.js chart -->
                                <canvas id="salesChart" style="height: 300px;"></canvas>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->

                <!-- Recent Orders -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Pesanan Terbaru</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <ul class="products-list product-list-in-card pl-2 pr-2">
                                <!-- List of recent orders -->
                                <li class="item">
                                    <div class="product-info">
                                        <a href="#" class="fas fa-tshirt"></a>
                                        <a href="#" class="product-title">T-Shirt</a>
                                        <span class="product-description">
                                            2 x Felicity T-Shirt New Apparel  - Ukuran M
                                        </span>
                                        <span class="product-description">
                                            1 x Felicity T-Shirt est2024 - Ukuran L
                                        </span>
                                        <span class="product-description">
                                            1 x Felicity T-Shirt Vintage - Ukuran S
                                        </span>
                                        <span class="product-description">
                                            Total: Rp 400.000,00
                                        </span>
                                        <span class="product-description text-sm text-muted">Dipesan oleh Maria - 28 Maret 2024</span>
                                    </div>
                                </li>
                                <!-- /.item -->
                                <!-- More recent orders can be added here -->
                            </ul>
                        </div>
                        <!-- /.card-body -->
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <ul class="products-list product-list-in-card pl-2 pr-2">
                                <!-- List of recent orders -->
                                <li class="item">
                                    <div class="product-info mb-3">
                                    <a href="#" class="fas fa-tshirt"></a>
                                        <a href="#" class="product-title">Coach Jacket</a>
                                        <span class="product-description">
                                            1 x Felicity CJ130 Black Sig R Coach Jacket  - Ukuran M
                                        </span>
                                        <span class="product-description">
                                            1 x Felicity CJ192 Navy Good Fellas Coach Jacket - Ukuran L
                                        </span>
                                        <span class="product-description">
                                            1 x Felicity TCJ011 BLACK GET UP STAND UP COACH JACKET - Ukuran S
                                        </span>
                                        <span class="product-description">
                                            1 x Felicity CJ193 Black Nova Corps Coach Jacket - Ukuran XL
                                        </span>
                                        <span class="product-description">
                                            Total: Rp 680.000,00
                                        </span>
                                        <span class="product-description text-sm text-muted">Dipesan oleh Mariadi - 28 Maret 2024</span>
                                    </div>
                                </li>
                                <!-- /.item -->
                                <!-- More recent orders can be added here -->
                            </ul>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include 'layout/footer.php'; ?>

<!-- ChartJS -->
<!-- ChartJS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    $(function() {
        /* ChartJS
         * -------
         * Here we will create a few charts using ChartJS
         */

        // Sales chart
        var salesChartCanvas = $('#salesChart').get(0).getContext('2d')

        var salesChartData = {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [{
                    label: 'Digital Goods',
                    backgroundColor: 'rgb(60,141,188)',
                    borderColor: 'rgb(60,141,188)',
                    pointRadius: false,
                    pointColor: '#3b8bba',
                    pointStrokeColor: 'rgba(60,141,188,1)',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(60,141,188,1)',
                    data: [1000, 2000, 3000, 2500, 2700, 2500, 3000, 3500, 3100, 4000, 4200, 4500]
                },
                {
                    label: 'Electronics',
                    backgroundColor: 'rgb(210, 214, 222)',
                    borderColor: 'rgb(210, 214, 222)',
                    pointRadius: false,
                    pointColor: 'rgb(210, 214, 222)',
                    pointStrokeColor: '#c1c7d1',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgb(220,220,220)',
                    data: [500, 1000, 700, 900, 1500, 1200, 1700, 1800, 1500, 2000, 1900, 2300]
                },
            ]
        }

        var salesChartOptions = {
            maintainAspectRatio: false,
            responsive: true,
            legend: {
                display: false
            },
            scales: {
                xAxes: [{
                    gridLines: {
                        display: false,
                    }
                }],
                yAxes: [{
                    gridLines: {
                        display: false,
                    }
                }]
            }
        }

        // This will get the first returned node in the jQuery collection.
        var salesChart = new Chart(salesChartCanvas, {
            type: 'line',
            data: salesChartData,
            options: salesChartOptions
        })
    })
</script>
