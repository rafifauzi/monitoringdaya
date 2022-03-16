<?php

require_once "../config/config.php";

if(isset($_POST['add'])) {
    $no_mesin= $_POST ['no_mesin'];
    $th_mesin_ready= $_POST ['th_mesin_ready'];
    $th_spindel_on= $_POST ['th_spindel_on'];
    $th_cutting= $_POST ['th_cutting'];

    mysqli_query($con, "INSERT INTO tabel_treshold (ID_mesin, th_mesin_ready, th_spindel_on, th_cutting) VALUES ('$no_mesin', '$th_mesin_ready', '$th_spindel_on', '$th_cutting')") or die (mysqli_error);
    echo "<script>window.location='data.php';</script>";

} else if(isset($_POST['edit'])) {
    $id = $_POST['id'];
    $th_mesin_ready= $_POST ['th_mesin_ready'];
    $th_spindel_on= $_POST ['th_spindel_on'];
    $th_cutting= $_POST ['th_cutting'];

    mysqli_query($con, "UPDATE tabel_treshold SET th_mesin_ready = '$th_mesin_ready', th_spindel_on = '$th_spindel_on', th_cutting = '$th_cutting' WHERE nomor = '$id'") or die (mysqli_error($con));
    echo "<script>window.location='data.php';</script>";
}
?>