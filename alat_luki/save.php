<?php
// ini untuk save
include("config.php");

// cek apakah tombol daftar sudah diklik atau blum?
if(isset($_GET['suhu']) && isset($_GET['oksi']) && isset($_GET['tds']) && isset($_GET['keruh']) && isset($_GET['ph'])){

    // ambil data dari formulir

    $suhu = $_GET['suhu'];
    $oksigen = $_GET['oksi'];
    $elektrik = $_GET['tds'];
    $keruh = $_GET['keruh'];
    $ph = $_GET['ph'];
    // echo $nama;

    // buat query
    $sql = "INSERT INTO monitoring (ph, suhu, oksigen,salinitas,keruh) VALUES ($ph, $suhu, $oksigen, $elektrik, $keruh)";
    $query = mysqli_query($db, $sql);

}

?>