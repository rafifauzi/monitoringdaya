<?php

require_once "../config/config.php";

mysqli_query($con, "DELETE FROM tabel_mesin WHERE ID_mesin = '$_GET[id]'") or die(mysqli_error($con));
echo "<script>window.location='data.php';</script>";

?>