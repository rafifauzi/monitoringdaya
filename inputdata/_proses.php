<?php

require_once "../config/config.php";

if(isset($_POST['edit'])) {
    $id = $_POST['Nawa'];
    $doc= $_POST ['doc'];
    $dia_cutter= $_POST ['dia_cutter'];
    $loc= $_POST ['loc'];
    $n= $_POST ['n'];
    $fz= $_POST ['fz'];
    $rpm= $_POST ['rpm'];

    mysqli_query($con, "INSERT INTO datapemotongan (doc,dia_cutter,loc,n,fz,rpm) VALUES ('$doc', '$dia_cutter','$loc','$n', '$fz', '$rpm')") or die (mysqli_error($con));
    echo "<script>window.location='data.php';</script>";

}else if(isset($_POST['edit'])) {
    $id = $_POST['Nawa'];
    $doc= $_POST ['doc'];
    $dia_cutter= $_POST ['dia_cutter'];
    $loc= $_POST ['loc'];
    $n= $_POST ['n'];
    $fz= $_POST ['fz'];
    $rpm= $_POST ['rpm'];

    mysqli_query($con, "UPDATE datapemotongan SET doc = '$doc', dia_cutter = '$dia_cutter', loc = '$loc', n = '$n', rpm = '$rpm', fz = '$fz' WHERE Nawa = '$id'") or die (mysqli_error($con));
    echo "<script>window.location='data.php';</script>";
}
?>