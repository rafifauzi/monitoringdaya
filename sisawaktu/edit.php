<?php include_once('../header.php'); ?>

    <div class="box">
    <h1>Remaining Time of Next PM</h1>
        <h4>
            <div class="pull-right">
                <a href="data.php" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-chevron-left"></i>Back</a>
        </h4>
        <div class="row">
            <div class="col-lg-6 col-lg-offset-3">
                <?php
                    $sql = mysqli_query($con, "SELECT * FROM tabel_mesin WHERE status = '1'") or die (mysqli_error($conn));
                    $data = mysqli_fetch_array($sql);
                ?>
                <form action ="proses.php" method ="post">
                    <div class = "form-group">
                        <label for = "sisawaktu_PM">Remaining Time of Next PM</label>
                        <input type = "text" name="sisawaktu_PM" value="<?=$data['sisawaktu_PM']?>" id="sisawaktu_PM" class="form-control" required>
                    </div> 
                    <div class = "form-group pull-right">
                        <input type = "submit" name="edit" value="Save" class="btn btn-success">
                    </div>
                </form> 
            </div>
        </div>

<?php include_once('../header.php'); ?>