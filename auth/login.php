<?php
require_once "../config/config.php";
if (isset($_SESSION['user'])) {
    echo "<script>window.location='" . base_url() . "';</script>";
} else {
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Login - Monitoring Daya Mesin</title>

        <!-- Core CSS - Include with every page -->
        <link href="<?= base_url('assets/css/bootstrap.css'); ?>" rel="stylesheet">
        <link href="<?= base_url('assets/css/sb-admin.css'); ?>" rel="stylesheet">
        <script src="<?= base_url('assets/js/bootstrap.min.js'); ?>"></script>
        <script src="<?= base_url('assets/js/jquery-3.4.1.js'); ?>"></script>
    </head>
    <style>
        .box-login {
            background-color: #fff;
            margin-top: 200px;
            padding: 50px;
        }

        .box-login .btn {
            margin-top: 20px !important;
        }

        .box-login input,
        .box-login label {
            margin-top: 10px;
        }
    </style>

    <body>
        <div id="wrapper">
            <div class="container box-login">
                <div>
                    <h2 class="text-center"> Halaman Login </h2>
                    <hr>
                    <form action="" method="post" class="">
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="user" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="pass" class="form-control" required autofocus>
                        </div>

                        <div class="text-center">
                            <input type="submit" name="login" class="btn btn-primary" value="Login">
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <?php
        if (isset($_POST['login'])) {
            $user = trim(mysqli_real_escape_string($con, $_POST['user']));
            $pass = sha1(trim(mysqli_real_escape_string($con, $_POST['pass'])));
            $sql_login = mysqli_query($con, "SELECT * FROM tabel_user WHERE username = '$user' AND password = '$pass'") or die(mysqli_error($con));
            $data=mysqli_fetch_array($sql_login);
            if (mysqli_num_rows($sql_login) > 0) {
                $_SESSION['user'] = $user;
                $_SESSION['level'] = $data['level'];
                echo "<script>window.location='" . base_url() . "';</script>";
                
            } else { ?>
                <div class="row">
                    <div class="col-lg-6 col-lg-offset-3">
                        <div class="alert alert-danger alert-dismissable" role="alert">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                            <strong>Login gagal!</strong> Username / password salah
                        </div>
                    </div>
                </div>
        <?php
            }
        }
        ?>
        <script src="<?= base_url('assets/js/bootstrap.min.js'); ?>"></script>
        <script src="<?= base_url('assets/js/jquery-3.4.1.js'); ?>"></script>
    </body>

    </html>
<?php
}
?>