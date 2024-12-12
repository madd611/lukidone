<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <title>Realtime Monitoring</title>

    <script type="text/javascript" src="jquery/jquery.min.js"></script>
    <!-- load otomatis -->
    <script type="text/javascript">
        $(document).ready(function(){
            setInterval(function(){
                $('#cekph').load("cekph.php");
                $('#cekdo').load("cekdo.php");
                $('#cekec').load("cekec.php");
                $('#ceksuhu').load("ceksuhu.php");
                $('#cekkeruh').load("cekkeruh.php");

                // Update kualitas pH
                $.get("cekph.php", function(data) {
                    var phValue = parseFloat(data);
                    var kualitas;

                    if (phValue < 7) {
                        kualitas = "Kadar pH kurang";
                    } else if (phValue >= 7 && phValue <= 8) {
                        kualitas = "Kadar pH Normal";
                    } else {
                        kualitas = "Kadar pH berlebih";
                    }

                    $('#kualitasPh').text(kualitas);
                });

                // Update kualitas Oksigen
                $.get("cekdo.php", function(data) {
                    var oksigenValue = parseFloat(data);
                    var kualitasOksigen;

                    if (oksigenValue < 4) {
                        kualitasOksigen = "Kadar Oksigen kurang";
                    } else if (oksigenValue >= 4 && oksigenValue <= 8) {
                        kualitasOksigen = "Kadar Oksigen Normal";
                    } else {
                        kualitasOksigen = "Kadar Oksigen Berlebih";
                    }

                    $('#kualitasOksigen').text(kualitasOksigen);
                });
            }, 1000);
        });
    </script>

    <style>
        body {
            background-color: #f0f8ff;
            font-family: 'Arial', sans-serif;
        }
        .navbar {
            margin-bottom: 1rem;
            background-color: #007bff;
        }
        .navbar-brand {
            font-size: 1.2rem;
            color: #fff !important;
        }
        .banner {
            background-image: linear-gradient(to right, #0062cc, #003366);
            color: white;
            padding: 30px 0;
            margin-bottom: 1.5rem;
            text-align: center;
        }
        .banner h1 {
            font-size: 3rem;
            font-weight: bold;
            margin: 0;
        }
        .banner h2 {
            font-size: 1.5rem;
            margin-top: 0.5rem;
        }
        .row {
            margin-top: 2rem;
        }
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            font-size: 1.5rem;
            font-weight: bold;
            color: white;
            text-align: center;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }
        .card-body {
            padding: 2rem;
            background-color: #f9f9f9;
        }
        .card-header.pH {
            background-color: #e74c3c; /* Red */
        }
        .card-header.oksigen {
            background-color: #f39c12; /* Orange */
        }
        .card-header.ec {
            background-color: #3498db; /* Blue */
        }
        .card-header.suhu {
            background-color: #2ecc71; /* Green */
        }
        .card-header.level {
            background-color: #9b59b6; /* Purple */
        }
        .card-header.kualitas {
            background-color: #8e44ad; /* Dark Purple */
        }
        .card:hover {
            transform: translateY(-10px); /* Lift the card slightly on hover */
            transition: transform 0.3s, box-shadow 0.3s;
            box-shadow: 0px 8px 12px rgba(0, 0, 0, 0.2);
        }
        .status-text {
            font-size: 1.5rem;
            font-weight: bold;
            color: #34495e;
            text-align: center;
            margin-top: 10px;
        }
        .unit {
            font-size: 1rem;
            color: #7f8c8d;
            margin-top: 5px;
        }
        @media (max-width: 576px) {
            .banner h1 {
                font-size: 2rem;
            }
            .banner h2 {
                font-size: 1.2rem;
            }
            .card-body {
                padding: 1rem;
            }
        }
    </style>
</head>
<body>

<!-- Banner -->
<div class="banner">
    <h1><i class="fas fa-water"></i> ARYA LUKITO ALKAFF</h1>
    <h2>Realtime Monitoring Kualitas Air Tambak Udang Berbasis IoT</h2>
</div>

<!-- Navbar -->
<nav class="navbar navbar-expand-sm">
    <a class="navbar-brand" href="index.php"><i class="fas fa-home"></i> Home</a>
    <a class="navbar-brand" href="realtime.php"><i class="fas fa-chart-line"></i> Data Realtime</a>
    <a class="navbar-brand" href="datatabel.php"><i class="fas fa-database"></i> Data Updated</a>
    <a class="navbar-brand" href="grafik.php"><i class="fas fa-chart-pie"></i> Grafik Gabungan</a>
    <a class="navbar-brand" href="grafik2.php"><i class="fas fa-chart-bar"></i> Grafik</a>
</nav>

<div class="container text-center">
    <div class="row">
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card">
                <div class="card-header pH">
                    <i class="fas fa-vial"></i> pH
                </div>
                <div class="card-body">
                    <h1><span id="cekph">0</span></h1>
                    <p class="unit">pH</p>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card">
                <div class="card-header oksigen">
                    <i class="fas fa-thermometer-half"></i> Suhu
                </div>
                <div class="card-body">
                    <h1><span id="ceksuhu">0</span></h1>
                    <p class="unit">°C</p>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card">
                <div class="card-header ec">
                    <i class="fas fa-water"></i> Oksigen
                </div>
                <div class="card-body">
                    <h1><span id="cekdo">0</span></h1>
                    <p class="unit">mg/dL</p>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card">
                <div class="card-header suhu">
                    <i class="fas fa-tint"></i> Salinitas
                </div>
                <div class="card-body">
                    <h1><span id="cekec">0</span></h1>
                    <p class="unit">ppm</p>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card">
                <div class="card-header level">
                    <i class="fas fa-cloud"></i> Kekeruhan
                </div>
                <div class="card-body">
                    <h1><span id="cekkeruh">0</span></h1>
                    <p class="unit">NTU</p>
                </div>
            </div>
        </div>

        <div class="col-lg-12 mb-4">
            <div class="card">
                <div class="card-header kualitas">
                    <i class="fas fa-info-circle"></i> Kualitas Air
                </div>
                <div class="card-body">
                    <h2 class="highlight">Kualitas pH</h2>
                    <p id="kualitasPh" class="status-text">Menunggu data...</p>
                    <hr>
                    <h2 class="highlight">Kualitas Oksigen</h2>
                    <p id="kualitasOksigen" class="status-text">Menunggu data...</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Optional JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
</body>
</html>