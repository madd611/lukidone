<?php
    //koneksi database

    $conn = mysqli_connect("localhost","root","","udang");

    //baca data dari tabel sensor
    $sql = mysqli_query($conn,"select * from monitoring order by id desc");

    $data = mysqli_fetch_array($sql);

    $oksigen = $data['oksigen'];

    //uji

    if($oksigen == "")$oksigen =0;

    echo $oksigen;

?>