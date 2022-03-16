<?php include_once('../header.php'); ?>

    <div class="box">
    <h1>Machine</h1>
        <h4>
            <small>Add Machine</small>
            <div class="pull-right">
                <a href="data.php" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-chevron-left"></i>Back</a>
        </h4>
        <div class="row">
            <div class="col-lg-6 col-lg-offset-3">
                <form action ="proses.php" method ="post">
                    <div class = "form-group">
                        <label for = "no_mesin">Machine Number</label>
                        <input type = "text" name="no_mesin" id="no_mesin" class="form-control" required autofocus>
                    </div> 
                    <div class = "form-group">
                        <label for = "nama_mesin">Machine Name</label>
                        <input type = "text" name="nama_mesin" id="nama_mesin" class="form-control" required>
                    </div> 
                    <div class = "form-group">
                        <label for = "lokasi_mesin">Machine Location</label>
                        <input type = "text" name="lokasi_mesin" id="lokasi_mesin" class="form-control" required>
                    </div> 
                    <div class = "form-group pull-right">
                        <input type = "submit" name="add" value="Save" class="btn btn-success">
                    </div>
                </form> 
            </div>
        </div>

<?php include_once('../header.php'); ?>