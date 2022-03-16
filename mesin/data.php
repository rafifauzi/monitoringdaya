<?php include_once('../header.php'); ?>

    <div class="box">
        <h1>Machine Data</h1>
        <h4>
            <div class="pull-right">
                <a href="" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-refresh"></i></a>
                <a href="add.php" class="btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i>Add Machine</a>
        </h4>
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Number</th>
                        <th>Machine Number</th>
                        <th>Machine Name</th>
                        <th>Machine Location</th>
                        <th><i class="glyphicon glyphicon-cog"></i></th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $no = 1;
                $sql_mesin = mysqli_query($con, "SELECT * FROM tabel_mesin") or die (mysqli_error($con));
                if(mysqli_num_rows($sql_mesin) > 0) {
                    while($data = mysqli_fetch_array($sql_mesin)){ ?>
                        <tr>
                            <td><?=$no++?></td>
                            <td><?=$data['no_mesin']?></td>
                            <td><?=$data['nama_mesin']?></td>
                            <td><?=$data['lokasi_mesin']?></td>
                            <td class="text-center">
                                <a href ="edit.php?id=<?=$data['ID_mesin']?>" class = "btn btn-warning btn-xs"><i class ="glyphicon glyphicon-edit"></i></a>
                                <a href ="del.php?id=<?=$data['ID_mesin']?>" onclick="return confirm('Yakin akan menghapus data')" class = "btn btn-danger btn-xs"><i class ="glyphicon glyphicon-trash"></i></a>
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

        