<?php 
include_once('../header.php'); 

$sql = "SELECT * FROM tabel_mesin WHERE `status` = '1'";
$result = $con->query($sql);
$mesin = '1';
if ($result->num_rows > 0) 
{
	$row = $result->fetch_assoc();
	$mesin = $row['ID_mesin'];
}
?>

<div class="box">
        <h1>Power Monitoring Data</h1>
    <div class ="container">
        <br>
        <form method = "post">
            <table>
                <tr>
                    <td>From</td>
                    <td><input type="date" name ="dari_tgl" required ="required"></td>
                    <td>To</td>
                    <td><input type="date" name ="sampai_tgl" required ="required"></td>
                    <td><input type="submit" class ="btn btn-primary" name ="filter" value ="filter"></td>
                </tr>
            </table>
        </form>
        <br>
        <?php
        if (isset($_POST['filter'])){
            $dari_tgl = mysqli_real_escape_string($con, $_POST['dari_tgl']);
            $sampai_tgl = mysqli_real_escape_string($con, $_POST['sampai_tgl']);
            echo "Dari Tanggal ". $dari_tgl. " Sampai Tanggal ". $sampai_tgl;
        }
        ?>
        <br><br>
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Number</th>
                        <th>Machine Number</th>
                        <th>Current</th>
                        <th>Voltage</th>
                        <th>Power</th>
                        <th>Time</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $no = 1;
                $query = "SELECT * FROM tabel_monitoring
                        INNER JOIN tabel_mesin ON tabel_monitoring.ID_mesin = tabel_mesin.ID_mesin
                ";
                $sql_monitoring = mysqli_query($con, $query ) or die (mysqli_error($con));
                $value = mysqli_fetch_array($sql_monitoring);
				
                if (isset($_POST['filter'])){
                    $dari_tgl = mysqli_real_escape_string($con, $_POST['dari_tgl']);
                    $sampai_tgl = mysqli_real_escape_string($con, $_POST['sampai_tgl']);
                    $sql_mesin = mysqli_query($con, "SELECT * FROM tabel_monitoring WHERE `ID_mesin` = '". $mesin ."' AND Date_Time BETWEEN '$dari_tgl' AND '$sampai_tgl'") or die (mysqli_error($con));
                } else {
                    $sql_mesin = mysqli_query($con, "SELECT * FROM tabel_monitoring WHERE `ID_mesin` = '". $mesin ."';") or die (mysqli_error($con));
                }
                if(mysqli_num_rows($sql_mesin) > 0) { 
                    while($data = mysqli_fetch_array($sql_mesin)){ 
					
						$sql_treshold = mysqli_query($con, "SELECT * FROM tabel_treshold WHERE `ID_mesin` = '" . $data['ID_mesin'] . "';") or die (mysqli_error($con));
						$treshold = mysqli_fetch_array($sql_treshold);

						?>
                        <tr> 
                            <td><?=$no++?></td> 
                            <td><?=$value['no_mesin']?></td> 
                            <td><?=$data['Current']?></td> 
                            <td><?=$data['Voltage']?></td> 
                            <td><?=$data['Power']?></td> 
                            <td><?=$data['Date_Time']?></td> 
                            <?php 
							$status = "-";
                              if($data['Power'] >=$treshold['th_mesin_ready'] and $data['Power'] <= $treshold['th_spindel_on']){
                                $status = "Mesin Ready";
                              }else if($data['Power'] > $treshold['th_spindel_on'] and $data['Power'] <= $treshold['th_cutting']){
                                $status = "Spindle ON";
                              }else if($data['Power'] > $treshold['th_cutting']){
                                $status = "Cutting Process";
                              }
                            ?>
                            <td><?=$status?></td>
                        </tr>
                <?php
                    }
                } else {
                    echo "<tr><td colspan=\"4\" align=\"center\">Data tidak ditemukan</td></tr>";
                }
                $sql_mesin = mysqli_query($con, "SELECT * FROM tabel_monitoring") or die (mysqli_error($con));
                $data = mysqli_fetch_array($sql_mesin);
                $power = $data['Power'];

                $datamesinready = mysqli_query($con, "SELECT * FROM tabel_monitoring WHERE `ID_mesin`='" . $mesin . "' AND Power>='" . $treshold['th_mesin_ready'] ."' and Power<='" . $treshold['th_spindel_on'] ."'") or die (mysqli_error($con));
                $jmlmesinready = mysqli_num_rows($datamesinready);

                $dataspindelon = mysqli_query($con, "SELECT * FROM tabel_monitoring WHERE `ID_mesin`='" . $mesin . "' AND Power>='" . $treshold['th_spindel_on'] ."' and Power<='" . $treshold['th_cutting'] ."'") or die (mysqli_error($con));
                $jmlspindelon = mysqli_num_rows($dataspindelon);

                $datacutting = mysqli_query($con, "SELECT * FROM tabel_monitoring WHERE `ID_mesin`='" . $mesin . "' AND Power>='" . $treshold['th_cutting'] ."'") or die (mysqli_error($con));
                $jmlcutting = mysqli_num_rows($datacutting);
                ?>
            </table>
        </div>
    </div>
 </div>

        