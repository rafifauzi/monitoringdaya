<?php include_once('../header.php'); 

$mesin = '1';
if(isset($_GET['mesin']))
{
    $mesin = $_GET['mesin'];
}
else
{
    $sql = "SELECT * FROM tabel_mesin WHERE `status` = '1'";
    $result = $con->query($sql);
    if ($result->num_rows > 0) 
    {
        $row = $result->fetch_assoc();
        $mesin = $row['ID_mesin'];
    }
}	
$sql_treshold = mysqli_query($con, "SELECT * FROM tabel_treshold WHERE `status` = '1' && `ID_mesin` = '" . $mesin . "';") or die (mysqli_error($con));
$treshold = mysqli_fetch_array($sql_treshold);	
?>

<div class="box">
        <h1>PM Remaining Time</h1>
        <br>
        <br>
        <div class="pull-right">
            <a href="edit.php" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-edit"></i>Edit Remaining Time of Next PM</a>
        </div>
        <br>
        <br>
    <div>
        <table class="text-center table table-striped table-bordered table-hover"  align="center">
            <?php
                $datamesinready = mysqli_query($con, "SELECT * FROM tabel_monitoring WHERE `ID_mesin`='" . $mesin . "' AND Power>='" . $treshold['th_mesin_ready'] ."' and Power<='" . $treshold['th_spindel_on'] ."'") or die (mysqli_error($con));
                $jmlmesinready = mysqli_num_rows($datamesinready);

                $dataspindelon = mysqli_query($con, "SELECT * FROM tabel_monitoring WHERE `ID_mesin`='" . $mesin . "' AND Power>='" . $treshold['th_spindel_on'] ."' and Power<='" . $treshold['th_cutting'] ."'") or die (mysqli_error($con));
                $jmlspindelon = mysqli_num_rows($dataspindelon);

                $datacutting = mysqli_query($con, "SELECT * FROM tabel_monitoring WHERE `ID_mesin`='" . $mesin . "' AND Power>='" . $treshold['th_cutting'] ."'") or die (mysqli_error($con));
                $jmlcutting = mysqli_num_rows($datacutting);

                $jamkerjaterkini = (($jmlspindelon+$jmlcutting)*0.0013888889);
            ?>
            <?php
            $sql_mesin = mysqli_query($con, "SELECT * FROM tabel_mesin") or die (mysqli_error($con));
            $data = mysqli_fetch_array($sql_mesin);?>
            <tr >
                <th class="text-center">Machine Working Hour</th>
				<th class="text-center">Working Hour of Next PM</th>
            </tr>
            <tr >
                <td><?=round((($jmlspindelon+$jmlcutting)*5/3600),3)?></td>
                <td><?=$data['sisawaktu_PM']?></td>
            </tr>
        </table>
        <br>
        <table class="text-center table table-striped table-bordered table-hover"  align="center">
            <tr>
                <th class="text-center">PM Remaining Time</th>
                <td><?=round(($data['sisawaktu_PM']-$jamkerjaterkini),3)?></td>
                <td>Hour</td>
            </tr>
            <tr>
                <th class="text-center"></th>
                <td><?=round($data['sisawaktu_PM']-$jamkerjaterkini)/40?></td>
                <td>Week</td> 
            </tr>
        </table>  
    </div>