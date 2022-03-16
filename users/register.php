<?php
include_once('../header.php');


$sql = "SELECT * FROM `tabel_user` ORDER BY username";
$get = mysqli_query($con, $sql);
?>

<div class="box">
    <div class="container">
        <h3>Tambah User</h3>
        <hr>
        <form action="" method="post" class="" autocomplete="no">
            <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" name="name" class="form-control" required autofocus>
            </div>
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="user" class="form-control" required autocomplete="no">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="pass" class="form-control" required autocomplete="no">
            </div>
            <div class="form-group">
                <label>Status</label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="status" value="user" required>
                    <label class="form-check-label" for="inlineRadio2">User</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="status" value="admin" required>
                    <label class="form-check-label" for="inlineRadio1">Admin</label>
                </div>
            </div>
            <div class="form-group pull-right">
                <input type="submit" name="register" value="Daftar" class="btn btn-success">
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
                    <th scope="col">Username</th>
                    <th scope="col">Status</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <?php
            $no = 1;
            while ($dataUser = mysqli_fetch_array($get)) {
            ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $dataUser['nama_user'] ?></td>
                    <td><?= $dataUser['username'] ?></td>
                    <td><?= $dataUser['level'] ?></td>
                    <td>
                        <a href="edit.php?id=<?= $dataUser['ID_user'] ?>" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-edit"></i></a>
                        <a href="del.php?id=<?= $dataUser['ID_user'] ?>" onclick="return confirm('Yakin akan menghapus data')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a>
                    </td>
                </tr>
            <?php

            }
            ?>
        </table>
        <?php
        if (isset($_POST['register'])) {
            $username = $_POST['user'];
            $user = $_POST['name'];
            $status = $_POST['status'];
            $pass = sha1(trim(mysqli_real_escape_string($con, $_POST['pass'])));
            $sql = "INSERT INTO tabel_user (nama_user, username, password, level) VALUES ('$user', '$username','$pass', '$status')";
            $insert = mysqli_query($con, $sql);
            if ($insert) {
        ?>
                <div class="alert alert-success alert-dismissible" role="alert">
                    Input Data User <strong>Berhasil!</strong>
                </div>
            <?php
            } else {
            ?>
                <div class="alert alert-danger alert-dismissible" role="alert">
                    Input Data User <strong>Gagal!</strong>
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