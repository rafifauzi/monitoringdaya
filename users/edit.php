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
        <h3>Edit User</h3>
        <hr>
        <form action="" method="post" class="" autocomplete="no">
            <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" name="name" class="form-control" value="<?= $dataUser['nama_user']; ?>" value="<?= $dataUser['nama_user']; ?>" required>
            </div>
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="user" class="form-control" value="<?= $dataUser['username']; ?>" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="pass" class="form-control" autocomplete="none" autocomplete="no" placeholder="Kosongkan Jika Tidak Ingin Mengubah Password">
            </div>
            <div class="form-group">
                <label>Status</label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="status" <?= $checked2; ?> value="user" required>
                    <label class="form-check-label" for="inlineRadio2">User</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="status" <?= $checked1; ?> value="admin" required>
                    <label class="form-check-label" for="inlineRadio1">Admin</label>
                </div>
            </div>
            <!-- <div class="form-group" id="passadmin" style="display: none;">
                <label>Password Admin</label>
                <input type="password" name="passadmin" class="form-control">
            </div> -->
            <div class="input-group">
                <input type="submit" name="edit" class="btn btn-warning" value="Simpan">
            </div>
        </form>
        <br>

        <?php
        if (isset($_POST['edit'])) {
            $username = $_POST['user'];
            $user = $_POST['name'];
            $level = $_POST['status'];
            if ($_POST['pass'] == '') {
                $pass = $dataUser['password'];
            } else {
                $pass = sha1(trim(mysqli_real_escape_string($con, $_POST['pass'])));
            }
            $sql = "UPDATE `tabel_user` SET `nama_user`='$user',`username`='$username',`password`='$pass',`level`='$level' WHERE `ID_user`='$id'";
            $edit = mysqli_query($con, $sql);
            if ($edit) {
        ?>
                <div class="alert alert-success alert-dismissible" role="alert">
                    Ubah Data User <strong>Berhasil!</strong>
                </div>
            <?php
            } else {
            ?>
                <div class="alert alert-danger alert-dismissible" role="alert">
                    Ubah Data User <strong>Gagal!</strong>
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
            window.location='register.php';
        });
    }, 1000);

    function tampilKonfirm() {
        var checkBox = document.getElementById("regAdmin");
        var checkBox1 = document.getElementById("regUser");
        var formKonfirm = document.getElementById("passadmin");
        if (checkBox.checked == true) {
            formKonfirm.style.display = "block";
        } else if (checkBox1.checked == true) {
            formKonfirm.style.display = "none";
        }
    }
</script>
<?php include_once('../footer.php'); ?>