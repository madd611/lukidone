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
            background-color: #f8f9fa;
            font-family: 'Poppins', sans-serif;
        }
        .banner {
            background-image: linear-gradient(to right, #0062cc, #003366);
            color: white;
            text-align: center;
            padding: 20px;
            margin-bottom: 20px;
        }
        .banner h1 {
            font-size: 2.5rem;
            font-weight: bold;
        }
        .container {
            margin-top: 20px;
        }
        .chart-container {
            position: relative;
            height: 40vh;
            width: 100%;
        }
        @media (max-width: 768px) {
            .chart-container {
                height: 50vh;
            }
        }
        .navbar {
            margin-bottom: 20px;
            background-color: #007bff;
        }
        .navbar-brand {
            font-size: 1.2rem;
            color: #fff !important;
        }
    </style>
</head>
<body>

<!-- Banner -->
<div class="banner">
    <h1><i class="fas fa-chart-bar"></i> Grafik Pemantauan Kualitas Air Tambak Udang</h1>
</div>

<!-- Navbar -->
<nav class="navbar navbar-expand-sm">
    <a class="navbar-brand" href="index.php"><i class="fas fa-home"></i> Home</a>
    <a class="navbar-brand" href="realtime.php"><i class="fas fa-chart-line"></i> Data Realtime</a>
    <a class="navbar-brand" href="datatabel.php"><i class="fas fa-table"></i> Data Updated</a>
    <a class="navbar-brand" href="grafik.php"><i class="fas fa-chart-pie"></i> Grafik Gabungan</a>
    <a class="navbar-brand" href="grafik2.php"><i class="fas fa-chart-bar"></i> Grafik</a>
</nav>

<!-- Grafik Gabungan -->
<div class="container">
    <div class="chart-container">
        <canvas id="qualityChart"></canvas>
    </div>
</div>

<!-- Form untuk pilih rentang tanggal -->
<div class="container mt-4">
    <h5>Pilih Rentang Tanggal:</h5>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="startDate">Tanggal Mulai:</label>
            <input type="date" id="startDate" class="form-control" required>
        </div>
        <div class="form-group col-md-6">
            <label for="endDate">Tanggal Akhir:</label>
            <input type="date" id="endDate" class="form-control" required>
        </div>
    </div>
    <button id="applyDateRange" class="btn btn-primary mt-2">Terapkan Rentang Tanggal</button>
</div>

<!-- Dropdown untuk Pilih Variabel -->
<div class="container mt-4">
    <h5>Pilih Variabel untuk Ditampilkan:</h5>
    <select id="variableSelector" class="form-control">
        <option value="ph">pH</option>
        <option value="oksigen">Oksigen Terlarut</option>
        <option value="suhu">Suhu</option>
        <option value="salinitas">Salinitas</option>
        <option value="keruh">Kekeruhan</option>
    </select>
</div>

<!-- Grafik Dinamis Berdasarkan Dropdown -->
<div class="container mt-4">
    <div class="chart-container">
        <canvas id="dynamicChart"></canvas>
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
    // Mengambil data dari PHP ke JavaScript
    var phData = <?php echo json_encode($ph); ?>;
    var suhuData = <?php echo json_encode($suhu); ?>;
    var oksigenData = <?php echo json_encode($oksigen); ?>;
    var salinitasData = <?php echo json_encode($salinitas); ?>;
    var keruhData = <?php echo json_encode($keruh); ?>;
    var tanggalData = <?php echo json_encode($tanggal); ?>;

    // Fungsi untuk memfilter data berdasarkan rentang tanggal
    function filterByDateRange(startDate, endDate) {
        let filteredDates = [];
        let filteredPhData = [];
        let filteredSuhuData = [];
        let filteredOksigenData = [];
        let filteredSalinitasData = [];
        let filteredKeruhData = [];

        for (let i = 0; i < tanggalData.length; i++) {
            let currentDate = new Date(tanggalData[i]);
            if (currentDate >= new Date(startDate) && currentDate <= new Date(endDate)) {
                filteredDates.push(tanggalData[i]);
                filteredPhData.push(phData[i]);
                filteredSuhuData.push(suhuData[i]);
                filteredOksigenData.push(oksigenData[i]);
                filteredSalinitasData.push(salinitasData[i]);
                filteredKeruhData.push(keruhData[i]);
            }
        }

        return {
            dates: filteredDates,
            ph: filteredPhData,
            suhu: filteredSuhuData,
            oksigen: filteredOksigenData,
            salinitas: filteredSalinitasData,
            keruh: filteredKeruhData
        };
    }

    // Grafik Gabungan
    var ctx = document.getElementById('qualityChart').getContext('2d');
    var qualityChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: tanggalData.reverse(),
            datasets: [
                {
                    label: 'pH',
                    data: phData.reverse(),
                    borderColor: 'rgba(255, 99, 132, 1)',
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderWidth: 2,
                    fill: false
                },
                {
                    label: 'Oksigen Terlarut',
                    data: oksigenData.reverse(),
                    borderColor: 'rgba(54, 162, 235, 1)',
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderWidth: 2,
                    fill: false
                },
                {
                    label: 'Suhu (°C)',
                    data: suhuData.reverse(),
                    borderColor: 'rgba(255, 206, 86, 1)',
                    backgroundColor: 'rgba(255, 206, 86, 0.2)',
                    borderWidth: 2,
                    fill: false
                },
                {
                    label: 'Salinitas',
                    data: salinitasData.reverse(),
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderWidth: 2,
                    fill: false
                },
                {
                    label: 'Kekeruhan',
                    data: keruhData.reverse(),
                    borderColor: 'rgba(153, 102, 255, 1)',
                    backgroundColor: 'rgba(153, 102, 255, 0.2)',
                    borderWidth: 2,
                    fill: false
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            title: {
                display: true,
                text: 'Grafik Pemantauan Kualitas Air'
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Grafik Dinamis Berdasarkan Pilihan Dropdown
    var dynamicCtx = document.getElementById('dynamicChart').getContext('2d');
    var dynamicChart = new Chart(dynamicCtx, {
        type: 'line',
        data: {
            labels: tanggalData, // Labels tanggal tetap
            datasets: [{
                label: 'pH', // Default value is pH
                data: phData,
                borderColor: 'rgba(255, 99, 132, 1)',
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderWidth: 2,
                fill: false
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            title: {
                display: true,
                text: 'Grafik Dinamis Berdasarkan Variabel'
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Update Grafik Dinamis Berdasarkan Dropdown
    document.getElementById('variableSelector').addEventListener('change', function() {
        var selectedVariable = this.value;

        var datasetMap = {
            'ph': {
                data: phData,
                label: 'pH',
                color: 'rgba(255, 99, 132, 1)',
                bgColor: 'rgba(255, 99, 132, 0.2)'
            },
            'oksigen': {
                data: oksigenData,
                label: 'Oksigen Terlarut',
                color: 'rgba(54, 162, 235, 1)',
                bgColor: 'rgba(54, 162, 235, 0.2)'
            },
            'suhu': {
                data: suhuData,
                label: 'Suhu (°C)',
                color: 'rgba(255, 206, 86, 1)',
                bgColor: 'rgba(255, 206, 86, 0.2)'
            },
            'salinitas': {
                data: salinitasData,
                label: 'Salinitas',
                color: 'rgba(75, 192, 192, 1)',
                bgColor: 'rgba(75, 192, 192, 0.2)'
            },
            'keruh': {
                data: keruhData,
                label: 'Kekeruhan',
                color: 'rgba(153, 102, 255, 1)',
                bgColor: 'rgba(153, 102, 255, 0.2)'
            }
        };

        var selectedDataset = datasetMap[selectedVariable];
        dynamicChart.data.datasets[0].data = selectedDataset.data;
        dynamicChart.data.datasets[0].label = selectedDataset.label;
        dynamicChart.data.datasets[0].borderColor = selectedDataset.color;
        dynamicChart.data.datasets[0].backgroundColor = selectedDataset.bgColor;
        dynamicChart.update();
    });

    // Validasi dan Penerapan Rentang Tanggal
    document.getElementById('applyDateRange').addEventListener('click', function() {
        var startDate = document.getElementById('startDate').value;
        var endDate = document.getElementById('endDate').value;

        if (new Date(startDate) > new Date(endDate)) {
            alert("Tanggal akhir tidak boleh lebih kecil dari tanggal mulai.");
            return;
        }

        // Memfilter data berdasarkan rentang tanggal yang dipilih
        var filteredData = filterByDateRange(startDate, endDate);

        // Update chart gabungan dengan data yang sudah difilter
        qualityChart.data.labels = filteredData.dates.reverse();
        qualityChart.data.datasets[0].data = filteredData.ph.reverse();
        qualityChart.data.datasets[1].data = filteredData.oksigen.reverse();
        qualityChart.data.datasets[2].data = filteredData.suhu.reverse();
        qualityChart.data.datasets[3].data = filteredData.salinitas.reverse();
        qualityChart.data.datasets[4].data = filteredData.keruh.reverse();
        qualityChart.update();

        // Update chart dinamis juga jika perlu
        dynamicChart.data.labels = filteredData.dates.reverse();
        dynamicChart.update();
    });
</script>

</body>
</html>
