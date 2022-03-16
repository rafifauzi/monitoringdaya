<?php include_once('../header.php'); ?>

    <div class="box">
    <h1>Threshold</h1>
        <h4>
            <small>Add Threshold Data</small>
            <div class="pull-right">
                <a href="data.php" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-chevron-left"></i>Back</a>
        </h4>
        <div class="row">
            <div class="col-lg-6 col-lg-offset-3">
                <form action ="proses.php" method ="post">
                    <div class = "form-group">
                        <label for = "nama_mesin">Machine Name</label>
                        <select name="no_mesin" id="no_mesin" class="form-control" required>
                            <option value="">- Select Machine -</option>
                            <?php
                            $sql_mesin = mysqli_query ($con, "SELECT * FROM tabel_mesin") or die (mysqli_error($con));
                            while($data_mesin = mysqli_fetch_array($sql_mesin)){
                                echo '<option value="'.$data_mesin['ID_mesin'].'">'.$data_mesin['no_mesin'].'</option>';
                            } ?>
                        </select>
                    </div> 
                    <div class = "form-group">
                    <label for = "speed">Spindel Speed</label>
                    <select name = "speed" id="speed" class="form-control" required>>
                        <option value = "">- Select Spindel Speed -</option>
                        <option value = "1">Speed 1</option>
                        <option value = "2">Speed 2</option>
                    </select>
                    </div>
                    <div class = "form-group">
                        <label for = "th_mesin_ready">TH Mesin Ready</label>
                        <input type = "text" name="th_mesin_ready" id="th_mesin_ready" class="form-control" required>
                    </div> 
                    <div class = "form-group">
                        <label for = "th_spindel_on">TH Spindel ON</label>
                        <input type = "text" name="th_spindel_on" id="th_spindel_on" class="form-control" required>
                    </div> 
                    <div class = "form-group">
                        <label for = "th_cutting">TH Cutting</label>
                        <input type = "text" name="th_cutting" id="th_cutting" class="form-control" required>
                    </div> 
                    <div class = "form-group pull-right">
                        <input type = "submit" name="add" value="Save" class="btn btn-success">
                    </div>
                </form> 
            </div>
        </div>

<?php include_once('../header.php'); ?>