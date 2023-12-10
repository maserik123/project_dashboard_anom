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
                "url": "<?php echo site_url('administrator/projectHeader/getAllData') ?>",
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
        $('.modal-title').text(' Add Data Projects');
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
            url: "<?php echo base_url('administrator/projectHeader/getById/'); ?>" + id,
            type: "GET",
            dataType: "JSON",
            success: function(resp) {
                data = resp.data
                $('[name="project_m_hdr_id"]').val(data.project_m_hdr_id);
                $('[name="master_project_id"]').val(data.master_project_id);
                $('[name="pic_project_hdr_id"]').val(data.pic_project_hdr_id);
                $('[name="criteria_project_id"]').val(data.criteria_project_id);
                $('[name="start_date"]').val(data.start_date);
                $('[name="end_date"]').val(data.end_date);
                $('[name="capex_budget"]').val(data.capex_budget);
                $('[name="capex_realization"]').val(data.capex_realization);
                $('[name="contract_value"]').val(data.contract_value);
                $('[name="revenue_target"]').val(data.revenue_target);
                $('[name="revenue_realization"]').val(data.revenue_realization);
                $('[name="project_status_id"]').val(data.project_status_id);
                $('[name="progress_kajian"]').val(data.progress_kajian);
                $('[name="progress_fisik"]').val(data.progress_fisik);
                // $('[name="criteria_project_name"]').val(data.criteria_project_name);
                $('#modalMasterProject').modal('show');
                $('.modal-title').text('Edit Data Master Project');
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
                    url: "<?php echo site_url('administrator/projectHeader/delete'); ?>/" + id,
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
            url = '<?php echo base_url() ?>administrator/projectHeader/insert';
        } else {
            url = '<?php echo base_url() ?>administrator/projectHeader/update';
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

    function updateFoto(id) {
        //Load data dari ajax
        $.ajax({
            url: "<?php echo base_url('administrator/listLaptop/getById/'); ?>" + id,
            type: "GET",
            dataType: "JSON",
            success: function(resp) {
                data = resp.data
                $('[name="id_list_laptop"]').val(data.list_laptop_id);

                $('#modal_foto').modal('show');
                $('.modal-title').text('Upload Foto');

                // console.log(data.user_role_id);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error Get Data From Ajax');
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
                        <h3 class="card-title">Project Header List</h3>
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
                                    <th>Tools</th>
                                    <th>Project Name</th>
                                    <th>PIC Project</th>
                                    <th>Criteria/Type Name</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Duration</th>
                                    <th>Capex Budget</th>
                                    <th>Capex Realization</th>
                                    <th>Contract Value</th>
                                    <th>Revenue Target</th>
                                    <th>Revenue Realization</th>
                                    <th>Status</th>
                                    <th>Progress Project</th>
                                    <th>Progress Fisik</th>
                                    <th>Progress Kajian</th>
                                    <th>Mitigation</th>
                                    <th>Checklist</th>
                                    <th>Update Status</th>
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
<div id="modal_foto" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Update Foto</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <div style="text-align: right;color:blue">
                </div>
            </div>
            <?php echo form_open('administrator/listLaptop/uploadFoto', array('id' => 'form_foto', 'method' => 'post',  'enctype' => 'multipart/form-data')) ?>
            <div class="modal-body">
                <input type="hidden" id="id_list_laptop" value="" name="id_list_laptop">
                <fieldset>
                    <div class="control-group form-group">
                        <label class="control-label span4">Update Foto<small class="required">(Optional)</small></label>
                        <div class="controls">
                            <input name="foto" id="foto" class="span3" type="file" autocomplete="false">
                        </div>
                    </div>
                </fieldset>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <!-- <button type="reset" class="btn btn-warning">Reset</button> -->
                <button type="submit" class="btn btn-primary"><i class="icon-save"></i> Simpan</button>

            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>
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
                    <input type="hidden" name='project_m_hdr_id' value="" id='project_m_hdr_id'>
                    <div class="item form-group">
                        <label class="control-label col-md-12 col-sm-3 col-xs-12"> Project Name <span class="required">*</span>
                        </label>
                        <div class="col-md-12 col-sm-9 col-xs-12">
                            <select name="master_project_id" id="master_project_id" class="form-control">
                                <option value="">Select Project</option>
                                <?php foreach ($getMasterProject as $row) { ?>
                                    <option value="<?php echo $row->master_project_id; ?>"><?php echo $row->project_name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-12 col-sm-3 col-xs-12"> PIC Project <span class="required">*</span>
                        </label>
                        <div class="col-md-12 col-sm-9 col-xs-12">
                            <select name="pic_project_hdr_id" id="pic_project_hdr_id" class="form-control">
                                <option value="">Select PIC</option>
                                <?php foreach ($getPICProject as $row) { ?>
                                    <option value="<?php echo $row->pic_project_hdr_id; ?>"><?php echo $row->pic_project_name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <!-- <div class="item form-group">
                        <label class="control-label col-md-12 col-sm-3 col-xs-12"> Criteria Project <span class="required">*</span>
                        </label>
                        <div class="col-md-12 col-sm-9 col-xs-12">
                            <select name="criteria_project_id" id="criteria_project_id" class="form-control">
                                <option value="">Select PIC</option>
                                <?php foreach ($getProjectCriteria as $row) { ?>
                                    <option value="<?php echo $row->criteria_project_id; ?>"><?php echo $row->criteria_project_name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div> -->
                    <div class="item form-group">
                        <label class="control-label col-md-12 col-sm-3 col-xs-12"> Start Date <span class="required">*</span>
                        </label>
                        <div class="col-md-12 col-sm-9 col-xs-12">
                            <input type="date" id="start_date" name="start_date" placeholder="Start Date" required="required" class="form-control ">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-12 col-sm-3 col-xs-12"> End Date <span class="required">*</span>
                        </label>
                        <div class="col-md-12 col-sm-9 col-xs-12">
                            <input type="date" id="end_date" name="end_date" placeholder="End Date" required="required" class="form-control ">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-12 col-sm-3 col-xs-12"> Capex Budget <span class="required">*</span>
                        </label>
                        <div class="col-md-12 col-sm-9 col-xs-12">
                            <input type="number" id="capex_budget" name="capex_budget" placeholder="Capex Budget" required="required" class="form-control ">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-12 col-sm-3 col-xs-12"> Capex Realization <span class="required">*</span>
                        </label>
                        <div class="col-md-12 col-sm-9 col-xs-12">
                            <input type="number" id="capex_realization" name="capex_realization" placeholder="Capex Realization" required="required" class="form-control ">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-12 col-sm-3 col-xs-12"> Contract Value <span class="required">*</span>
                        </label>
                        <div class="col-md-12 col-sm-9 col-xs-12">
                            <input type="number" id="contract_value" name="contract_value" placeholder="Contract Value" required="required" class="form-control ">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-12 col-sm-3 col-xs-12"> Revenue target <span class="required">*</span>
                        </label>
                        <div class="col-md-12 col-sm-9 col-xs-12">
                            <input type="number" id="revenue_target" name="revenue_target" placeholder="Revenue Target" required="required" class="form-control ">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-12 col-sm-3 col-xs-12"> Revenue Realization <span class="required">*</span>
                        </label>
                        <div class="col-md-12 col-sm-9 col-xs-12">
                            <input type="number" id="revenue_realization" name="revenue_realization" placeholder="Revenue Realization" required="required" class="form-control ">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-12 col-sm-3 col-xs-12"> Progress Fisik <span class="required">*</span>
                        </label>
                        <div class="col-md-12 col-sm-9 col-xs-12">
                            <input type="number" id="progress_fisik" name="progress_fisik" placeholder="progress fisik" required="required" class="form-control ">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-12 col-sm-3 col-xs-12"> Progress Kajian <span class="required">*</span>
                        </label>
                        <div class="col-md-12 col-sm-9 col-xs-12">
                            <input type="number" id="progress_kajian" name="progress_kajian" placeholder="progress kajian" required="required" class="form-control ">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-12 col-sm-3 col-xs-12">Project Status <span class="required">*</span>
                        </label>
                        <div class="col-md-12 col-sm-9 col-xs-12">
                            <select name="project_status_id" id="project_status_id" class="form-control">
                                <option value="">Selet Project Status</option>
                                <?php foreach ($getProjectStatus as $row) { ?>
                                    <option value="<?php echo $row->project_status_id; ?>"><?php echo $row->status_name; ?></option>
                                <?php } ?>
                            </select>
                            <!-- <input type="text" id="project_status_id" name="project_status_id" placeholder="Status" required="required" class="form-control "> -->
                        </div>
                    </div>
                    <!-- <div class="item form-group">
                        <label class="control-label col-md-12 col-sm-3 col-xs-12"> Progress <span class="required">*</span>
                        </label>
                        <div class="col-md-12 col-sm-9 col-xs-12">
                            <input type="text" id="progress" name="progress" placeholder="Progress" required="required" class="form-control ">
                        </div>
                    </div> -->
                    <!-- <div class="item form-group">
                        <label class="control-label col-md-12 col-sm-3 col-xs-12"> Update Status <span class="required">*</span>
                        </label>
                        <div class="col-md-12 col-sm-9 col-xs-12">
                            <input type="text" id="update_status" name="update_status" placeholder="Update Status" required="required" class="form-control ">
                        </div>
                    </div> -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="save()">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>