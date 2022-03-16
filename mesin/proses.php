<?php

require_once "../config/config.php";

if(isset($_POST['add'])) {
    $no_mesin= $_POST ['no_mesin'];
    $nama_mesin= $_POST ['nama_mesin'];
    $lokasi_mesin= $_POST ['lokasi_mesin'];
    mysqli_query($con, "INSERT INTO tabel_mesin (no_mesin, nama_mesin, lokasi_mesin) VALUES ('$no_mesin', '$nama_mesin', '$lokasi_mesin')") or die (mysqli_error($con));
    echo "<script>window.location='data.php';</script>";
} else if(isset($_POST['edit'])) {
    $id = $_POST['id'];
    $no_mesin= $_POST ['no_mesin'];
    $nama_mesin= $_POST ['nama_mesin'];
    $lokasi_mesin= $_POST ['lokasi_mesin'];
    mysqli_query($con, "UPDATE tabel_mesin SET no_mesin = '$no_mesin', nama_mesin = '$nama_mesin', lokasi_mesin = '$lokasi_mesin' WHERE ID_mesin = '$id'") or die (mysqli_error($con));
    echo "<script>window.location='data.php';</script>";
}
?>