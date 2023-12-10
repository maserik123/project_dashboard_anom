<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $title ?></title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?php echo base_url('assets') ?>/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url('assets') ?>/dist/css/adminlte.min.css">
</head>

<body class="hold-transition sidebar-collapse layout-top-nav">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
            <div class="container">
                <a href="../../index3.html" class="navbar-brand">
                    <img src="<?php echo base_url('assets') ?>/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                    <span class="brand-text font-weight-light">Dashboard Details</span>
                </a>

            </div>
        </nav>
        <!-- /.navbar -->
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <?php $query = $this->db->query('select master_project_id from project_m_hdr where project_m_hdr_id ="' . $project_id . '"')->row_array(); ?>
                            <?php $getProject = $this->db->query('select project_name from master_project where master_project_id = "' . $query['master_project_id'] . '"')->row_array(); ?>
                            <?php $getDetailProject = $this->db->query('select b.* from master_project a inner join criteria_project b on b.criteria_project_id = a.criteria_project_id')->row_array(); ?>
                            <?php $getPICDetail = $this->db->query('select b.pic_project_name from project_m_hdr a inner join pic_project_hdr b on b.pic_project_hdr_id = a.pic_project_hdr_id where a.project_m_hdr_id ="' . $project_id . '"')->row_array(); ?>
                            <?php $getStatus = $this->db->query('select b.status_name from project_m_hdr a inner join project_status b on b.project_status_id = a.project_status_id where a.project_m_hdr_id = "' . $project_id . '"')->row_array(); ?>
                            <?php $getDtlProjectHdr = $this->db->query('select * from project_m_hdr where project_m_hdr_id = "' . $project_id . '"')->row_array(); ?>

                            <h1 class="m-0">Detail Projects <small><?php echo $getProject['project_name']; ?></small></h1>

                        </div><!-- /.col -->

                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Project Specification</h5>
                                    <br>
                                    <ul>
                                        <li>Type/Criteria : <?php echo $getDetailProject['criteria_project_name'];  ?></li>
                                        <li>PIC Project : <?php echo $getPICDetail['pic_project_name'];  ?></li>
                                        <li>Status Project : <?php echo $getStatus['status_name'];  ?></li>
                                        <li>Anggaran : <?php echo rupiah_format($getDtlProjectHdr['capex_budget']);  ?></li>
                                        <li>Anggaran Terpakai : <?php echo rupiah_format($getDtlProjectHdr['capex_realization']);  ?></li>
                                    </ul>
                                    <div class="col-lg-8 col-6">
                                        <!-- small card -->
                                        <div class="small-box bg-primary">
                                            <div class="inner">
                                                <h3>50%</h3>

                                                <p>Progress Totals</p>
                                            </div>
                                            <div class="icon">
                                                <i class="fas fa-chart-bar"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-8 col-6">
                                        <!-- small card -->
                                        <div class="small-box bg-danger">
                                            <div class="inner">
                                                <h3>50%</h3>

                                                <p>Progress Kajian</p>
                                            </div>
                                            <div class="icon">
                                                <i class="fas fa-chart-bar"></i>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="card card-primary card-outline">
                                <div class="card-body">
                                    <h5 class="card-title">Card title</h5>

                                    <p class="card-text">
                                        Some quick example text to build on the card title and make up the bulk of the card's
                                        content.
                                    </p>
                                    <a href="#" class="card-link">Card link</a>
                                    <a href="#" class="card-link">Another link</a>
                                </div>
                            </div><!-- /.card -->
                        </div>
                        <!-- /.col-md-6 -->
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title m-0">Featured</h5>
                                </div>
                                <div class="card-body">
                                    <h6 class="card-title">Special title treatment</h6>

                                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                                    <a href="#" class="btn btn-primary">Go somewhere</a>
                                </div>
                            </div>

                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <h5 class="card-title m-0">Featured</h5>
                                </div>
                                <div class="card-body">
                                    <h6 class="card-title">Special title treatment</h6>

                                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                                    <a href="#" class="btn btn-primary">Go somewhere</a>
                                </div>
                            </div>
                        </div>
                        <!-- /.col-md-6 -->
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
                Anything you want
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="<?php echo base_url('assets') ?>/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?php echo base_url('assets') ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url('assets') ?>/dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo base_url('assets') ?>/dist/js/demo.js"></script>
</body>

</html>