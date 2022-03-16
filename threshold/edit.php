<?php include_once('../header.php'); ?>

    <div class="box">
    <h1>Threshold</h1>
        <h4>
            <small>Edit Threshold Data</small>
            <div class="pull-right">
                <a href="data.php" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-chevron-left"></i>Back</a>
        </h4>
        <div class="row">
            <div class="col-lg-6 col-lg-offset-3">
                <?php
                    $id = $_GET['id'];
                    $sql = mysqli_query($con, "SELECT * FROM tabel_treshold WHERE nomor = '$id'") or die (mysqli_error($conn));
                    $data = mysqli_fetch_array($sql);
                ?>
                <form action ="proses.php" method ="post">
                    <div class = "form-group">
                        <label for = "th_mesin_ready">TH Mesin Ready</label>
                        <input type="hidden" name="id" value="<?=$data['nomor']?>">
                        <input type = "text" name="th_mesin_ready" value="<?=$data['th_mesin_ready']?>" id="th_mesin_ready" class="form-control" required>
                    </div> 
                    <div class = "form-group">
                        <label for = "th_spindel_on">TH Spindel ON</label>
                        <input type = "text" name="th_spindel_on" value="<?=$data['th_spindel_on']?>" id="th_spindel_on" class="form-control" required>
                    </div> 
                    <div class = "form-group">
                        <label for = "th_cutting">TH Cutting</label>
                        <input type = "text" name="th_cutting" value="<?=$data['th_cutting']?>" id="th_cutting" class="form-control" required>
                    </div> 
                    <div class = "form-group pull-right">
                        <input type = "submit" name="edit" value="Simpan" class="btn btn-success">
                    </div>
                </form> 
            </div>
        </div>

<?php include_once('../header.php'); ?>