<?php
    //koneksi database

    $conn = mysqli_connect("localhost","root","","udang");

    //baca data dari tabel sensor
    $sql = mysqli_query($conn,"select * from monitoring order by id desc");

    $data = mysqli_fetch_array($sql);

    $salinitas = $data['salinitas'];

    //uji

    if($salinitas == "")$salinitas =0;

    echo $salinitas;

?>