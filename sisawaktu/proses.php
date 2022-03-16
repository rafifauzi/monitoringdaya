<?php

require_once "../config/config.php";

if(isset($_POST['edit'])) {
    $sisawaktu_PM = $_POST['sisawaktu_PM'];
    mysqli_query($con, "UPDATE tabel_mesin SET sisawaktu_PM = '$sisawaktu_PM' WHERE status = '1'") or die (mysqli_error($con));
    echo "<script>window.location='data.php';</script>";
}
?>