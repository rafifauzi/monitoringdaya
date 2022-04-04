<?php include_once('../header.php'); ?>

    <div class="box">
        <h1>Threshold Data</h1>
        <h4>
            <div class="pull-right">
                <a href="#" onclick="refresh();" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-refresh"></i></a>
                <a href="add.php" class="btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i>Add Data</a>
        </h4>
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Number</th>
                        <th>Machine Number</th>
                        <th>Speed</th>
                        <th>TH Mesin Ready</th>
                        <th>TH Spindel ON</th>
                        <th>TH Cutting</th>
                        <th>Status</th>
                        <th><i class="glyphicon glyphicon-cog"></i></th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $no = 1;
                $query = "SELECT * FROM tabel_treshold INNER JOIN tabel_mesin ON tabel_treshold.ID_mesin = tabel_mesin.ID_mesin ORDER BY nomor DESC";
                $sql_threshold = mysqli_query($con, $query ) or die (mysqli_error($con));
                if(mysqli_num_rows($sql_threshold) > 0) {
                    while($data = mysqli_fetch_array($sql_threshold)){ ?>
                        <tr>
                            <td><?=$no++?></td>
                            <td><?=$data['no_mesin']?></td>
                            <td><?=$data['speed']?></td>
                            <td><?=$data['th_mesin_ready']?></td>
                            <td><?=$data['th_spindel_on']?></td>
                            <td><?=$data['th_cutting']?></td>
                            <td><?=$data['status']?></td>
                            <td class="text-center">
                                <a href ="edit.php?id=<?=$data['nomor']?>" class = "btn btn-warning btn-xs"><i class ="glyphicon glyphicon-edit"></i></a>
                                <a href ="del.php?id=<?=$data['nomor']?>" onclick="return confirm('Yakin akan menghapus data')" class = "btn btn-danger btn-xs"><i class ="glyphicon glyphicon-trash"></i></a>
                            </td>   
                        </tr>
                    <?php
                    }
                } else {
                    echo "<tr><td colspan=\"4\" align=\"center\">Data tidak ditemukan</td></tr>";
                }
                ?>
            </table>
        </div>
    </div>
    <script>
function refresh(){
    location.reload();
}

    </script>

        