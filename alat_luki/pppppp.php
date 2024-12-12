<?php include("config.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grafik Pemantauan Kualitas Air Tambak Udang</title>
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        body {
            background-color: #f0f8ff;
            font-family: 'Poppins', sans-serif;
        }
        .navbar {
            background-color: #0062cc;
            margin-bottom: 20px;
        }
        .navbar-brand {
            color: #fff !important;
            font-size: 1.2rem;
        }
        .navbar-brand i {
            margin-right: 8px;
        }
        .container {
            margin-top: 50px;
        }
        .chart-container {
            position: relative;
            height: 40vh; /* Use vh for responsiveness */
            width: 100%; /* Full width of the card */
        }
        canvas {
            height: 100% !important; /* Make canvas fit its container */
            width: 100% !important; /* Make canvas fit its container */
        }
        .card {
            margin-bottom: 30px; /* Add margin between cards */
            border-radius: 10px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }
        .card-title {
            font-weight: bold;
            color: #0062cc;
        }
        .card:hover {
            transform: scale(1.02);
            transition: transform 0.3s;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-sm navbar-dark">
    <a class="navbar-brand" href="index.php"><i class="fas fa-home"></i> Home</a>
    <a class="navbar-brand" href="realtime.php"><i class="fas fa-chart-line"></i> Data Realtime</a>
    <a class="navbar-brand" href="datatabel.php"><i class="fas fa-database"></i> Data Updated</a>
    <a class="navbar-brand" href="grafik.php"><i class="fas fa-chart-pie"></i> Grafik Gabungan</a>
    <a class="navbar-brand" href="grafik2.php"><i class="fas fa-chart-bar"></i> Grafik</a>
</nav>

<!-- Judul -->
<div class="container text-center">
    <h2>Grafik Pemantauan Kualitas Air Tambak Udang</h2>
</div>

<!-- Grafik -->
<div class="container">
    <div class="row">
        <!-- Card untuk Grafik pH -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-vial"></i> Grafik pH</h5>
                    <div class="chart-container">
                        <canvas id="phChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card untuk Grafik Oksigen -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-water"></i> Grafik Oksigen Terlarut</h5>
                    <div class="chart-container">
                        <canvas id="oksigenChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Card untuk Grafik Suhu -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-thermometer-half"></i> Grafik Suhu (°C)</h5>
                    <div class="chart-container">
                        <canvas id="suhuChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card untuk Grafik Salinitas -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-tint"></i> Grafik Salinitas Air</h5>
                    <div class="chart-container">
                        <canvas id="salinitasChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Card untuk Grafik Kekeruhan -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-cloud"></i> Grafik Kekeruhan Air</h5>
                    <div class="chart-container">
                        <canvas id="keruhChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Ambil data dari database menggunakan PHP dan kirim ke JavaScript -->
<?php
    $sql = "SELECT ph, suhu, oksigen, salinitas, keruh, tanggal FROM monitoring ORDER BY tanggal DESC LIMIT 20";
    $query = mysqli_query($db, $sql);

    $ph = [];
    $suhu = [];
    $oksigen = [];
    $salinitas = [];
    $keruh = [];
    $tanggal = [];

    while ($row = mysqli_fetch_assoc($query)) {
        $ph[] = $row['ph'];
        $suhu[] = $row['suhu'];
        $oksigen[] = $row['oksigen'];
        $salinitas[] = $row['salinitas'];
        $keruh[] = $row['keruh'];
        $tanggal[] = $row['tanggal'];
    }
?>

<script>
    var phData = <?php echo json_encode($ph); ?>;
    var suhuData = <?php echo json_encode($suhu); ?>;
    var oksigenData = <?php echo json_encode($oksigen); ?>;
    var salinitasData = <?php echo json_encode($salinitas); ?>;
    var keruhData = <?php echo json_encode($keruh); ?>;
    var tanggalData = <?php echo json_encode($tanggal); ?>;

    // Konfigurasi Grafik pH
    var ctxPh = document.getElementById('phChart').getContext('2d');
    var phChart = new Chart(ctxPh, {
        type: 'line',
        data: {
            labels: tanggalData.reverse(),
            datasets: [{
                label: 'pH',
                data: phData.reverse(),
                borderColor: 'rgba(255, 99, 132, 1)',
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderWidth: 2,
                fill: true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false, // Menjaga aspek rasio
            title: {
                display: true,
                text: 'Grafik pH Air'
            }
        }
    });

    // Konfigurasi Grafik Oksigen
    var ctxOksigen = document.getElementById('oksigenChart').getContext('2d');
    var oksigenChart = new Chart(ctxOksigen, {
        type: 'line',
        data: {
            labels: tanggalData.reverse(),
            datasets: [{
                label: 'Oksigen Terlarut',
                data: oksigenData.reverse(),
                borderColor: 'rgba(54, 162, 235, 1)',
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderWidth: 2,
                fill: true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            title: {
                display: true,
                text: 'Grafik Oksigen Terlarut'
            }
        }
    });

    // Konfigurasi Grafik Suhu
    var ctxSuhu = document.getElementById('suhuChart').getContext('2d');
    var suhuChart = new Chart(ctxSuhu, {
        type: 'line',
        data: {
            labels: tanggalData.reverse(),
            datasets: [{
                label: 'Suhu (°C)',
                data: suhuData.reverse(),
                borderColor: 'rgba(255, 206, 86, 1)',
                backgroundColor: 'rgba(255, 206, 86, 0.2)',
                borderWidth: 2,
                fill: true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            title: {
                display: true,
                text: 'Grafik Suhu Air'
            }
        }
    });

    // Konfigurasi Grafik Salinitas
    var ctxSalinitas = document.getElementById('salinitasChart').getContext('2d');
    var salinitasChart = new Chart(ctxSalinitas, {
        type: 'line',
        data: {
            labels: tanggalData.reverse(),
            datasets: [{
                label: 'Salinitas Air',
                data: salinitasData.reverse(),
                borderColor: 'rgba(75, 192, 192, 1)',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderWidth: 2,
                fill: true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            title: {
                display: true,
                text: 'Grafik Salinitas Air'
            }
        }
    });

    // Konfigurasi Grafik Kekeruhan
    var ctxKeruh = document.getElementById('keruhChart').getContext('2d');
    var keruhChart = new Chart(ctxKeruh, {
        type: 'line',
        data: {
            labels: tanggalData.reverse(),
            datasets: [{
                label: 'Kekeruhan Air',
                data: keruhData.reverse(),
                borderColor: 'rgba(153, 102, 255, 1)',
                backgroundColor: 'rgba(153, 102, 255, 0.2)',
                borderWidth: 2,
                fill: true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            title: {
                display: true,
                text: 'Grafik Kekeruhan Air'
            }
        }
    });

    // Tambahkan grafik untuk suhu, salinitas, dan kekeruhan...
    
</script>

</body>
</html>
