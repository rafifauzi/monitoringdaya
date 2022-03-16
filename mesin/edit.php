<?php include_once('../header.php'); ?>

    <div class="box">
    <h1>Machine</h1>
        <h4>
            <small>Edit Machine Data</small>
            <div class="pull-right">
                <a href="data.php" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-chevron-left"></i>Back</a>
        </h4>
        <div class="row">
            <div class="col-lg-6 col-lg-offset-3">
                <?php
                    $id = $_GET['id'];
                    $sql = mysqli_query($con, "SELECT * FROM tabel_mesin WHERE ID_mesin = '$id'") or die (mysqli_error($conn));
                    $data = mysqli_fetch_array($sql);
                ?>
                <form action ="proses.php" method ="post">
                    <div class = "form-group">
                        <label for = "no_mesin">Nomor Mesin</label>
                        <input type="hidden" name="id" value="<?=$data['ID_mesin']?>">
                        <input type = "text" name="no_mesin" value="<?=$data['no_mesin']?>" id="no_mesin" class="form-control" required autofocus>
                    </div> 
                    <div class = "form-group">
                        <label for = "nama_mesin">Nama Mesin</label>
                        <input type = "text" name="nama_mesin" value="<?=$data['nama_mesin']?>" id="nama_mesin" class="form-control" required>
                    </div> 
                    <div class = "form-group">
                        <label for = "lokasi_mesin">Lokasi Mesin</label>
                        <input type = "text" name="lokasi_mesin" value="<?=$data['lokasi_mesin']?>" id="lokasi_mesin" class="form-control" required>
                    </div> 
                    <div class = "form-group pull-right">
                        <input type = "submit" name="edit" value="Simpan" class="btn btn-success">
                    </div>
                </form> 
            </div>
        </div>

<?php include_once('../header.php'); ?>