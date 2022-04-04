<?php

require_once "../config/config.php";

if(isset($_POST['add'])) {
    $no_mesin= $_POST ['no_mesin'];
    $th_mesin_ready= $_POST ['th_mesin_ready'];
    $th_spindel_on= $_POST ['th_spindel_on'];
    $th_cutting= $_POST ['th_cutting'];
    $status = '1';
    
    //ambil nomor terakhir
    $sqlNumber = mysqli_query($con, "SELECT * FROM tabel_treshold ORDER BY nomor DESC");
    $data=mysqli_fetch_array($sqlNumber);
    $no_mesin_sebelum=$data['nomor']; //64 = 0

    //update data
    mysqli_query($con,"UPDATE tabel_treshold SET `status`='0' WHERE `nomor`='$no_mesin_sebelum'");
    
    //input data
    mysqli_query($con, "INSERT INTO tabel_treshold (`ID_mesin`, `th_mesin_ready`, `th_spindel_on`, `th_cutting`, `status`) VALUES ('$no_mesin', '$th_mesin_ready', '$th_spindel_on', '$th_cutting', '$status')") or die (mysqli_error($con));
    echo "<script>window.location='data.php';</script>";

} else if(isset($_POST['edit'])) {
    $id = $_POST['id'];
    $th_mesin_ready= $_POST ['th_mesin_ready'];
    $th_spindel_on= $_POST ['th_spindel_on'];
    $th_cutting= $_POST ['th_cutting'];

    mysqli_query($con, "UPDATE tabel_treshold SET th_mesin_ready = '$th_mesin_ready', th_spindel_on = '$th_spindel_on', th_cutting = '$th_cutting'  WHERE nomor = '$id'") or die (mysqli_error($con));
    echo "<script>window.location='data.php';</script>";
}
?>