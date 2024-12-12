<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        /* Background dan overlay */
        body {
            background-image: url('images/latarbelakang1.jpg'); /* Path gambar */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            margin: 0;
            height: 100%;
            position: relative;
            font-family: 'Poppins', sans-serif;
        }

        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.6); /* Lapisan hitam transparan */
            z-index: 1; /* Overlay berada di atas background */
        }

        /* Konten utama */
        .content {
            position: relative;
            z-index: 2; /* Pastikan konten utama berada di atas overlay */
            color: white; /* Warna teks putih untuk kontras */
        }

        /* Header */
        .banner {
            background-color: rgba(0, 0, 0, 0.7);
            width: 100%;
            height: 80px;
            display: flex;
            justify-content: center;
            align-items: center;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1020;
        }

        .banner h1 {
            color: white;
            text-align: center;
            font-size: 1.5rem;
            padding: 0;
            margin: 0;
            text-transform: uppercase;
        }

        /* Navbar */
        .navbar {
            top: 80px;
            background-color: rgba(0, 0, 0, 0.8);
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.3);
        }

        .navbar-brand {
            color: #fff !important;
            font-size: 1.1rem;
            font-weight: bold;
            text-transform: uppercase;
            transition: color 0.3s;
        }

        .navbar-brand i {
            margin-right: 8px;
        }

        .navbar-brand:hover {
            color: #00aaff !important;
        }

        /* Footer */
        footer {
            background-color: rgba(0, 0, 0, 0.8);
            padding: 10px 0;
            text-align: center;
            font-size: 1rem;
            color: white;
            margin-top: 40px;
        }

        footer h4 {
            margin: 0;
        }

        /* Konten tengah */
        .centered {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            margin-top: 150px;
        }

        .centered img {
            margin-bottom: 20px;
            max-width: 200px;
            height: auto;
            border-radius: 50%;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
        }

        .centered h2 {
            font-size: 2rem;
            margin-bottom: 20px;
        }

        .centered p {
            text-align: justify;
            max-width: 600px;
            line-height: 1.6;
            color: #f1f1f1;
        }

        .bold-text {
            font-weight: bold;
            color: #00aaff;
        }

        @media (max-width: 768px) {
            .centered h2 {
                font-size: 1.5rem;
            }
            .centered img {
                max-width: 150px;
            }
            .centered p {
                padding: 0 10px;
            }
        }
    </style>
</head>
<body>
    <!-- Overlay -->
    <div class="overlay"></div>

    <!-- Konten utama -->
    <div class="content">
        <!-- Header -->
        <div class="banner">
            <h1>SISTEM MONITORING KUALITAS AIR TAMBAK UDANG</h1>
        </div>

        <!-- Navbar -->
        <nav class="navbar navbar-expand-sm navbar-dark fixed-top">
            <div class="container">
                <a class="navbar-brand" href="index.php"><i class="fas fa-home"></i> Home</a>
                <a class="navbar-brand" href="realtime.php"><i class="fas fa-chart-line"></i> Data Realtime</a>
                <a class="navbar-brand" href="datatabel.php"><i class="fas fa-database"></i> Data Updated</a>
                <a class="navbar-brand" href="grafik.php"><i class="fas fa-chart-pie"></i> Grafik Gabungan</a>
                <a class="navbar-brand" href="grafik2.php"><i class="fas fa-chart-bar"></i> Grafik</a>
            </div>
        </nav>

        <!-- Konten -->
        <div class="container centered">
            <h2 class="text-center">Tentang Saya</h2>
            <img src="images/Luki.jpg" alt="ARYA LUKITO ALKAFF" class="img-fluid">
            <p><strong>Tanggal Lahir:</strong> 24 April 1999</p>
            <p><strong>Hobi:</strong> Basket</p>
            <p class="bold-text">
                "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam convallis lacus quis nisi bibendum, eu faucibus libero luctus."
            </p>
        </div>

        <!-- Footer -->
        <footer>
            <h4>&copy; Arya Lukito Alkaff | 2024</h4>
        </footer>
    </div>

    <!-- Optional JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
