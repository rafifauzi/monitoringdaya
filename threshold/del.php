<?php

require_once "../config/config.php";

mysqli_query($con, "DELETE FROM tabel_treshold WHERE nomor = '$_GET[nomor]'") or die(mysqli_error($con));
echo "<script>window.location='data.php';</script>";

?>