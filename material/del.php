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
        <h3>Hapus Material</h3>
        <hr>
        <form action="" method="post" class="" autocomplete="no">
            <div class="form-group">
                <label>Nama</label>
                <input type="text" name="nama" class="form-control" value="<?= $dataMaterial['Nama']; ?>" disabled>
            </div>
            <div class="form-group">
                <label>Spesifik Energi</label>
                <input type="text" name="spesifik_energi" class="form-control" value="<?= $dataMaterial['Spesifik_Energi']; ?>" disabled>
            </div>
        </form>
        <br>

        <?php
        $delete = mysqli_query($con, "DELETE FROM datamaterial WHERE ID='$id'");
        if ($delete) {
        ?>
            <div class="alert alert-success alert-dismissible" role="alert">
                Hapus Data Material <strong>Berhasil!</strong>
            </div>
        <?php
        } else {
        ?>
            <div class="alert alert-danger alert-dismissible" role="alert">
                Ubah Data Material <strong>Gagal!</strong>
            </div>
        <?php
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
    }, 1800);
</script>
<?php include_once('../footer.php'); ?>