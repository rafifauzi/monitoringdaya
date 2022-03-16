<?php
include_once('../header.php');


$sql = "SELECT * FROM `datamaterial`";
$get = mysqli_query($con, $sql);
?>

<div class="box">
    <div class="container">
        <h3>Tambah Material</h3>
        <hr>
        <form action="" method="post" class="" autocomplete="no">
            <div class="form-group">
                <label>Nama</label>
                <input type="text" name="nama" class="form-control" required autofocus>
            </div>
            <div class="form-group">
                <label>Spesifik Energi</label>
                <input type="text" name="spesifik_energi" class="form-control" required autocomplete="no">
            </div>
            <div class="form-group pull-right">
                <input type="submit" name="tambah" value="Simpan" class="btn btn-success">
            </div>
        </form>
        <br>
        <h3>Daftar User</h3>
        <hr>
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Spesifik_Energi</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <?php
            $no = 1;
            while ($dataMaterial = mysqli_fetch_array($get)) {
            ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $dataMaterial['Nama'] ?></td>
                    <td><?= $dataMaterial['Spesifik_Energi'] ?></td>
                    <td>
                        <a href="edit.php?id=<?= $dataMaterial['ID'] ?>" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-edit"></i></a>
                        <a href="del.php?id=<?= $dataMaterial['ID'] ?>" onclick="return confirm('Yakin akan menghapus data')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a>
                    </td>
                </tr>
            <?php

            }
            ?>
        </table>
        <?php
        if (isset($_POST['tambah'])) {
            $nama = $_POST['nama'];
            $spesifik_energi = $_POST['spesifik_energi'];
            $sql = "INSERT INTO `datamaterial`(`Nama`, `Spesifik_Energi`) VALUES ('$nama','$spesifik_energi')";
            $insert = mysqli_query($con, $sql) or mysqli_error($con, $sql);
            if ($insert) {
        ?>
                <div class="alert alert-success alert-dismissible" role="alert">
                    Input Data Material <strong>Berhasil!</strong>
                </div>
            <?php
            } else {
            ?>
                <div class="alert alert-danger alert-dismissible" role="alert">
                    Input Data Material <strong>Gagal!</strong> <?=mysqli_error($con, $sql);?>
                </div>
        <?php
            }
        }

        ?>
    </div>
</div>
<script>
    window.setTimeout(function() {
        $(".alert").fadeTo(200, 0).slideUp(500, function() {
            $(this).remove();
            window.location.href = window.location.href;
        });
    }, 1500);
</script>
<?php include_once('../footer.php'); ?>