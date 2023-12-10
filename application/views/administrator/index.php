<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $title; ?></title>

    <?php include 'components/css.php'; ?>
</head>

<!-- <body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed"> -->

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <script type="text/javascript">
            function logout() {
                swal({
                    title: "Apakah anda sudah yakin ?",
                    icon: "warning",
                    buttons: {
                        cancel: true,
                        confirm: true,
                    },
                }).then((result) => {
                    if (result == true) {
                        $.ajax({
                            url: "<?php echo site_url('auth/logout'); ?>",
                            type: "POST",
                            dataType: "JSON",
                            data: {
                                '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
                            },
                            success: function(data) {
                                $url = '<?php echo base_url('/auth/') ?>';
                                setTimeout(() => {
                                    $(location).attr('href', $url)
                                }, 1400);
                                return swal({
                                    html: true,
                                    timer: 1300,
                                    showConfirmButton: false,
                                    title: data['msg'],
                                    icon: data['status']
                                });
                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                                alert('Error to Log out, check the connection or configuration !');
                            }
                        });
                    } else {
                        return swal({
                            title: 'Transaksi telah dibatalkan !',
                            content: true,
                            timer: 1300,
                            icon: 'warning'
                        });
                    }
                });
            }
        </script>
        <!-- Preloader -->
        <!-- <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__wobble" src="<?php echo base_url('assets/') ?>dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
        </div> -->

        <!-- Navbar -->
        <?php include 'components/navbar.php' ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php include 'components/sidebar.php'; ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Projects Monitoring </h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Dashboard v2</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <?php include 'pages/' . $pageName . '.php'; ?>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->

        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <?php include 'components/footer.php'; ?>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->
    <?php include 'components/script.php'; ?>
</body>

</html>