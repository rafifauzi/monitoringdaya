<head>
    <meta http-equiv="refresh" content="5">
</head>

<?php include_once('../header.php');

$mesin = '1';
if (isset($_GET['mesin'])) {
    $mesin = $_GET['mesin'];
} else {
    $sql = "SELECT * FROM tabel_mesin WHERE `status` = '1'";
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $mesin = $row['ID_mesin'];
    }
}
$sql_treshold = mysqli_query($con, "SELECT * FROM tabel_treshold WHERE `status` = '1' && `ID_mesin` = '" . $mesin . "';") or die(mysqli_error($con));
$treshold = mysqli_fetch_array($sql_treshold);
?>

<div class="vontai">
    <h1>Input Data Pemotongan</h1>
    <br>
    <br>
    <div class="pull-right">
        <a href="edit.php" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-edit"></i>Edit Data Pemotongan</a>
    </div>
    <br>
    <br>
    <div class="container">

        <?php
        $waktuTerakhir = "";
        $sql = "SELECT MAX(Date_Time) FROM tabel_monitoring WHERE `ID_mesin`='" . $mesin . "'";
        $result = $con->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $waktuTerakhir = $row['MAX(Date_Time)'];
        }
        $dataTerakhir = [0, 0, 0];
        $sql = "SELECT * FROM tabel_monitoring WHERE `ID_mesin`='" . $mesin . "' AND `Date_Time` = '" . $waktuTerakhir . "'";
        $result = $con->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $dataTerakhir = array($row['Current'], $row['Voltage'], $row['Power'], 2);
        }
    
        ?>
        <?php
    
        $sql_potong = mysqli_query($con, "SELECT * FROM `datapemotongan` JOIN datamaterial WHERE datapemotongan.id_material=datamaterial.ID AND Nawa IN (SELECT MAX(Nawa) FROM `datapemotongan`);") or die(mysqli_error($con));
        $data = mysqli_fetch_array($sql_potong);
    
        $mrr = $data['dia_cutter'] * $data['doc'] * $data['fz'] * $data['rpm'] * $data['n'];
        ?>
        <table class="text-center table table-striped table-bordered table-hover" align="center">
            <tr>
                <th class="text-center">Power Realtime</th>
            </tr>
            <tr>
                <td><?= $dataTerakhir[2] ?></td>
                <?php
                $dayarealtime = $dataTerakhir[2]; ?>
            </tr>
        </table>
        <br>
        <table class="text-center table table-striped table-bordered table-hover" align="center">
            <tr>
                <th class="text-center">Spesifik Energi Material</th>
            </tr>
            <tr>
                <td><?= $data['Spesifik_Energi'] ?></td>
            </tr>
        </table>
        <br>
        <table class="text-center table table-striped table-bordered table-hover" align="center">
            <tr>
                <th class="text-center">Depth of Cut</th>
            </tr>
            <tr>
                <td><?= $data['doc'] ?></td>
            </tr>
        </table>
        <br>
        <table class="text-center table table-striped table-bordered table-hover" align="center">
            <tr>
                <th class="text-center">Length of Cut</th>
            </tr>
            <tr>
                <td><?= $data['loc'] ?></td>
            </tr>
        </table>
        <br>
        <table class="text-center table table-striped table-bordered table-hover" align="center">
            <tr>
                <th class="text-center">Diameter Cutter</th>
            </tr>
            <tr>
                <td><?= $data['dia_cutter'] ?></td>
            </tr>
        </table>
        <br>
        <table class="text-center table table-striped table-bordered table-hover" align="center">
            <tr>
                <th class="text-center">Jumlah Mata Potong</th>
            </tr>
            <tr>
                <td><?= $data['n'] ?></td>
            </tr>
        </table>
        <br>
        <table class="text-center table table-striped table-bordered table-hover" align="center">
            <tr>
                <th class="text-center">Revolution per Minute</th>
            </tr>
            <tr>
                <td><?= $data['rpm'] ?></td>
            </tr>
        </table>
        <br>
        <table class="text-center table table-striped table-bordered table-hover" align="center">
            <tr>
                <th class="text-center">Feed per Teeth</th>
            </tr>
            <tr>
                <td><?= $data['fz'] ?></td>
            </tr>
        </table>
        <br>
        <br>
        <table class="text-center table table-striped table-bordered table-hover" align="center">
            <tr>
                <th class="text-center">MRR</th>
                <th class="text-center">Daya Cutting</th>
            </tr>
            <tr>
                <td><?= $mrr ?></td>
                <td><?= ($mrr * $data['Spesifik_Energi']) / 60 ?></td>
    
                <?php
                $dayacutting = ($mrr * $data['Spesifik_Energi']) / 60; ?>
            </tr>
        </table>
        <div class="box">
            <?php
            if (($dayacutting / $dayarealtime) > 2) {
                echo "Mesin Efisien";
            } else {
            ?>
                <div class="alert alert-danger alert-dismissible text-center" role="alert">
                    <h3><strong>Mesin Tidak Efisien</strong></h3>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</div>