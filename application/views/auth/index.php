<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Log in</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url('assets') ?>/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?php echo base_url('assets') ?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url('assets') ?>/dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="https://www.arniuc.com"><b>Project Monitoring Dashboard</a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Login Form</p>

                <?php echo form_open("Auth/", array('method' => 'POST', 'class' => 'form-vertical user')); ?>
                <div class="form-group">
                    <input type="text" name="username" class="form-control" id="username" placeholder="Username" />
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control" id="password" placeholder="Password" />
                </div>
                <label class="text-left">
                    <?php
                    $message = $this->session->flashdata('result_login');
                    if ($message) { ?>
                        <div style="color: red;"><?php echo $message; ?></div>
                    <?php } ?>
                </label>


                <div class="form-actions">
                    <!-- <span class="pull-left"><a href="#" class="flip-link btn btn-info" id="to-recover">Lost password?</a></span> -->
                    <span class="pull-right"><button type="submit" class="btn btn-user btn-block btn-success" />
                        Masuk Disini </a></span>
                    <!-- <span class="pull-right"><button type="button" onclick="regis()" class="btn btn-user btn-block btn-danger" />
                        Daftar Akun </a></span> -->
                </div>
                <?php echo form_close(); ?>


            </div>
            <!-- /.login-card-body -->
        </div>
    </div>

    <div class="modal fade" id="modalRegis" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="form-horizontal" id="formMasterProject" action="" method="POST">
                    <div class="modal-body">
                        <input type="hidden" name='userid' value="" id='userid'>
                        <div class="item form-group">
                            <label class="control-label col-md-12 col-sm-3 col-xs-12">Full Name <span class="required">*</span>
                            </label>
                            <div class="col-md-12 col-sm-9 col-xs-12">
                                <input type="text" name="full_name" id="full_name" class="form-control">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-12 col-sm-3 col-xs-12">Email <span class="required">*</span>
                            </label>
                            <div class="col-md-12 col-sm-9 col-xs-12">
                                <input type="text" name="email" id="email" class="form-control">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-12 col-sm-3 col-xs-12">Phone Number <span class="required">*</span>
                            </label>
                            <div class="col-md-12 col-sm-9 col-xs-12">
                                <input type="text" name="phone_number" id="phone_number" class="form-control">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-12 col-sm-3 col-xs-12">Username <span class="required">*</span>
                            </label>
                            <div class="col-md-12 col-sm-9 col-xs-12">
                                <input type="text" name="username" id="username" class="form-control">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-12 col-sm-3 col-xs-12">Password <span class="required">*</span>
                            </label>
                            <div class="col-md-12 col-sm-9 col-xs-12">
                                <input type="password" name="password" id="password" class="form-control">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-12 col-sm-3 col-xs-12">User Role <span class="required">*</span>
                            </label>
                            <div class="col-md-12 col-sm-9 col-xs-12">
                                <select name="user_role_id" id="user_role_id" class="form-control">
                                    <?php $query = $this->db->query('select * from user_role');
                                    foreach ($query->result() as $row) { ?>
                                        <option value="<?php echo $row->user_role_id; ?>"><?php echo $row->role; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="save()">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="<?php echo base_url('assets') ?>/plugins/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url('assets') ?>/plugins/sweetalert/sweetalert.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?php echo base_url('assets') ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url('assets') ?>/dist/js/adminlte.min.js"></script>

    <script>
        function regis() {
            save_method_role = 'add';
            $('.modal-title').text(' Registration ');
            $('.reset-btn').show();
            $('.form-group')
                .removeClass('has-error')
                .removeClass('has-success')
                .find('#text-error')
                .remove();
            $('#modalRegis').modal('show');
        }

        function save() {
            var url;
            url = '<?php echo base_url() ?>auth/registrasi';
            swal({
                title: "Are you sure ?",
                icon: "warning",
                buttons: {
                    cancel: true,
                    confirm: true,
                },
            }).then((result) => {
                if (result == true) {
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: $('#formMasterProject').serialize(),
                        dataType: "JSON",
                        success: function(resp) {
                            data = resp.result;
                            // csrf_hash = resp.csrf['token']
                            // $('#add-form input[name=' + csrf_name + ']').val(csrf_hash);
                            if (data['status'] == 'success') {
                                // updateTable();
                                $('.form-group')
                                    .removeClass('has-error')
                                    .removeClass('has-success')
                                    .find('#text-error')
                                    .remove();
                                $('#modalMasterProject').modal('hide');
                                $("#formMasterProject")[0].reset();

                            } else {
                                $.each(data['messages'], function(key, value) {
                                    var element = $('#' + key);
                                    element
                                        .closest('div.form-group')
                                        .removeClass('has-error')
                                        .addClass(
                                            value.length > 0 ?
                                            'has-error' :
                                            'has-success'
                                        )
                                        .find('#text-error')
                                        .remove();
                                    element.after(value);
                                });
                            }
                            return swal({
                                title: 'Success...',
                                content: true,
                                icon: 'success',
                                html: true,
                                timer: 1300,
                            });
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            alert('Error adding/updating data');
                        }
                    });
                } else {
                    return swal({
                        title: 'Cancelled..',
                        content: true,
                        timer: 1300,
                        icon: 'warning'
                    });
                }
            });
        }
    </script>
</body>

</html>