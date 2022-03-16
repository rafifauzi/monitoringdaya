<?php
require_once "config/config.php";

if (!isset($_SESSION['user'])) {
    echo "<script>window.location='" . base_url('auth/login.php') . "';</script>";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="refresh" content="50000">

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Website Monitoring Daya Mesin</title>

    <!-- Core CSS - Include with every page -->
    <link href="<?= base_url('assets/css/bootstrap.css'); ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/sb-admin.css'); ?>" rel="stylesheet">
    <script src="<?= base_url('assets/js/bootstrap.min.js'); ?>"></script>
    <script src="<?= base_url('assets/js/jquery-3.4.1.js'); ?>"></script>
    <style>
        table {
            width: 50%;
        }

        table,
        th,
        td {
            border: 1px solid black;
            padding: 10px;
        }
    </style>
</head>

<body>
    <div id="wrapper">

        <nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" style="font-size: 20px !important;" href="index.html"><b>Machine Power Consumption Monitoring </b></a>
            </div>
            <!-- /.navbar-top-links -->

            <div class="navbar-default navbar-static-side" role="navigation">
                <div class="sidebar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">
                                        <i class="bi bi-search"></i>
                                    </button>
                                </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li>
                            <a href="<?= base_url('dashboard') ?>"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        <?php
                        $level=$_SESSION['level'];
                        if ($level==='admin') {
                            ?>
                            <li>
                                <a href="<?= base_url('users/register.php') ?>"><i class="fa fa-dashboard fa-fw"></i> List Users</a>
                            </li>
                            <li>
                                <a href="<?= base_url('monitoring/data.php') ?>"><i class="fa fa-edit fa-fw"></i> Monitoring Data </a>
                            </li>
                            <li>
                                <a href="<?= base_url('material/material.php') ?>"><i class="fa fa-edit fa-fw"></i> Material Data </a>
                            </li>
                            <li>
                                <a href="<?= base_url('mesin/data.php') ?>"><i class="fa fa-edit fa-fw"></i> Machine Data </a>
                            </li>
                            <li>
                                <a href="<?= base_url('threshold/data.php') ?>"><i class="fa fa-edit fa-fw"></i> Threshold Data </a>
                            </li>
                            <li>
                                <a href="<?= base_url('sisawaktu/data.php') ?>"><i class="fa fa-edit fa-fw"></i> PM Remaining Time </a>
                            </li>
                            <li>
                                <a href="<?= base_url('inputdata/data.php') ?>"><i class="fa fa-edit fa-fw"></i> Input Data Pemotongan </a>
                            </li>
                            <?php
                        }else{
                            ?>
                            <li>
                                <a href="<?= base_url('threshold/data.php') ?>"><i class="fa fa-edit fa-fw"></i> Threshold Data </a>
                            </li>
                            <li>
                                <a href="<?= base_url('inputdata/data.php') ?>"><i class="fa fa-edit fa-fw"></i> Input Data Pemotongan </a>
                            </li>
                            <?php 
                        }
                        ?>
                        <li>
                            <a href="<?= base_url('auth/logout.php') ?>"><span class="text-danger"></i> Logout</span></a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                    </li>
                    </ul>
                    <!-- /#side-menu -->
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">