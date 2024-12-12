<?php include("config.php"); ?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <title>Data Updated</title>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Load otomatis -->
    <script type="text/javascript">
        $(document).ready(function(){
            setInterval(function(){
                $('#sensorTableBody').load('load_sensor_data.php');
            }, 1000);
        });
    </script>
    <style>
        /* Custom styles for banner */
        body {
            background-color: #f9f9f9;
            font-family: 'Poppins', sans-serif;
        }

        .banner {
            background-image: linear-gradient(to right, #0062cc, #003366);
            background-size: cover;
            background-position: center;
            width: 100%;
            height: 150px;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            margin-bottom: 20px;
        }
        
        .banner h1 {
            font-size: 2.5rem;
            font-weight: bold;
        }

        .table-responsive {
            background: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        thead {
            background-color: #007bff;
            color: white;
        }

        th, td {
            text-align: center;
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        tbody tr:hover {
            background-color: #f1f1f1;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #f9f9f9;
        }

        .table-striped tbody tr:nth-of-type(even) {
            background-color: #ffffff;
        }

        .table-hover tbody tr:hover {
            background-color: #d1ecf1;
            transition: background-color 0.3s;
        }

        .navbar {
            margin-bottom: 20px;
        }

        .navbar-brand {
            font-size: 1.2rem;
        }
    </style>
</head>
<body>

<!-- Banner -->
<div class="banner">
    <h1><i class="fas fa-database"></i> Data Updated</h1>
</div>

<!-- Navbar: Data Real Time & Data Updated -->
<nav class="navbar navbar-expand-sm navbar-dark bg-dark">
    <a class="navbar-brand" href="index.php"><i class="fas fa-home"></i> Home</a>
    <a class="navbar-brand" href="realtime.php"><i class="fas fa-chart-line"></i> Data Realtime</a>
    <a class="navbar-brand" href="datatabel.php"><i class="fas fa-table"></i> Data Updated</a>
    <a class="navbar-brand" href="grafik.php"><i class="fas fa-chart-pie"></i> Grafik Gabungan</a>
    <a class="navbar-brand" href="grafik2.php"><i class="fas fa-chart-bar"></i> Grafik</a>
</nav>

<div class="container mt-4">
    <div class="table-responsive">
        <!-- Tabel dengan zebra striping dan hover effect -->
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">NOMOR</th>
                    <th scope="col">pH</th>
                    <th scope="col">SUHU</th>
                    <th scope="col">OKSIGEN</th>
                    <th scope="col">SALINITAS</th>
                    <th scope="col">KEKERUHAN</th>
                    <th scope="col">TANGGAL</th>
                </tr>
            </thead>
            <tbody id="sensorTableBody">
                <!-- Data tabel akan dimuat di sini oleh load_sensor_data.php -->
                <?php
                $sql = "SELECT * FROM monitoring ORDER BY tanggal DESC";
                $query = mysqli_query($db, $sql);
                $no = 1;
                while($value = mysqli_fetch_assoc($query)){
                    // Kondisi untuk memberikan kelas warna berdasarkan nilai pH
                    $phClass = '';
                    if($value['ph'] > 7) {
                        $phClass = 'table-success'; // Warna hijau untuk pH di atas 7
                    } elseif($value['ph'] < 7) {
                        $phClass = 'table-danger'; // Warna merah untuk pH di bawah 7
                    } else {
                        $phClass = 'table-warning'; // Warna kuning untuk pH netral (7)
                    }

                    echo "<tr class='{$phClass}'>";
                    echo "<td>".htmlspecialchars($no)."</td>";           
                    echo "<td>".htmlspecialchars($value['ph'])."</td>";            
                    echo "<td>".htmlspecialchars($value['suhu'])."</td>";            
                    echo "<td>".htmlspecialchars($value['oksigen'])."</td>";
                    echo "<td>".htmlspecialchars($value['salinitas'])."</td>";
                    echo "<td>".htmlspecialchars($value['keruh'])."</td>";
                    echo "<td>".htmlspecialchars($value['tanggal'])."</td>";                       
                    echo "</tr>";
                    $no++;
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Optional JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
