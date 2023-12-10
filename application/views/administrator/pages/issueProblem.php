<script>
    function updateTable() {
        table.ajax.reload(null, false);
    }

    $(document).ready(function() {
        table = $('#projectMaster').DataTable({
            "processing": true,
            "serverSide": true,
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            "responsive": true,
            "dataType": 'JSON',
            "ajax": {
                "url": "<?php echo site_url('administrator/issueProblem/getAllData') ?>",
                "type": "POST",
                "data": {
                    '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
                }
            },
            "order": [
                [0, "desc"]
            ],
            "columnDefs": [{
                "targets": [0],
                "className": "center"
            }]
        });
    });

    var save_method;
    var save_method_role;
    var save_method_login;


    // Start Method add

    function add() {
        save_method_role = 'add';
        $('.modal-title').text(' Add Data Issue Problem');
        $('.reset-btn').show();
        $('.form-group')
            .removeClass('has-error')
            .removeClass('has-success')
            .find('#text-error')
            .remove();
        $('#modalMasterProject').modal('show');
    }

    // End method add

    // Start Method Update


    function updateData(id) {
        save_method_role = 'update';
        $('#formMasterProject')[0].reset();

        //Load data dari ajax
        $.ajax({
            url: "<?php echo base_url('administrator/issueProblem/getById/'); ?>" + id,
            type: "GET",
            dataType: "JSON",
            success: function(resp) {
                data = resp.data
                $('[name="issue_problem_id"]').val(data.issue_problem_id);
                $('[name="problem"]').val(data.problem);
                $('[name="solution"]').val(data.solution);
                $('[name="pic_project_dtl_id"]').val(data.pic_project_dtl_id);
                $('[name="master_project_id"]').val(data.master_project_id);
                $('[name="status"]').val(data.status);
                $('#modalMasterProject').modal('show');
                $('.modal-title').text('Edit Data Issue Problem');
                // console.log(data.user_role_id);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error Get Data From Ajax');
            }
        });
    }



    // End Method Update

    // Start Method delete

    function deleteData(id) {
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
                    url: "<?php echo site_url('administrator/issueProblem/delete'); ?>/" + id,
                    type: "POST",
                    data: {
                        '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
                    },
                    dataType: "JSON",
                    success: function(resp) {
                        data = resp.result;
                        updateTable();
                        return swal({
                            html: true,
                            timer: 1300,
                            title: data['msg'],
                            icon: data['status']
                        });
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert('Error Deleting Data');
                    }
                });
            } else {
                return swal({
                    title: 'Cancelled...',
                    content: true,
                    timer: 1300,
                    icon: 'warning'
                });
            }
        });
    }
    // End Method delete

    var csrf_name = '<?php echo $this->security->get_csrf_token_name(); ?>'
    var csrf_hash = ''


    function save() {
        var url;
        if (save_method_role == 'add') {
            url = '<?php echo base_url() ?>administrator/issueProblem/insert';
        } else {
            url = '<?php echo base_url() ?>administrator/issueProblem/update';
        }

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
                            updateTable();
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
                            html: true,
                            timer: 1300,
                            title: data['msg'],
                            icon: data['status']
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

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Issue Problem List</h3>
                        <div class="text-right">
                            <button onclick="add()" class="btn btn-primary btn-sm">
                                <li class="fas fa-plus"></li> Add Data
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="projectMaster" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Project Name</th>
                                    <th>Problem</th>
                                    <th>Solution</th>
                                    <th>PIC</th>
                                    <th>Status</th>
                                    <th>Tools</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="modalMasterProject" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-horizontal" id="formMasterProject" action="" method="POST">
                <div class="modal-body">
                    <input type="hidden" name='issue_problem_id' value="" id='issue_problem_id'>
                    <div class="item form-group">
                        <label class="control-label col-md-12 col-sm-3 col-xs-12">Project Name<span class="required">*</span>
                        </label>
                        <div class="col-md-12 col-sm-9 col-xs-12">
                            <select name="master_project_id" id="master_project_id" class="form-control">
                                <option value="">Select Project</option>
                                <?php foreach ($getMasterProject as $row) { ?>
                                    <option value="<?php echo $row->master_project_id ?>"><?php echo $row->project_name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-12 col-sm-3 col-xs-12">Problem <span class="required">*</span>
                        </label>
                        <div class="col-md-12 col-sm-9 col-xs-12">
                            <input type="text" id="problem" name="problem" placeholder="Problem" required="required" class="form-control ">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-12 col-sm-3 col-xs-12">Solution<span class="required">*</span>
                        </label>
                        <div class="col-md-12 col-sm-9 col-xs-12">
                            <input type="text" id="solution" name="solution" placeholder="Solution" required="required" class="form-control ">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-12 col-sm-3 col-xs-12">Status<span class="required">*</span>
                        </label>
                        <div class="col-md-12 col-sm-9 col-xs-12">
                            <select name="status" id="status" class="form-control">
                                <option value="">Select Status</option>
                                <option value="completed">Completed</option>
                                <option value="pending">Pending</option>
                                <option value="progress">In Progress</option>
                            </select>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-12 col-sm-3 col-xs-12">PIC Project<span class="required">*</span>
                        </label>
                        <div class="col-md-12 col-sm-9 col-xs-12">
                            <select name="pic_project_dtl_id" id="pic_project_dtl_id" class="form-control">
                                <option value="">Select PIC</option>
                                <?php foreach ($getPICDetail as $row) { ?>
                                    <option value="<?php echo $row->pic_project_dtl_id ?>"><?php echo $row->pic_project_name ?></option>
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