<?php

// require_once "../config/config.php";

// if(isset($_POST['edit'])) {
//     $id_material = $_POST['Id_material'];
//     $doc= $_POST ['doc'];
//     $dia_cutter= $_POST ['dia_cutter'];
//     $loc= $_POST ['loc'];
//     $n= $_POST ['n'];
//     $fz= $_POST ['fz'];
//     $rpm= $_POST ['rpm'];

//     mysqli_query($con, "INSERT INTO datapemotongan (doc,dia_cutter,loc,n,fz,rpm) VALUES ('$doc', '$dia_cutter','$loc','$n', '$fz', '$rpm')") or die (mysqli_error($con));
//     echo "<script>window.location='data.php';</script>";

// }else if(isset($_POST['edit'])) {
//     $id_material = $_POST['id_material'];
//     $doc= $_POST ['doc'];
//     $dia_cutter= $_POST ['dia_cutter'];
//     $loc= $_POST ['loc'];
//     $n= $_POST ['n'];
//     $fz= $_POST ['fz'];
//     $rpm= $_POST ['rpm'];

//     mysqli_query($con, "UPDATE datapemotongan SET doc = '$doc', dia_cutter = '$dia_cutter', loc = '$loc', n = '$n', rpm = '$rpm', fz = '$fz' WHERE Nawa = '$id'") or die (mysqli_error($con));
//     echo "<script>window.location='data.php';</script>";
// }


require_once "../config/config.php";

if(isset($_POST['edit'])) {
    $id_material = $_POST['id_material'];
    $doc= $_POST ['doc'];
    $dia_cutter= $_POST ['dia_cutter'];
    $loc= $_POST ['loc'];
    $n= $_POST ['n'];
    $fz= $_POST ['fz'];
    $rpm= $_POST ['rpm'];

    echo $id_material." ".$doc." ".$dia_cutter." ".$loc." ".$n." ".$fz." ".$rpm;
    mysqli_query($con, "INSERT INTO `datapemotongan`(`id_material`, `doc`, `dia_cutter`, `loc`, `n`, `fz`, `rpm`) VALUES ('$id_material','$doc', '$dia_cutter','$loc','$n', '$fz', '$rpm')") or die (mysqli_error($con));
    echo "<script>window.location='data.php';</script>";

}
// else if(isset($_POST['edit'])) {
//     $id_material = $_POST['idMaterial'];
//     $doc= $_POST ['doc'];
//     $dia_cutter= $_POST ['dia_cutter'];
//     $loc= $_POST ['loc'];
//     $n= $_POST ['n'];
//     $fz= $_POST ['fz'];
//     $rpm= $_POST ['rpm'];

//     mysqli_query($con, "UPDATE datapemotongan SET doc = '$doc', dia_cutter = '$dia_cutter', loc = '$loc', n = '$n', rpm = '$rpm', fz = '$fz' WHERE Nawa = '$id'") or die (mysqli_error($con));
//     echo "<script>window.location='data.php';</script>";
// }
?>