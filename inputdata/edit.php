<?php include_once('../header.php'); ?>

    <div class="box">
    <h1>Input Data Pemotongan</h1>
        <h4>
        <small>Edit Input Data Pemotongan</small>
            <div class="pull-right">
                <a href="data.php" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-chevron-left"></i>Back</a>
        </h4>
        <div class="row">
            <div class="col-lg-6 col-lg-offset-3">
                <?php
                error_reporting(0);
                    $id =  $_GET['Nawa'];
                    $sql = mysqli_query($con, "SELECT * FROM datapemotongan WHERE Nawa = '$id'") or die (mysqli_error($conn));
                    $data = mysqli_fetch_array($sql);
                ?>
                <form action ="proses.php" method ="post">
                    <div class = "form-group">
                        <label for = "nama_material">Material Name</label>
                        <select name="id_material" id="Nama" class="form-control" required>
                            <option value="">- Select Material -</option>
                            <?php
                            $sql_material = mysqli_query ($con, "SELECT * FROM datamaterial") or die (mysqli_error($con));
                            while($data_material = mysqli_fetch_array($sql_material)){
                                echo '<option value="'.$data_material['ID'].'">'.$data_material['Nama'].'</option>';
                            } ?>
                        </select>
                    </div>
                    <div class = "form-group">
                        <label for = "doc">Depth of Cut</label>
                        <input type="hidden" name="id" value="<?=$data['Nawa']?>">
                        <input type = "text" name="doc" id="doc" class="form-control" required>
                    </div> 
                    <div class = "form-group">
                        <label for = "loc">Length of Cut</label>
                        <input type = "text" name="loc" id="loc" class="form-control" required>
                    </div>  
                    <div class = "form-group">
                        <label for = "dia_cutter">Diameter Cutter</label>
                        <input type = "text" name="dia_cutter"  id="dia_cutter" class="form-control" required>
                    </div> 
                    <div class = "form-group">
                        <label for = "n">Jumlah Mata Potong</label>
                        <input type = "text" name="n"  id="n" class="form-control" required>  
                    </div> 
                    <div class = "form-group">
                        <label for = "rpm">Revolution per Minute</label>
                        <input type = "text" name="rpm" id="rpm" class="form-control" required>
                    </div> 
                    <div class = "form-group">
                        <label for = "fz">Feed per Teeth</label>
                        <input type = "text" name="fz"  id="fz" class="form-control" required>
                    </div> 
                    <div class = "form-group pull-right">
                        <input type = "submit" name="edit" value="Simpan" class="btn btn-success">
                    </div>
                </form> 
            </div>
        </div>

<?php include_once('../header.php'); ?>