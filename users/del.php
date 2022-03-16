<?php
include_once('../header.php');
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM `tabel_user` WHERE ID_user='$id' ORDER BY username";
    $get = mysqli_query($con, $sql);
    $dataUser = mysqli_fetch_array($get);
    if ($dataUser['level'] == 'admin') {
        $checked1 = 'checked';
        $checked2 = '';
    } else {
        $checked1 = '';
        $checked2 = 'checked';
    }
} else {
    echo "<script>window.location='register.php';</script>";
}
?>

<div class="box">
    <div class="container">
        <h3>Hapus User</h3>
        <hr>
        <form action="" method="post" class="" autocomplete="no">
            <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" name="name" class="form-control" value="<?= $dataUser['nama_user']; ?>" value="<?= $dataUser['nama_user']; ?>" disabled>
            </div>
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="user" class="form-control" value="<?= $dataUser['username']; ?>" disabled>
            </div>
            <div class="form-group">
                <label>Status</label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="status" <?= $checked2; ?> value="user" disabled>
                    <label class="form-check-label" for="inlineRadio2">User</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="status" <?= $checked1; ?> value="admin" disabled>
                    <label class="form-check-label" for="inlineRadio1">Admin</label>
                </div>
            </div>
        </form>
        <br>

        <?php
        $delete = mysqli_query($con,"DELETE FROM tabel_user WHERE ID_user='$id'");
        if ($delete) {
        ?>
            <div class="alert alert-success alert-dismissible" role="alert">
                Hapus Data User <strong>Berhasil!</strong>
            </div>
        <?php
        }else{
        ?>
            <div class="alert alert-danger alert-dismissible" role="alert">
                Ubah Data User <strong>Gagal!</strong>
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
            window.location='register.php';
        });
    }, 1800);
</script>
<?php include_once('../footer.php'); ?>