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
                            <?php $query = $this->db->query('select a.*, 
                            (SELECT (SUM(progress)/COUNT(master_project_id)) AS progress FROM project_m_dtl WHERE master_project_id = a.master_project_id) as progress_project,
                            (SELECT DATEDIFF(a.end_date, a.start_date) / 30.436875) as duration from project_m_hdr a where a.project_m_hdr_id ="' . $project_id . '"')->row_array(); ?>
                            <?php $getProject = $this->db->query('select project_name, project_description from master_project where master_project_id = "' . $query['master_project_id'] . '"')->row_array(); ?>
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
                                                <h3><?php echo $query['progress_project'] ?>%</h3>

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
                                                <h3><?php echo $query['progress_kajian'] ?>%</h3>

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
                                    <h5 class="card-title">Time</h5>

                                    <table class="table table-responsive">


                                        <tr>
                                            <th>
                                                Target Start (Date)
                                            </th>
                                            <td><?php echo tgl_indo($query['start_date']); ?></td>
                                        </tr>
                                        <tr>
                                            <th>
                                                Target End (Date)
                                            </th>
                                            <td><?php echo tgl_indo($query['end_date']); ?></td>
                                        </tr>
                                        <tr>
                                            <th>
                                                Duration (Mth)
                                            </th>
                                            <td><?php echo number_format_decimal($query['duration']); ?> Months</td>
                                        </tr>

                                    </table>
                                </div>
                            </div><!-- /.card -->
                            <div class="card card-primary card-outline">
                                <div class="card-body">
                                    <h5 class="card-title">Target Revenue</h5>
                                    <table class="table table-responsive">
                                        <tr>
                                            <th>
                                                Revenue Target
                                            </th>
                                            <td><?php echo rupiah_format($query['revenue_target']); ?></td>
                                        </tr>
                                        <tr>
                                            <th>
                                                Revenue Realization
                                            </th>
                                            <td><?php echo rupiah_format($query['revenue_realization']); ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div><!-- /.card -->
                        </div>
                        <!-- /.col-md-6 -->
                        <div class="col-lg-6">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="card-title m-0">Project Picture</h5>
                                        </div>
                                        <div class="card-body">
                                            <img src="<?php echo base_url('') . 'gambar/' . $getDtlProjectHdr['foto'] ?>" width="300px" height="150px" alt="" srcset="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="card card-primary card-outline">
                                        <div class="card-header">
                                            <h5 class="card-title m-0">Project Description</h5>
                                        </div>
                                        <div class="card-body">
                                            <p class="card-text"><?php echo $getProject['project_description'] ?></php>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="card card-primary card-outline">
                                        <div class="card-header">
                                            <h5 class="card-title m-0">Project Information</h5>
                                        </div>
                                        <div class="card-body">
                                            <?php $queryInformation_cons = $this->db->query('select * from project_information where master_project_id = "' . $query['master_project_id'] . '" and kind_of_consultant = "Consultant" order by master_project_id asc') ?>
                                            <?php $queryInformation_mit = $this->db->query('select * from project_information where master_project_id = "' . $query['master_project_id'] . '" and kind_of_consultant = "Mitra" order by master_project_id asc') ?>
                                            <div class="title">
                                                <small>Consultant List</small>
                                            </div>
                                            <table class="table table-responsive">

                                                <?php $no = 0;
                                                foreach ($queryInformation_cons->result() as $row) { ?>
                                                    <tr>
                                                        <th>
                                                            Consultant <?php echo ++$no; ?> Name
                                                        </th>
                                                        <td><?php echo $row->consultant_name; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>
                                                            Contract Value
                                                        </th>
                                                        <td><?php echo rupiah_format($row->contract_price); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>
                                                            Termyn Value
                                                        </th>
                                                        <td><?php echo $row->termyn_value; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>
                                                            Payed
                                                        </th>
                                                        <td><?php echo rupiah_format($row->payed); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>
                                                            Consultant Time
                                                        </th>
                                                        <td><?php echo $row->waktu_konsultan_mitra; ?></td>
                                                    </tr>
                                                <?php } ?>
                                            </table>
                                            <div class="title">
                                                <small>Mitra/Calon Mitra</small>
                                            </div>
                                            <table class="table table-responsive">

                                                <?php $no = 0;
                                                foreach ($queryInformation_mit->result() as $row) { ?>
                                                    <tr>
                                                        <th>
                                                            Mitra/Calon Mitra <?php echo ++$no; ?>
                                                        </th>
                                                        <td><?php echo $row->consultant_name; ?></td>
                                                        <td><?php echo $row->waktu_konsultan_mitra; ?></td>
                                                    </tr>

                                                <?php } ?>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.col-md-6 -->
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Risk Mitigation </h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="projectMaster" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Risk Profile</th>
                                                <th>Mitigation</th>
                                                <th>Checklist</th>
                                            </tr>
                                        </thead>
                                        <?php $qu = $this->db->query('select * from risk_mitigation where master_project_id ="' . $query['master_project_id'] . '"')->result(); ?>
                                        <tbody>
                                            <?php $no = 0;
                                            foreach ($qu as $row) { ?>
                                                <tr>
                                                    <td><?php echo ++$no; ?></td>
                                                    <td><?php echo $row->risk_profile; ?></td>
                                                    <td><?php echo $row->mitigation; ?></td>
                                                    <td><?php echo $row->checklist == 1 ? "<li class='far fa-check-circle'></li>" : ($row->checklist == 0 ? "<li class='fas fa-times'></li>" : ""); ?></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Issue/Problems </h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="projectMaster" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Issue/Problems/Arahan Direksi</th>
                                                <th>Tindak Lanjut</th>
                                                <th>PIC</th>
                                            </tr>
                                        </thead>
                                        <?php $qu = $this->db->query('select * from issue_problem a inner join pic_project_dtl b on b.pic_project_dtl_id = a.pic_project_dtl_id where a.master_project_id = ' . $query['master_project_id'])->result(); ?>
                                        <tbody>
                                            <?php $no = 0;
                                            foreach ($qu as $row) { ?>
                                                <tr>
                                                    <td><?php echo ++$no; ?></td>
                                                    <td><?php echo $row->problem; ?></td>
                                                    <td><?php echo $row->solution; ?></td>
                                                    <td><?php echo $row->pic_project_name; ?></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Project Details List</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="projectMaster" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Project Name</th>
                                                <th>Project activity</th>
                                                <th>PIC Project Name</th>
                                                <th>Date Line</th>
                                                <th>Progress</th>
                                                <th>Remarks</th>
                                            </tr>
                                        </thead>
                                        <?php $qu = $this->db->query('select project_m_dtl_id, project_name, project_activity, pic_project_name, dateline, progress, ket from v_project_m_dtl order by project_m_dtl_id desc')->result(); ?>
                                        <tbody>
                                            <?php $no = 0;
                                            foreach ($qu as $row) { ?>
                                                <tr>
                                                    <td><?php echo ++$no; ?></td>
                                                    <td><?php echo $row->project_name; ?></td>
                                                    <td><?php echo $row->project_activity; ?></td>
                                                    <td><?php echo $row->pic_project_name; ?></td>
                                                    <td><?php echo $row->dateline; ?></td>
                                                    <td><?php echo $row->progress; ?></td>
                                                    <td><?php echo $row->ket; ?></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>
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