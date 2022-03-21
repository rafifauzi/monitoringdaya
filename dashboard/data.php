<?php 
    include_once('../config/config.php');
    
    //get Monitoring dan Threshold Data
    $sql='SELECT * FROM `tabel_monitoring` JOIN `tabel_mesin` ON tabel_monitoring.ID_mesin=tabel_mesin.ID_mesin JOIN `tabel_treshold` ON tabel_monitoring.ID_mesin=tabel_treshold.ID_mesin';
    $query=mysqli_query($con,$sql);
?>
    <table border="1">
        <tr>
            <td>ID_mesin</td>
            <td>nama_mesin</td>
            <td>Power</td>
            <td>th_mesin_ready</td>
            <td>th_spindel_on</td>
            <td>th_cutting</td>
            <td>Status</td>
            <td>Date</td>
        </tr>
<?php
    while($get=mysqli_fetch_array($query)){
        if ($get['Power']<$get['th_spindel_on']) {
            $status='Ready';
        }elseif ($get['Power']>=$get['th_spindel_on'] && $get['Power']<$get['th_cutting']) {
            $status='Spindel On';
        }else if($get['Power']>=$get['th_cutting']){
            $status='Cutting';
        }
        ?>
        <tr>
            <td><?=$get['ID_mesin'];?></td>
            <td><?=$get['nama_mesin'];?></td>
            <td><?=$get['Power'];?></td>
            <td><?=$get['th_mesin_ready'];?></td>
            <td><?=$get['th_spindel_on'];?></td>
            <td><?=$get['th_cutting'];?></td>
            <td><?=$status;?></td>
            <td><?=$get['Date_Time'];?></td>
        </tr>
        <?php
    };
?>

</table>