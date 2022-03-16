<?php
include_once('../header.php');
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM `datamaterial` WHERE ID='$id'";
    $get = mysqli_query($con, $sql);
    $dataMaterial = mysqli_fetch_array($get);
} else {
    echo "<script>window.location='material.php';</script>";
}
?>

<div class="box">
    <div class="container">
        <h3>Edit Material</h3>
        <hr>
        <form action="" method="post" class="" autocomplete="no">
            <div class="form-group">
                <label>Nama</label>
                <input type="text" name="nama" class="form-control" value="<?=$dataMaterial['Nama'];?>" required>
            </div>
            <div class="form-group">
                <label>Spesifik Energi</label>
                <input type="text" name="spesifik_energi" class="form-control" value="<?=$dataMaterial['Spesifik_Energi'];?>" required>
            </div>
            <div class="input-group pull-right">
                <input type="submit" name="edit" class="btn btn-warning" value="Simpan">
            </div>
        </form>
        <br>

        <?php
        if (isset($_POST['edit'])) {
            $nama = $_POST['nama'];
            $spesifik_energi = $_POST['spesifik_energi'];
            $sql = "UPDATE `datamaterial` SET `Nama`='$nama',`Spesifik_Energi`='$spesifik_energi' WHERE ID='$id'";
            $edit = mysqli_query($con, $sql);
            if ($edit) {
        ?>
                <div class="alert alert-success alert-dismissible" role="alert">
                    Ubah Data Material <strong>Berhasil!</strong>
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
            window.location = 'material.php';
        });
    }, 1000);
</script>
<?php include_once('../footer.php'); ?>