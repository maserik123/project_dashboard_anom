<?php
defined('BASEPATH') or exit('No direct script access allowed');

// PT Arniuz Global Asia, Arniuz Software Technology, www.arniuz.com, contact : arniuz.globala@gmail.com
class Administrator extends CI_Controller
{

    public function index()
    {
        if (!$this->session->userdata('loggedIn')) {
            $this->session->set_flashdata('result_login', 'Silahkan Log in untuk mengakses sistem !');
            redirect('/auth/');
        } else {
            $view['title'] = 'Home Page';
            $view['pageName'] = 'dashboard';
            $view['a_dashboard'] = 'active';
            $view['yearNow'] = date('Y');
            $view['projectActiveMore30Day'] = $this->db->query("SELECT COUNT(*) as total FROM project_m_hdr WHERE DATEDIFF(end_date, CURRENT_DATE()) > 30 and year(update_date) = '" . date('Y') . "'")->row_array();
            $view['projectActiveMin30Day'] = $this->db->query("SELECT COUNT(*) as total FROM project_m_hdr WHERE DATEDIFF(end_date, CURRENT_DATE()) < 30 and year(update_date) = '" . date('Y') . "'")->row_array();
            $view['projectActive2Week'] = $this->db->query("SELECT COUNT(*)as total  FROM project_m_hdr WHERE DATEDIFF(end_date, CURRENT_DATE()) <= 14 and year(update_date) = '" . date('Y') . "'")->row_array();
            $view['projectActive1Week'] = $this->db->query("SELECT COUNT(*) as total FROM project_m_hdr WHERE DATEDIFF(end_date, CURRENT_DATE()) <= 7 and year(update_date) = '" . date('Y') . "'")->row_array();
            $view['projectFinish100'] = $this->db->query("(SELECT COUNT(*) as total FROM project_m_hdr a WHERE a.master_project_id = 10 AND (SELECT (SUM(progress)/COUNT(master_project_id)) AS progress FROM project_m_dtl WHERE master_project_id = a.master_project_id) = 100 and year(update_date) = '" . date('Y') . "')")->row_array();
            $view['projectProgressMore50'] = $this->db->query("(SELECT COUNT(*) as total FROM project_m_hdr a WHERE a.master_project_id = 10 AND (SELECT (SUM(progress)/COUNT(master_project_id)) AS progress FROM project_m_dtl WHERE master_project_id = a.master_project_id) >= 50 and year(update_date) = '" . date('Y') . "' )")->row_array();
            $view['projectProgressMin50'] = $this->db->query("(SELECT COUNT(*) as total FROM project_m_hdr a WHERE a.master_project_id = 10 AND (SELECT (SUM(progress)/COUNT(master_project_id)) AS progress FROM project_m_dtl WHERE master_project_id = a.master_project_id) <= 50 and year(update_date) = '" . date('Y') . "')")->row_array();
            $view['getCriteria'] = $this->db->query("select * from criteria_project order by criteria_project_id asc")->result();

            $this->load->view('administrator/index', $view);
        }
    }

    function dashboard_detail($project_id = '')
    {
        $view['title'] = 'Detail Dashboard Page';
        $view['pageName'] = 'Detail Dashboard';
        $view['project_id'] = $project_id;
        $this->load->view('administrator/pages/dashboard_detail', $view);
    }

    function projectHeader($param = '', $id = '')
    {
        if (empty($param)) {
            $view['title'] = 'ADMoni - Projects Header';
            $view['pageName'] = 'projectHeader';
            $view['a_projectHeader'] = 'active';
            $view['getMasterProject'] = $this->Model_ProjectMaster->getData();
            $view['getPICProject'] = $this->Model_ProjectPICHeader->getData();
            $view['getProjectCriteria'] = $this->Model_ProjectCriteria->getData();
            $view['getProjectStatus'] = $this->Model_ProjectStatus->getData();
            $this->load->view('administrator/index', $view);
        } else if ($param == 'getAllData') {
            $dt = $this->Model_ProjectHeader->getAllData();
            $start = $this->input->post('start');
            $data = array();
            foreach ($dt['data'] as $row) {
                $userid     = ($row->project_m_hdr_id);
                $th1    = '<div class="text-center">' . ++$start . '</div>';
                $th2   = '<div class="text-center" style="width:100px;">' . get_btn_edit('updateFoto(' . $userid . ')') . (get_btn_group1('updateData(' . $userid . ')', 'deleteData(' . $userid . ')')) . '</div>';
                $th3    = '<div class="text-center">' . $row->project_name . '</div>';
                $th4    = '<div class="text-center">' . $row->pic_project_name . '</div>';
                $th5    = '<div class="text-center">' . $row->criteria_project_name . '</div>';
                $th6    = '<div class="text-center">' . $row->start_date . '</div>';
                $th7    = '<div class="text-center">' . $row->end_date . '</div>';
                $th8    = '<div class="text-center">' . number_format_decimal($row->duration) . '</div>';
                $th9    = '<div class="text-center">' . $row->capex_budget . '</div>';
                $th10    = '<div class="text-center">' . $row->capex_realization . '</div>';
                $th11    = '<div class="text-center">' . $row->contract_value . '</div>';
                $th12    = '<div class="text-center">' . $row->revenue_target . '</div>';
                $th13    = '<div class="text-center">' . $row->revenue_realization . '</div>';
                $th14    = '<div class="text-center">' . $row->status_name . '</div>';
                $th15    = '<div class="text-center">' . $row->progress_project . '</div>';
                $th16    = '<div class="text-center">' . $row->progress_fisik . '</div>';
                $th17    = '<div class="text-center">' . $row->progress_kajian . '</div>';
                $th18    = '<div class="text-center">' . $row->mitigation . '</div>';
                $th19    = '<div class="text-center">' . $row->checklist . '</div>';
                $th20    = '<div class="text-center">' . $row->update_status . '</div>';
                $data[] = gathered_data(array($th1, $th2, $th3, $th4, $th5, $th6, $th7, $th8, $th9, $th10, $th11, $th12, $th13, $th14, $th15, $th16, $th17, $th18, $th19, $th20));
            }
            $dt['data'] = $data;
            echo json_encode($dt);
            die;
        } else if ($param == 'getDataDashboard') {
            $dt = $this->Model_ProjectHeader->getAllData();
            $start = $this->input->post('start');
            $data = array();
            foreach ($dt['data'] as $row) {
                $userid     = ($row->project_m_hdr_id);
                $th1    = '<div class="text-center">' . ++$start . '</div>';
                $th2   = '<div class="text-center" style="width:100px;">' . (get_btn_detail('detail_dashboard(' . $userid . ')')) . '</div>';
                $th3    = '<div class="text-center">' . $row->project_name . '</div>';
                $th4    = '<div class="text-center">' . $row->pic_project_name . '</div>';
                $th5    = '<div class="text-white badge" style="background-color:' . $row->criteria_color . ';color:white;">' . $row->criteria_project_name . '</div>';
                $th6    = '<div class="text-center">' . tgl_indo($row->start_date) . '</div>';
                $th7    = '<div class="text-center">' . tgl_indo($row->end_date) . '</div>';
                $th8    = '<div class="text-center">' . rupiah_format($row->capex_budget) . '</div>';
                $th9    = '<div class="text-center">' . rupiah_format($row->contract_value) . '</div>';
                $th10    = '<div class="text-white badge" style="background-color:' . $row->status_color . '">' . $row->status_name . '</div>';
                $th11    = ($row->progress_project == '' || empty($row->progress_project) || $row->progress_project == null) ? '0 %' : $row->progress_project . '%';
                $th12    = '<div class="text-white badge" style="background-color:' . $row->color_update_status . '">' . $row->update_status . '</div>';
                $data[] = gathered_data(array($th1, $th2, $th3, $th4, $th5, $th6, $th7, $th8, $th9, $th10, $th11, $th12));
            }
            $dt['data'] = $data;
            echo json_encode($dt);
            die;
        } else if ($param == 'uploadFoto') {
            if (isset($_FILES['foto']['size']) != 0) {
                $config['upload_path']   = 'gambar';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size']      = '2048';
                $new_name        = time() . $_FILES["foto"]['name'];
                $config['file_name']     = str_replace(array('-', ' '), '_', $new_name);
                $data['project_m_hdr_id']            = $this->input->post('project_m_hdr_id');
                $data['foto']       = str_replace(array('-', ' '), '_', $new_name);
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('foto')) {
                    $this->session->set_flashdata('error', 'Foto gagal diupload. ' . $this->upload->display_errors());
                    redirect('administrator/projectHeader');
                } else {
                    $this->Model_ProjectHeader->updateFoto($data['project_m_hdr_id'], 'foto', $data['foto']);
                    $this->session->set_flashdata('success', 'Gambar berhasil diupload!' . $this->upload->display_errors());
                    redirect('administrator/projectHeader');
                }
            }
        } else if ($param == 'insert') {
            $this->form_validation->set_rules("master_project_id", "Project Name", "trim|required", array('required' => '{field} cannot be null !'));
            $this->form_validation->set_rules("pic_project_hdr_id", "Project PIC", "trim|required", array('required' => '{field} cannot be null !'));
            // $this->form_validation->set_rules("criteria_project_id", "Project Criteria", "trim|required", array('required' => '{field} cannot be null !'));
            $this->form_validation->set_rules("start_date", "Start Data", "trim|required", array('required' => '{field} cannot be null !'));
            $this->form_validation->set_rules("end_date", "End Date", "trim|required", array('required' => '{field} cannot be null !'));
            $this->form_validation->set_rules("capex_budget", "Capex Budget", "trim|required", array('required' => '{field} cannot be null !'));
            $this->form_validation->set_rules("capex_realization", "Capex Realization", "trim|required", array('required' => '{field} cannot be null !'));
            $this->form_validation->set_rules("contract_value", "Contract Value", "trim|required", array('required' => '{field} cannot be null !'));
            $this->form_validation->set_rules("revenue_target", "Revenue target", "trim|required", array('required' => '{field} cannot be null !'));
            $this->form_validation->set_rules("revenue_realization", "Revenue Realization", "trim|required", array('required' => '{field} cannot be null !'));
            $this->form_validation->set_rules("progress_fisik", "Progress Fisik", "trim|required", array('required' => '{field} cannot be null !'));
            $this->form_validation->set_rules("progress_kajian", "Progress Kajian", "trim|required", array('required' => '{field} cannot be null !'));
            $this->form_validation->set_rules("project_status_id", "Project Status", "trim|required", array('required' => '{field} cannot be null !'));
            $this->form_validation->set_error_delimiters('<small id="text-error" style="color:red;">* ', '</small>');
            if ($this->form_validation->run() == FALSE) {
                $result = array('status' => 'error', 'msg' => 'Data is not right, please check again.');
                foreach ($_POST as $key => $value) {
                    $result['messages'][$key] = form_error($key);
                }
            } else {
                $data = array(
                    'master_project_id'          => htmlspecialchars($this->input->post('master_project_id')),
                    'pic_project_hdr_id'          => htmlspecialchars($this->input->post('pic_project_hdr_id')),
                    // 'criteria_project_id'          => htmlspecialchars($this->input->post('criteria_project_id')),
                    'start_date'          => htmlspecialchars($this->input->post('start_date')),
                    'end_date'          => htmlspecialchars($this->input->post('end_date')),
                    'capex_budget'          => htmlspecialchars($this->input->post('capex_budget')),
                    'capex_realization'          => htmlspecialchars($this->input->post('capex_realization')),
                    'contract_value'          => htmlspecialchars($this->input->post('contract_value')),
                    'revenue_target'          => htmlspecialchars($this->input->post('revenue_target')),
                    'revenue_realization'          => htmlspecialchars($this->input->post('revenue_realization')),
                    'progress_fisik'          => htmlspecialchars($this->input->post('progress_fisik')),
                    'progress_kajian'          => htmlspecialchars($this->input->post('progress_kajian')),
                    'project_status_id'          => htmlspecialchars($this->input->post('project_status_id')),
                    'crt_date'          => date('Y-m-d'),
                    'update_date'          => date('Y-m-d'),
                );
                $result['messages'] = '';
                $result = array('status' => 'success', 'msg' => 'Data Inserted!');
                $this->Model_ProjectHeader->addData($data);
            }

            $csrf = array(
                'token' => $this->security->get_csrf_hash()
            );
            echo json_encode(array('result' => $result, 'csrf' => $csrf));
            die;
        } else if ($param == 'getById') {
            $data = $this->Model_ProjectHeader->getById($id);
            echo json_encode(array('data' => $data));
            die;
        } else if ($param == 'update') {
            $this->form_validation->set_rules("master_project_id", "Project Name", "trim|required", array('required' => '{field} cannot be null !'));
            $this->form_validation->set_rules("pic_project_hdr_id", "Project PIC", "trim|required", array('required' => '{field} cannot be null !'));
            // $this->form_validation->set_rules("criteria_project_id", "Project Criteria", "trim|required", array('required' => '{field} cannot be null !'));
            $this->form_validation->set_rules("start_date", "Start Data", "trim|required", array('required' => '{field} cannot be null !'));
            $this->form_validation->set_rules("end_date", "End Date", "trim|required", array('required' => '{field} cannot be null !'));
            $this->form_validation->set_rules("capex_budget", "Capex Budget", "trim|required", array('required' => '{field} cannot be null !'));
            $this->form_validation->set_rules("capex_realization", "Capex Realization", "trim|required", array('required' => '{field} cannot be null !'));
            $this->form_validation->set_rules("contract_value", "Contract Value", "trim|required", array('required' => '{field} cannot be null !'));
            $this->form_validation->set_rules("revenue_target", "Revenue target", "trim|required", array('required' => '{field} cannot be null !'));
            $this->form_validation->set_rules("revenue_realization", "Revenue Realization", "trim|required", array('required' => '{field} cannot be null !'));
            $this->form_validation->set_rules("progress_fisik", "Progress Fisik", "trim|required", array('required' => '{field} cannot be null !'));
            $this->form_validation->set_rules("progress_kajian", "Progress Kajian", "trim|required", array('required' => '{field} cannot be null !'));
            $this->form_validation->set_rules("project_status_id", "Project Status", "trim|required", array('required' => '{field} cannot be null !'));
            $this->form_validation->set_error_delimiters('<small id="text-error" style="color:red;">*', '</small>');
            if ($this->form_validation->run() == FALSE) {
                $result = array('status' => 'error', 'msg' => 'Data yang anda isi belum benar !');
                foreach ($_POST as $key => $value) {
                    $result['messages'][$key] = form_error($key);
                }
            } else {
                $aidi = $this->input->post('project_m_hdr_id');
                $data = array(
                    'master_project_id'          => htmlspecialchars($this->input->post('master_project_id')),
                    'pic_project_hdr_id'          => htmlspecialchars($this->input->post('pic_project_hdr_id')),
                    // 'criteria_project_id'          => htmlspecialchars($this->input->post('criteria_project_id')),
                    'start_date'          => htmlspecialchars($this->input->post('start_date')),
                    'end_date'          => htmlspecialchars($this->input->post('end_date')),
                    'capex_budget'          => htmlspecialchars($this->input->post('capex_budget')),
                    'capex_realization'          => htmlspecialchars($this->input->post('capex_realization')),
                    'contract_value'          => htmlspecialchars($this->input->post('contract_value')),
                    'revenue_target'          => htmlspecialchars($this->input->post('revenue_target')),
                    'revenue_realization'          => htmlspecialchars($this->input->post('revenue_realization')),
                    'progress_kajian'          => htmlspecialchars($this->input->post('progress_kajian')),
                    'progress_fisik'          => htmlspecialchars($this->input->post('progress_fisik')),
                    'project_status_id'          => htmlspecialchars($this->input->post('project_status_id')),
                    'update_date'          => date('Y-m-d'),
                );
                $result['messages']    = '';
                $result        = array('status' => 'success', 'msg' => 'Update Success !');
                $this->Model_ProjectHeader->update($aidi, $data);
            }
            $csrf = array(
                'token' => $this->security->get_csrf_hash()
            );
            echo json_encode(array('result' => $result, 'csrf' => $csrf));
            die;
        } else if ($param == 'delete') {
            $this->Model_ProjectHeader->delete($id);
            $result = array('status' => 'success', 'msg' => 'Success Deleted !');
            echo json_encode(array('result' => $result));
            die;
        }
    }

    function projectDetails($param = '', $id = '')
    {
        if (empty($param)) {
            $view['title'] = 'ADMoni - Projects Details';
            $view['pageName'] = 'projectDetails';
            $view['a_projectDetails'] = 'active';
            $view['getMasterProject'] = $this->Model_ProjectMaster->getData();
            $view['getPICProject'] = $this->Model_ProjectPICDetails->getData();
            $view['getProjectCriteria'] = $this->Model_ProjectCriteria->getData();
            $view['getProjectStatus'] = $this->Model_ProjectStatus->getData();
            $this->load->view('administrator/index', $view);
        } else if ($param == 'getAllData') {
            $dt = $this->Model_ProjectDetails->getAllData();
            $start = $this->input->post('start');
            $data = array();
            foreach ($dt['data'] as $row) {
                $userid     = ($row->project_m_dtl_id);
                $th1    = '<div class="text-center">' . ++$start . '</div>';
                $th2    = '<div class="text-center">' . $row->project_name . '</div>';
                $th3    = '<div class="text-center">' . $row->project_activity . '</div>';
                $th4    = '<div class="text-center">' . $row->pic_project_name . '</div>';
                $th5    = '<div class="text-center">' . $row->dateline . '</div>';
                $th6    = '<div class="text-center">' . $row->progress . '</div>';
                $th7    = '<div class="text-center">' . $row->tipe . '</div>';
                $th8    = '<div class="text-center">' . $row->ket . '</div>';
                $th9   = '<div class="text-center" style="width:100px;">' . (get_btn_group1('updateData(' . $userid . ')', 'deleteData(' . $userid . ')')) . '</div>';
                $data[] = gathered_data(array($th1, $th2, $th3, $th4, $th5, $th6, $th7, $th8, $th9));
            }
            $dt['data'] = $data;
            echo json_encode($dt);
            die;
        } else if ($param == 'insert') {
            $this->form_validation->set_rules("master_project_id", "Project Name", "trim|required", array('required' => '{field} cannot be null !'));
            $this->form_validation->set_rules("project_activity", "Project Activity", "trim|required", array('required' => '{field} cannot be null !'));
            $this->form_validation->set_rules("pic_project_dtl_id", "PIC Project", "trim|required", array('required' => '{field} cannot be null !'));
            $this->form_validation->set_rules("dateline", "Date Line", "trim|required", array('required' => '{field} cannot be null !'));
            $this->form_validation->set_rules("progress", "Progress", "trim|required", array('required' => '{field} cannot be null !'));
            $this->form_validation->set_rules("tipe", "Type", "trim|required", array('required' => '{field} cannot be null !'));
            $this->form_validation->set_rules("ket", "Keterangan", "trim|required", array('required' => '{field} cannot be null !'));
            $this->form_validation->set_error_delimiters('<small id="text-error" style="color:red;">* ', '</small>');
            if ($this->form_validation->run() == FALSE) {
                $result = array('status' => 'error', 'msg' => 'Data is not right, please check again.');
                foreach ($_POST as $key => $value) {
                    $result['messages'][$key] = form_error($key);
                }
            } else {
                $data = array(
                    'master_project_id'           => htmlspecialchars($this->input->post('master_project_id')),
                    'project_activity'            => htmlspecialchars($this->input->post('project_activity')),
                    'pic_project_dtl_id'          => htmlspecialchars($this->input->post('pic_project_dtl_id')),
                    'dateline'          => htmlspecialchars($this->input->post('dateline')),
                    'progress'          => htmlspecialchars($this->input->post('progress')),
                    'ket'               => htmlspecialchars($this->input->post('ket')),
                    'tipe'               => htmlspecialchars($this->input->post('tipe')),
                );
                $result['messages'] = '';
                $result = array('status' => 'success', 'msg' => 'Data Inserted!');
                $this->Model_ProjectDetails->addData($data);
            }

            $csrf = array(
                'token' => $this->security->get_csrf_hash()
            );
            echo json_encode(array('result' => $result, 'csrf' => $csrf));
            die;
        } else if ($param == 'getById') {
            $data = $this->Model_ProjectDetails->getById($id);
            echo json_encode(array('data' => $data));
            die;
        } else if ($param == 'update') {

            $this->form_validation->set_rules("master_project_id", "Project Name", "trim|required", array('required' => '{field} cannot be null !'));
            $this->form_validation->set_rules("project_activity", "Project Activity", "trim|required", array('required' => '{field} cannot be null !'));
            $this->form_validation->set_rules("pic_project_dtl_id", "PIC Project", "trim|required", array('required' => '{field} cannot be null !'));
            $this->form_validation->set_rules("dateline", "Date Line", "trim|required", array('required' => '{field} cannot be null !'));
            $this->form_validation->set_rules("progress", "Progress", "trim|required", array('required' => '{field} cannot be null !'));
            $this->form_validation->set_rules("ket", "Keterangan", "trim|required", array('required' => '{field} cannot be null !'));
            $this->form_validation->set_rules("tipe", "Type", "trim|required", array('required' => '{field} cannot be null !'));

            $this->form_validation->set_error_delimiters('<small id="text-error" style="color:red;">*', '</small>');
            if ($this->form_validation->run() == FALSE) {
                $result = array('status' => 'error', 'msg' => 'Data yang anda isi belum benar !');
                foreach ($_POST as $key => $value) {
                    $result['messages'][$key] = form_error($key);
                }
            } else {
                $aidi = $this->input->post('project_m_dtl_id');
                $data = array(
                    'master_project_id'           => htmlspecialchars($this->input->post('master_project_id')),
                    'project_activity'            => htmlspecialchars($this->input->post('project_activity')),
                    'pic_project_dtl_id'          => htmlspecialchars($this->input->post('pic_project_dtl_id')),
                    'dateline'          => htmlspecialchars($this->input->post('dateline')),
                    'progress'          => htmlspecialchars($this->input->post('progress')),
                    'ket'               => htmlspecialchars($this->input->post('ket')),
                    'tipe'               => htmlspecialchars($this->input->post('tipe')),
                );
                $result['messages']    = '';
                $result        = array('status' => 'success', 'msg' => 'Update Success !');
                $this->Model_ProjectDetails->update($aidi, $data);
            }
            $csrf = array(
                'token' => $this->security->get_csrf_hash()
            );
            echo json_encode(array('result' => $result, 'csrf' => $csrf));
            die;
        } else if ($param == 'delete') {
            $this->Model_ProjectDetails->delete($id);
            $result = array('status' => 'success', 'msg' => 'Success Deleted !');
            echo json_encode(array('result' => $result));
            die;
        }
    }

    function projectMaster($param = '', $id = '')
    {
        if (empty($param)) {
            $view['title'] = 'ADMoni - Projects Master';
            $view['pageName'] = 'projectMaster';
            $view['a_projectMaster'] = 'active';
            $view['getAllCriteria'] = $this->Model_ProjectCriteria->getData();
            $this->load->view('administrator/index', $view);
        } else if ($param == 'getAllData') {
            $dt = $this->Model_ProjectMaster->getAllData();
            $start = $this->input->post('start');
            $data = array();
            foreach ($dt['data'] as $row) {
                $userid     = ($row->master_project_id);
                $th1    = '<div class="text-center">' . ++$start . '</div>';
                $th2    = '<div class="text-left">' . $row->project_name . '</div>';
                $th3    = '<div class="text-center">' . $row->criteria_project_name . '</div>';
                $th4    = '<div class="text-center">' . $row->project_description . '</div>';
                $th5   = '<div class="text-center" style="width:100px;">' . (get_btn_group1('updateData(' . $userid . ')', 'deleteData(' . $userid . ')')) . '</div>';
                $data[] = gathered_data(array($th1, $th2, $th3, $th4, $th5));
            }
            $dt['data'] = $data;
            echo json_encode($dt);
            die;
        } else if ($param == 'insert') {
            $this->form_validation->set_rules("project_name", "Project Name", "trim|required", array('required' => '{field} cannot be null !'));
            $this->form_validation->set_rules("criteria_project_id", "Criteria Project", "trim|required", array('required' => '{field} cannot be null !'));
            $this->form_validation->set_rules("project_description", "Description", "trim|required", array('required' => '{field} cannot be null !'));

            $this->form_validation->set_error_delimiters('<small id="text-error" style="color:red;">* ', '</small>');
            if ($this->form_validation->run() == FALSE) {
                $result = array('status' => 'error', 'msg' => 'Data is not right, please check again.');
                foreach ($_POST as $key => $value) {
                    $result['messages'][$key] = form_error($key);
                }
            } else {
                $data = array(
                    'project_name'          => htmlspecialchars($this->input->post('project_name')),
                    'criteria_project_id'   => htmlspecialchars($this->input->post('criteria_project_id')),
                    'project_description'   => htmlspecialchars($this->input->post('project_description')),
                );
                $result['messages'] = '';
                $result = array('status' => 'success', 'msg' => 'Data Inserted!');
                $this->Model_ProjectMaster->addData($data);
            }

            $csrf = array(
                'token' => $this->security->get_csrf_hash()
            );
            echo json_encode(array('result' => $result, 'csrf' => $csrf));
            die;
        } else if ($param == 'getById') {
            $data = $this->Model_ProjectMaster->getById($id);
            echo json_encode(array('data' => $data));
            die;
        } else if ($param == 'update') {
            $this->form_validation->set_rules("project_name", "Project Name", "trim|required", array('required' => '{field} cannot be null !'));
            $this->form_validation->set_rules("criteria_project_id", "Criteria Project", "trim|required", array('required' => '{field} cannot be null !'));
            $this->form_validation->set_rules("project_description", "Description", "trim|required", array('required' => '{field} cannot be null !'));

            $this->form_validation->set_error_delimiters('<small id="text-error" style="color:red;">*', '</small>');
            if ($this->form_validation->run() == FALSE) {
                $result = array('status' => 'error', 'msg' => 'Data yang anda isi belum benar !');
                foreach ($_POST as $key => $value) {
                    $result['messages'][$key] = form_error($key);
                }
            } else {
                $aidi = $this->input->post('master_project_id');
                $data = array(
                    'project_name'          => htmlspecialchars($this->input->post('project_name')),
                    'criteria_project_id'   => htmlspecialchars($this->input->post('criteria_project_id')),
                    'project_description'   => htmlspecialchars($this->input->post('project_description')),
                );
                $result['messages']    = '';
                $result        = array('status' => 'success', 'msg' => 'Update Success !');
                $this->Model_ProjectMaster->update($aidi, $data);
            }
            $csrf = array(
                'token' => $this->security->get_csrf_hash()
            );
            echo json_encode(array('result' => $result, 'csrf' => $csrf));
            die;
        } else if ($param == 'delete') {
            $this->Model_ProjectMaster->delete($id);
            $result = array('status' => 'success', 'msg' => 'Success Deleted !');
            echo json_encode(array('result' => $result));
            die;
        }
    }

    function projectCriteria($param = '', $id = '')
    {
        if (empty($param)) {
            $view['title'] = 'ADMoni - Projects Criteria';
            $view['pageName'] = 'projectCriteria';
            $view['a_projectCriteria'] = 'active';
            $view['getAllCriteria'] = $this->Model_ProjectCriteria->getData();
            $this->load->view('administrator/index', $view);
        } else if ($param == 'getAllData') {
            $dt = $this->Model_ProjectCriteria->getAllData();
            $start = $this->input->post('start');
            $data = array();
            foreach ($dt['data'] as $row) {
                $userid     = ($row->criteria_project_id);
                $th1    = '<div class="text-center">' . ++$start . '</div>';
                $th2    = '<div class="text-center">' . $row->criteria_project_name . '</div>';
                $th3   = '<div class="text-center" style="width:100px;">' . (get_btn_group1('updateData(' . $userid . ')', 'deleteData(' . $userid . ')')) . '</div>';
                $data[] = gathered_data(array($th1, $th2, $th3));
            }
            $dt['data'] = $data;
            echo json_encode($dt);
            die;
        } else if ($param == 'insert') {
            $this->form_validation->set_rules("criteria_project_name", "Criteria Project Name", "trim|required", array('required' => '{field} cannot be null !'));
            $this->form_validation->set_error_delimiters('<small id="text-error" style="color:red;">* ', '</small>');
            if ($this->form_validation->run() == FALSE) {
                $result = array('status' => 'error', 'msg' => 'Data is not right, please check again.');
                foreach ($_POST as $key => $value) {
                    $result['messages'][$key] = form_error($key);
                }
            } else {
                $data = array(
                    'criteria_project_name'          => htmlspecialchars($this->input->post('criteria_project_name')),
                );
                $result['messages'] = '';
                $result = array('status' => 'success', 'msg' => 'Data Inserted!');
                $this->Model_ProjectCriteria->addData($data);
            }

            $csrf = array(
                'token' => $this->security->get_csrf_hash()
            );
            echo json_encode(array('result' => $result, 'csrf' => $csrf));
            die;
        } else if ($param == 'getById') {
            $data = $this->Model_ProjectCriteria->getById($id);
            echo json_encode(array('data' => $data));
            die;
        } else if ($param == 'update') {
            $this->form_validation->set_rules("criteria_project_name", "Project Name", "trim|required", array('required' => '{field} cannot be null !'));
            $this->form_validation->set_error_delimiters('<small id="text-error" style="color:red;">*', '</small>');
            if ($this->form_validation->run() == FALSE) {
                $result = array('status' => 'error', 'msg' => 'Data yang anda isi belum benar !');
                foreach ($_POST as $key => $value) {
                    $result['messages'][$key] = form_error($key);
                }
            } else {
                $aidi = $this->input->post('criteria_project_id');
                $data = array(
                    'criteria_project_name'          => htmlspecialchars($this->input->post('criteria_project_name')),
                );
                $result['messages']    = '';
                $result        = array('status' => 'success', 'msg' => 'Update Success !');
                $this->Model_ProjectCriteria->update($aidi, $data);
            }
            $csrf = array(
                'token' => $this->security->get_csrf_hash()
            );
            echo json_encode(array('result' => $result, 'csrf' => $csrf));
            die;
        } else if ($param == 'delete') {
            $this->Model_ProjectCriteria->delete($id);
            $result = array('status' => 'success', 'msg' => 'Success Deleted !');
            echo json_encode(array('result' => $result));
            die;
        }
    }

    function projectPICHeader($param = '', $id = '')
    {
        if (empty($param)) {
            $view['title'] = 'ADMoni - Projects PIC Header';
            $view['pageName'] = 'projectPICHeader';
            $view['a_projectPICHeader'] = 'active';
            $this->load->view('administrator/index', $view);
        } else if ($param == 'getAllData') {
            $dt = $this->Model_ProjectPICHeader->getAllData();
            $start = $this->input->post('start');
            $data = array();
            foreach ($dt['data'] as $row) {
                $userid     = ($row->pic_project_hdr_id);
                $th1    = '<div class="text-center">' . ++$start . '</div>';
                $th2    = '<div class="text-center">' . $row->pic_project_name . '</div>';
                $th3   = '<div class="text-center" style="width:100px;">' . (get_btn_group1('updateData(' . $userid . ')', 'deleteData(' . $userid . ')')) . '</div>';
                $data[] = gathered_data(array($th1, $th2, $th3));
            }
            $dt['data'] = $data;
            echo json_encode($dt);
            die;
        } else if ($param == 'insert') {
            $this->form_validation->set_rules("pic_project_name", "PIC Project Name", "trim|required", array('required' => '{field} cannot be null !'));
            $this->form_validation->set_error_delimiters('<small id="text-error" style="color:red;">* ', '</small>');
            if ($this->form_validation->run() == FALSE) {
                $result = array('status' => 'error', 'msg' => 'Data is not right, please check again.');
                foreach ($_POST as $key => $value) {
                    $result['messages'][$key] = form_error($key);
                }
            } else {
                $data = array(
                    'pic_project_name'          => htmlspecialchars($this->input->post('pic_project_name')),
                );
                $result['messages'] = '';
                $result = array('status' => 'success', 'msg' => 'Data Inserted!');
                $this->Model_ProjectPICHeader->addData($data);
            }

            $csrf = array(
                'token' => $this->security->get_csrf_hash()
            );
            echo json_encode(array('result' => $result, 'csrf' => $csrf));
            die;
        } else if ($param == 'getById') {
            $data = $this->Model_ProjectPICHeader->getById($id);
            echo json_encode(array('data' => $data));
            die;
        } else if ($param == 'update') {
            $this->form_validation->set_rules("pic_project_name", "Project Name", "trim|required", array('required' => '{field} cannot be null !'));
            $this->form_validation->set_error_delimiters('<small id="text-error" style="color:red;">*', '</small>');
            if ($this->form_validation->run() == FALSE) {
                $result = array('status' => 'error', 'msg' => 'Data yang anda isi belum benar !');
                foreach ($_POST as $key => $value) {
                    $result['messages'][$key] = form_error($key);
                }
            } else {
                $aidi = $this->input->post('pic_project_hdr_id');
                $data = array(
                    'pic_project_name'          => htmlspecialchars($this->input->post('pic_project_name')),
                );
                $result['messages']    = '';
                $result        = array('status' => 'success', 'msg' => 'Update Success !');
                $this->Model_ProjectPICHeader->update($aidi, $data);
            }
            $csrf = array(
                'token' => $this->security->get_csrf_hash()
            );
            echo json_encode(array('result' => $result, 'csrf' => $csrf));
            die;
        } else if ($param == 'delete') {
            $this->Model_ProjectPICHeader->delete($id);
            $result = array('status' => 'success', 'msg' => 'Success Deleted !');
            echo json_encode(array('result' => $result));
            die;
        }
    }

    function projectPICDetails($param = '', $id = '')
    {
        if (empty($param)) {
            $view['title'] = 'ADMoni - Projects PIC Details';
            $view['pageName'] = 'projectPICDetails';
            $view['a_projectPICDetails'] = 'active';
            $this->load->view('administrator/index', $view);
        } else if ($param == 'getAllData') {
            $dt = $this->Model_ProjectPICDetails->getAllData();
            $start = $this->input->post('start');
            $data = array();
            foreach ($dt['data'] as $row) {
                $userid     = ($row->pic_project_dtl_id);
                $th1    = '<div class="text-center">' . ++$start . '</div>';
                $th2    = '<div class="text-center">' . $row->pic_project_name . '</div>';
                $th3   = '<div class="text-center" style="width:100px;">' . (get_btn_group1('updateData(' . $userid . ')', 'deleteData(' . $userid . ')')) . '</div>';
                $data[] = gathered_data(array($th1, $th2, $th3));
            }
            $dt['data'] = $data;
            echo json_encode($dt);
            die;
        } else if ($param == 'insert') {
            $this->form_validation->set_rules("pic_project_name", "PIC Project Name", "trim|required", array('required' => '{field} cannot be null !'));
            $this->form_validation->set_error_delimiters('<small id="text-error" style="color:red;">* ', '</small>');
            if ($this->form_validation->run() == FALSE) {
                $result = array('status' => 'error', 'msg' => 'Data is not right, please check again.');
                foreach ($_POST as $key => $value) {
                    $result['messages'][$key] = form_error($key);
                }
            } else {
                $data = array(
                    'pic_project_name'          => htmlspecialchars($this->input->post('pic_project_name')),
                );
                $result['messages'] = '';
                $result = array('status' => 'success', 'msg' => 'Data Inserted!');
                $this->Model_ProjectPICDetails->addData($data);
            }

            $csrf = array(
                'token' => $this->security->get_csrf_hash()
            );
            echo json_encode(array('result' => $result, 'csrf' => $csrf));
            die;
        } else if ($param == 'getById') {
            $data = $this->Model_ProjectPICDetails->getById($id);
            echo json_encode(array('data' => $data));
            die;
        } else if ($param == 'update') {
            $this->form_validation->set_rules("pic_project_name", "Project Name", "trim|required", array('required' => '{field} cannot be null !'));
            $this->form_validation->set_error_delimiters('<small id="text-error" style="color:red;">*', '</small>');
            if ($this->form_validation->run() == FALSE) {
                $result = array('status' => 'error', 'msg' => 'Data yang anda isi belum benar !');
                foreach ($_POST as $key => $value) {
                    $result['messages'][$key] = form_error($key);
                }
            } else {
                $aidi = $this->input->post('pic_project_dtl_id');
                $data = array(
                    'pic_project_name'          => htmlspecialchars($this->input->post('pic_project_name')),
                );
                $result['messages']    = '';
                $result        = array('status' => 'success', 'msg' => 'Update Success !');
                $this->Model_ProjectPICDetails->update($aidi, $data);
            }
            $csrf = array(
                'token' => $this->security->get_csrf_hash()
            );
            echo json_encode(array('result' => $result, 'csrf' => $csrf));
            die;
        } else if ($param == 'delete') {
            $this->Model_ProjectPICDetails->delete($id);
            $result = array('status' => 'success', 'msg' => 'Success Deleted !');
            echo json_encode(array('result' => $result));
            die;
        }
    }

    function projectStatus($param = '', $id = '')
    {
        if (empty($param)) {
            $view['title'] = 'ADMoni - Projects Status';
            $view['pageName'] = 'projectStatus';
            $view['a_projectStatus'] = 'active';
            $this->load->view('administrator/index', $view);
        } else if ($param == 'getAllData') {
            $dt = $this->Model_ProjectStatus->getAllData();
            $start = $this->input->post('start');
            $data = array();
            foreach ($dt['data'] as $row) {
                $userid     = ($row->project_status_id);
                $th1    = '<div class="text-center">' . ++$start . '</div>';
                $th2    = '<div class="text-center">' . $row->status_name . '</div>';
                $th3   = '<div class="text-center" style="width:100px;">' . (get_btn_group1('updateData(' . $userid . ')', 'deleteData(' . $userid . ')')) . '</div>';
                $data[] = gathered_data(array($th1, $th2, $th3));
            }
            $dt['data'] = $data;
            echo json_encode($dt);
            die;
        } else if ($param == 'insert') {
            $this->form_validation->set_rules("status_name", "Status Name", "trim|required", array('required' => '{field} cannot be null !'));
            $this->form_validation->set_error_delimiters('<small id="text-error" style="color:red;">* ', '</small>');
            if ($this->form_validation->run() == FALSE) {
                $result = array('status' => 'error', 'msg' => 'Data is not right, please check again.');
                foreach ($_POST as $key => $value) {
                    $result['messages'][$key] = form_error($key);
                }
            } else {
                $data = array(
                    'status_name'          => htmlspecialchars($this->input->post('status_name')),
                );
                $result['messages'] = '';
                $result = array('status' => 'success', 'msg' => 'Data Inserted!');
                $this->Model_ProjectStatus->addData($data);
            }

            $csrf = array(
                'token' => $this->security->get_csrf_hash()
            );
            echo json_encode(array('result' => $result, 'csrf' => $csrf));
            die;
        } else if ($param == 'getById') {
            $data = $this->Model_ProjectStatus->getById($id);
            echo json_encode(array('data' => $data));
            die;
        } else if ($param == 'update') {
            $this->form_validation->set_rules("status_name", "Project Status Name", "trim|required", array('required' => '{field} cannot be null !'));
            $this->form_validation->set_error_delimiters('<small id="text-error" style="color:red;">*', '</small>');
            if ($this->form_validation->run() == FALSE) {
                $result = array('status' => 'error', 'msg' => 'Data yang anda isi belum benar !');
                foreach ($_POST as $key => $value) {
                    $result['messages'][$key] = form_error($key);
                }
            } else {
                $aidi = $this->input->post('project_status_id');
                $data = array(
                    'status_name'          => htmlspecialchars($this->input->post('status_name')),
                );
                $result['messages']    = '';
                $result        = array('status' => 'success', 'msg' => 'Update Success !');
                $this->Model_ProjectStatus->update($aidi, $data);
            }
            $csrf = array(
                'token' => $this->security->get_csrf_hash()
            );
            echo json_encode(array('result' => $result, 'csrf' => $csrf));
            die;
        } else if ($param == 'delete') {
            $this->Model_ProjectStatus->delete($id);
            $result = array('status' => 'success', 'msg' => 'Success Deleted !');
            echo json_encode(array('result' => $result));
            die;
        }
    }

    function riskMitigation($param = '', $id = '')
    {
        if (empty($param)) {
            $view['title'] = 'ADMoni - Risk Mitigation';
            $view['pageName'] = 'riskMitigation';
            $view['a_riskMitigation'] = 'active';
            $view['getAllProject'] = $this->Model_ProjectMaster->getData();
            $this->load->view('administrator/index', $view);
        } else if ($param == 'getAllData') {
            $dt = $this->Model_RiskMitigation->getAllData();
            $start = $this->input->post('start');
            $data = array();
            foreach ($dt['data'] as $row) {
                $userid     = ($row->risk_mitigation_id);
                $th1    = '<div class="text-center">' . ++$start . '</div>';
                $th2    = '<div class="text-center">' . $row->project_name . '</div>';
                $th3    = '<div class="text-center">' . $row->risk_profile . '</div>';
                $th4    = '<div class="text-center">' . $row->mitigation . '</div>';
                $th5    =  $row->checklist == 1 ? "<li class='far fa-check-circle'></li>" : ($row->checklist == 0 ? "<li class='fas fa-times'></li>" : "");
                $th6   = '<div class="text-center" style="width:100px;">' . (get_btn_group1('updateData(' . $userid . ')', 'deleteData(' . $userid . ')')) . '</div>';
                $data[] = gathered_data(array($th1, $th2, $th3, $th4, $th5, $th6));
            }
            $dt['data'] = $data;
            echo json_encode($dt);
            die;
        } else if ($param == 'insert') {
            $this->form_validation->set_rules("master_project_id", " Project Name ", "trim|required", array('required' => '{field} cannot be null !'));
            $this->form_validation->set_rules("risk_profile", "Risk Profile", "trim|required", array('required' => '{field} cannot be null !'));
            $this->form_validation->set_error_delimiters('<small id="text-error" style="color:red;">* ', '</small>');
            if ($this->form_validation->run() == FALSE) {
                $result = array('status' => 'error', 'msg' => 'Data is not right, please check again.');
                foreach ($_POST as $key => $value) {
                    $result['messages'][$key] = form_error($key);
                }
            } else {
                $data = array(
                    'master_project_id'          => htmlspecialchars($this->input->post('master_project_id')),
                    'risk_profile'          => htmlspecialchars($this->input->post('risk_profile')),
                    'mitigation'          => htmlspecialchars($this->input->post('mitigation')),
                    'checklist'          => htmlspecialchars($this->input->post('checklist')),
                );
                $result['messages'] = '';
                $result = array('status' => 'success', 'msg' => 'Data Inserted!');
                $this->Model_RiskMitigation->addData($data);
            }

            $csrf = array(
                'token' => $this->security->get_csrf_hash()
            );
            echo json_encode(array('result' => $result, 'csrf' => $csrf));
            die;
        } else if ($param == 'getById') {
            $data = $this->Model_RiskMitigation->getById($id);
            echo json_encode(array('data' => $data));
            die;
        } else if ($param == 'update') {
            $this->form_validation->set_rules("master_project_id", " Project Name ", "trim|required", array('required' => '{field} cannot be null !'));
            $this->form_validation->set_rules("risk_profile", "Risk Profile", "trim|required", array('required' => '{field} cannot be null !'));
            $this->form_validation->set_error_delimiters('<small id="text-error" style="color:red;">*', '</small>');
            if ($this->form_validation->run() == FALSE) {
                $result = array('status' => 'error', 'msg' => 'Data yang anda isi belum benar !');
                foreach ($_POST as $key => $value) {
                    $result['messages'][$key] = form_error($key);
                }
            } else {
                $aidi = $this->input->post('risk_mitigation_id');
                $data = array(
                    'master_project_id'          => htmlspecialchars($this->input->post('master_project_id')),
                    'risk_profile'          => htmlspecialchars($this->input->post('risk_profile')),
                    'mitigation'          => htmlspecialchars($this->input->post('mitigation')),
                    'checklist'          => htmlspecialchars($this->input->post('checklist')),
                );
                $result['messages']    = '';
                $result        = array('status' => 'success', 'msg' => 'Update Success !');
                $this->Model_RiskMitigation->update($aidi, $data);
            }
            $csrf = array(
                'token' => $this->security->get_csrf_hash()
            );
            echo json_encode(array('result' => $result, 'csrf' => $csrf));
            die;
        } else if ($param == 'delete') {
            $this->Model_RiskMitigation->delete($id);
            $result = array('status' => 'success', 'msg' => 'Success Deleted !');
            echo json_encode(array('result' => $result));
            die;
        }
    }

    function projectInformation($param = '', $id = '')
    {
        if (empty($param)) {
            $view['title'] = 'ADMoni - Projects Information';
            $view['pageName'] = 'projectInformation';
            $view['a_projectInformation'] = 'active';
            $view['getAllProject'] = $this->Model_ProjectMaster->getData();

            $this->load->view('administrator/index', $view);
        } else if ($param == 'getAllData') {
            $dt = $this->Model_ProjectInformation->getAllData();
            $start = $this->input->post('start');
            $data = array();
            foreach ($dt['data'] as $row) {
                $userid     = ($row->project_information_id);
                $th1    = '<div class="text-center">' . ++$start . '</div>';
                $th2    = '<div class="text-center">' . $row->project_name . '</div>';
                $th3    = '<div class="text-center">' . $row->consultant_name . '</div>';
                $th4    = '<div class="text-center">' . $row->contract_price . '</div>';
                $th5    = '<div class="text-center">' . $row->termyn_value . '</div>';
                $th6    = '<div class="text-center">' . $row->payed . '</div>';
                $th7    = '<div class="text-center">' . $row->kind_of_consultant . '</div>';
                $th8    = '<div class="text-center">' . $row->waktu_konsultan_mitra . '</div>';
                $th9   = '<div class="text-center" style="width:100px;">' . (get_btn_group1('updateData(' . $userid . ')', 'deleteData(' . $userid . ')')) . '</div>';
                $data[] = gathered_data(array($th1, $th2, $th3, $th4, $th5, $th6, $th7, $th8, $th9));
            }
            $dt['data'] = $data;
            echo json_encode($dt);
            die;
        } else if ($param == 'insert') {
            $this->form_validation->set_rules("master_project_id", "Project Name", "trim|required", array('required' => '{field} cannot be null !'));
            $this->form_validation->set_rules("consultant_name", "Consultant Name", "trim|required", array('required' => '{field} cannot be null !'));
            $this->form_validation->set_rules("contract_price", "Contract Price", "trim|required", array('required' => '{field} cannot be null !'));
            $this->form_validation->set_rules("termyn_value", "Termyn Value", "trim|required", array('required' => '{field} cannot be null !'));
            $this->form_validation->set_rules("payed", "Payed", "trim|required", array('required' => '{field} cannot be null !'));
            $this->form_validation->set_rules("kind_of_consultant", "Type", "trim|required", array('required' => '{field} cannot be null !'));
            $this->form_validation->set_rules("waktu_konsultan_mitra", "Waktu Konsultan Mitra", "trim|required", array('required' => '{field} cannot be null !'));
            $this->form_validation->set_error_delimiters('<small id="text-error" style="color:red;">* ', '</small>');
            if ($this->form_validation->run() == FALSE) {
                $result = array('status' => 'error', 'msg' => 'Data is not right, please check again.');
                foreach ($_POST as $key => $value) {
                    $result['messages'][$key] = form_error($key);
                }
            } else {
                $data = array(
                    'master_project_id'          => htmlspecialchars($this->input->post('master_project_id')),
                    'consultant_name'          => htmlspecialchars($this->input->post('consultant_name')),
                    'contract_price'          => htmlspecialchars($this->input->post('contract_price')),
                    'termyn_value'          => htmlspecialchars($this->input->post('termyn_value')),
                    'payed'          => htmlspecialchars($this->input->post('payed')),
                    'kind_of_consultant'          => htmlspecialchars($this->input->post('kind_of_consultant')),
                    'waktu_konsultan_mitra'          => htmlspecialchars($this->input->post('waktu_konsultan_mitra')),
                );
                $result['messages'] = '';
                $result = array('status' => 'success', 'msg' => 'Data Inserted!');
                $this->Model_ProjectInformation->addData($data);
            }

            $csrf = array(
                'token' => $this->security->get_csrf_hash()
            );
            echo json_encode(array('result' => $result, 'csrf' => $csrf));
            die;
        } else if ($param == 'getById') {
            $data = $this->Model_ProjectInformation->getById($id);
            echo json_encode(array('data' => $data));
            die;
        } else if ($param == 'update') {
            $this->form_validation->set_rules("master_project_id", "Project Name", "trim|required", array('required' => '{field} cannot be null !'));
            $this->form_validation->set_rules("consultant_name", "Consultant Name", "trim|required", array('required' => '{field} cannot be null !'));
            $this->form_validation->set_rules("contract_price", "Contract Price", "trim|required", array('required' => '{field} cannot be null !'));
            $this->form_validation->set_rules("termyn_value", "Termyn Value", "trim|required", array('required' => '{field} cannot be null !'));
            $this->form_validation->set_rules("payed", "Payed", "trim|required", array('required' => '{field} cannot be null !'));
            $this->form_validation->set_rules("kind_of_consultant", "Type", "trim|required", array('required' => '{field} cannot be null !'));
            $this->form_validation->set_rules("waktu_konsultan_mitra", "Waktu Konsultan Mitra", "trim|required", array('required' => '{field} cannot be null !'));
            $this->form_validation->set_error_delimiters('<small id="text-error" style="color:red;">*', '</small>');
            if ($this->form_validation->run() == FALSE) {
                $result = array('status' => 'error', 'msg' => 'Data yang anda isi belum benar !');
                foreach ($_POST as $key => $value) {
                    $result['messages'][$key] = form_error($key);
                }
            } else {
                $aidi = $this->input->post('project_information_id');
                $data = array(
                    'master_project_id'          => htmlspecialchars($this->input->post('master_project_id')),
                    'consultant_name'          => htmlspecialchars($this->input->post('consultant_name')),
                    'contract_price'          => htmlspecialchars($this->input->post('contract_price')),
                    'termyn_value'          => htmlspecialchars($this->input->post('termyn_value')),
                    'payed'          => htmlspecialchars($this->input->post('payed')),
                    'kind_of_consultant'          => htmlspecialchars($this->input->post('kind_of_consultant')),
                    'waktu_konsultan_mitra'          => htmlspecialchars($this->input->post('waktu_konsultan_mitra'))
                );
                $result['messages']    = '';
                $result        = array('status' => 'success', 'msg' => 'Update Success !');
                $this->Model_ProjectInformation->update($aidi, $data);
            }
            $csrf = array(
                'token' => $this->security->get_csrf_hash()
            );
            echo json_encode(array('result' => $result, 'csrf' => $csrf));
            die;
        } else if ($param == 'delete') {
            $this->Model_ProjectInformation->delete($id);
            $result = array('status' => 'success', 'msg' => 'Success Deleted !');
            echo json_encode(array('result' => $result));
            die;
        }
    }

    function issueProblem($param = '', $id = '')
    {
        if (empty($param)) {
            $view['title'] = 'ADMoni - Issue Problem';
            $view['pageName'] = 'issueProblem';
            $view['a_issueProblem'] = 'active';
            $view['getMasterProject'] = $this->Model_ProjectMaster->getData();
            $view['getPICDetail'] = $this->Model_ProjectPICDetails->getData();
            $this->load->view('administrator/index', $view);
        } else if ($param == 'getAllData') {
            $dt = $this->Model_IssueProblem->getAllData();
            $start = $this->input->post('start');
            $data = array();
            foreach ($dt['data'] as $row) {
                $userid     = ($row->issue_problem_id);
                $th1    = '<div class="text-center">' . ++$start . '</div>';
                $th2    = '<div class="text-center">' . $row->project_name . '</div>';
                $th3    = '<div class="text-center">' . $row->problem . '</div>';
                $th4    = '<div class="text-center">' . $row->solution . '</div>';
                $th5    = '<div class="text-center">' . $row->pic_project_name . '</div>';
                $th6    = '<div class="text-center">' . $row->status . '</div>';
                $th7   = '<div class="text-center" style="width:100px;">' . (get_btn_group1('updateData(' . $userid . ')', 'deleteData(' . $userid . ')')) . '</div>';
                $data[] = gathered_data(array($th1, $th2, $th3, $th4, $th5, $th6, $th7));
            }
            $dt['data'] = $data;
            echo json_encode($dt);
            die;
        } else if ($param == 'insert') {
            $this->form_validation->set_rules("problem", "Problem", "trim|required", array('required' => '{field} cannot be null !'));
            $this->form_validation->set_rules("solution", "Solution", "trim|required", array('required' => '{field} cannot be null !'));
            $this->form_validation->set_rules("pic_project_dtl_id", "PIC Project", "trim|required", array('required' => '{field} cannot be null !'));
            $this->form_validation->set_rules("master_project_id", "Name Project", "trim|required", array('required' => '{field} cannot be null !'));
            $this->form_validation->set_rules("status", "Status", "trim|required", array('required' => '{field} cannot be null !'));
            $this->form_validation->set_error_delimiters('<small id="text-error" style="color:red;">* ', '</small>');
            if ($this->form_validation->run() == FALSE) {
                $result = array('status' => 'error', 'msg' => 'Data is not right, please check again.');
                foreach ($_POST as $key => $value) {
                    $result['messages'][$key] = form_error($key);
                }
            } else {
                $data = array(
                    'problem'                   => htmlspecialchars($this->input->post('problem')),
                    'solution'                  => htmlspecialchars($this->input->post('solution')),
                    'pic_project_dtl_id'        => htmlspecialchars($this->input->post('pic_project_dtl_id')),
                    'master_project_id'         => htmlspecialchars($this->input->post('master_project_id')),
                    'status'                    => htmlspecialchars($this->input->post('status')),
                );
                $result['messages'] = '';
                $result = array('status' => 'success', 'msg' => 'Data Inserted!');
                $this->Model_IssueProblem->addData($data);
            }

            $csrf = array(
                'token' => $this->security->get_csrf_hash()
            );
            echo json_encode(array('result' => $result, 'csrf' => $csrf));
            die;
        } else if ($param == 'getById') {
            $data = $this->Model_IssueProblem->getById($id);
            echo json_encode(array('data' => $data));
            die;
        } else if ($param == 'update') {
            $this->form_validation->set_rules("problem", "Problem", "trim|required", array('required' => '{field} cannot be null !'));
            $this->form_validation->set_rules("solution", "Solution", "trim|required", array('required' => '{field} cannot be null !'));
            $this->form_validation->set_rules("pic_project_dtl_id", "PIC Project Name", "trim|required", array('required' => '{field} cannot be null !'));
            $this->form_validation->set_rules("master_project_id", "Name Project", "trim|required", array('required' => '{field} cannot be null !'));
            $this->form_validation->set_rules("status", "Status", "trim|required", array('required' => '{field} cannot be null !'));

            $this->form_validation->set_error_delimiters('<small id="text-error" style="color:red;">*', '</small>');
            if ($this->form_validation->run() == FALSE) {
                $result = array('status' => 'error', 'msg' => 'Data yang anda isi belum benar !');
                foreach ($_POST as $key => $value) {
                    $result['messages'][$key] = form_error($key);
                }
            } else {
                $aidi = $this->input->post('issue_problem_id');
                $data = array(
                    'problem'                   => htmlspecialchars($this->input->post('problem')),
                    'solution'                  => htmlspecialchars($this->input->post('solution')),
                    'pic_project_dtl_id'        => htmlspecialchars($this->input->post('pic_project_dtl_id')),
                    'master_project_id'        => htmlspecialchars($this->input->post('master_project_id')),
                    'status'        => htmlspecialchars($this->input->post('status')),

                );
                $result['messages']    = '';
                $result        = array('status' => 'success', 'msg' => 'Update Success !');
                $this->Model_IssueProblem->update($aidi, $data);
            }
            $csrf = array(
                'token' => $this->security->get_csrf_hash()
            );
            echo json_encode(array('result' => $result, 'csrf' => $csrf));
            die;
        } else if ($param == 'delete') {
            $this->Model_IssueProblem->delete($id);
            $result = array('status' => 'success', 'msg' => 'Success Deleted !');
            echo json_encode(array('result' => $result));
            die;
        }
    }

    function user($param = '', $id = '')
    {
        if (empty($param)) {
            $view['title'] = 'User';
            $view['pageName'] = 'user';
            $view['active_user'] = 'active';
            $view['listUser'] = $this->Model_user->getData();
            $view['listUserRole'] = $this->Model_user_role->getData();
            $this->load->view('administrator/index', $view);
        } else if ($param == 'getAllData') {
            $dt = $this->Model_user->getAllData();
            $start = $this->input->post('start');
            $data = array();
            foreach ($dt['data'] as $row) {
                $userid     = ($row->userid);
                $th1    = '<div class="text-center">' . ++$start . '</div>';
                $th2    = '<div class="text-left">' . $row->full_name . '</div>';
                $th3    = '<div class="text-center">' . $row->nick_name . '</div>';
                $th4    = '<div class="text-center">' . $row->initial . '</div>';
                $th5    = '<div class="text-center">' . $row->NIP . '</div>';
                $th6    = '<div class="text-center">' . $row->email . '</div>';
                $th7    = '<div class="text-center">' . $row->address . '</div>';
                $th8    = '<div class="text-center">' . $row->phone_number . '</div>';
                // $th9    = '<div class="text-center">' . $row->picture . '</div>';
                $th9   = '<div class="text-center" style="width:100px;">' . (get_btn_group1('update_user(' . $userid . ')', 'delete_user(' . $userid . ')')) . '</div>';
                $data[] = gathered_data(array($th1, $th2, $th3, $th4, $th5, $th6, $th7, $th8, $th9));
            }
            $dt['data'] = $data;
            echo json_encode($dt);
            die;
        } else if ($param == 'insert') {
            $this->form_validation->set_rules("full_name", "Full Name", "trim|required|alpha_numeric_spaces", array('required' => '{field} cannot be null !', 'alpha_numeric_spaces' => 'Character not allowed !'));
            $this->form_validation->set_rules("nick_name", "Nick Name", "trim|required|alpha_numeric_spaces", array('required' => '{field} cannot be null !', 'alpha_numeric_spaces' => 'Character not allowed !'));
            $this->form_validation->set_rules("initial", "Initial", "trim|required|alpha_numeric_spaces", array('required' => '{field} cannot be null !', 'alpha_numeric_spaces' => 'Character not allowed !'));
            $this->form_validation->set_rules("NIP", "NIP", "trim|required|alpha_numeric_spaces", array('required' => '{field} cannot be null !', 'alpha_numeric_spaces' => 'Character not allowed !'));
            $this->form_validation->set_rules("email", "Email", "trim|required", array('required' => '{field} cannot be null !', 'alpha_numeric_spaces' => 'Character not allowed!'));
            $this->form_validation->set_rules("address", "Address", "trim|required|alpha_numeric_spaces", array('required' => '{field} cannot be null !', 'alpha_numeric_spaces' => 'Character not allowed !'));
            $this->form_validation->set_rules("phone_number", "Phone Number", "trim|required|alpha_numeric_spaces", array('required' => '{field} cannot be null !', 'alpha_numeric_spaces' => 'Character not allowed !'));

            $this->form_validation->set_error_delimiters('<h6 id="text-error" class="help-block help-block-error">* ', '</h6>');
            if ($this->form_validation->run() == FALSE) {
                $result = array('status' => 'error', 'msg' => 'Data is not right, please check again.');
                foreach ($_POST as $key => $value) {
                    $result['messages'][$key] = form_error($key);
                }
            } else {
                $data = array(
                    'full_name'          => htmlspecialchars($this->input->post('full_name')),
                    'nick_name'          => htmlspecialchars($this->input->post('nick_name')),
                    'initial'            => htmlspecialchars($this->input->post('initial')),
                    'NIP'                => htmlspecialchars($this->input->post('NIP')),
                    'email'              => htmlspecialchars($this->input->post('email')),
                    'address'            => htmlspecialchars($this->input->post('address')),
                    'phone_number'       => htmlspecialchars($this->input->post('phone_number')),
                );
                $result['messages'] = '';
                $result = array('status' => 'success', 'msg' => 'Data Inserted!');
                $this->Model_user->addData($data);
                // $this->B_user_log_model->addLog(userLog('Add Data', $this->session->userdata('first_name') . ' Add data Tracer Study Program Study', $this->session->userdata('id')));
            }

            $csrf = array(
                'token' => $this->security->get_csrf_hash()
            );
            echo json_encode(array('result' => $result, 'csrf' => $csrf));
            die;
        } else if ($param == 'getById') {
            $data = $this->Model_user->getById($id);
            echo json_encode(array('data' => $data));
            die;
        } else if ($param == 'update') {
            $this->form_validation->set_rules("full_name", "Full Name", "trim|required|alpha_numeric_spaces", array('required' => '{field} cannot be null !', 'alpha_numeric_spaces' => 'Character not allowed !'));
            $this->form_validation->set_rules("nick_name", "Nick Name", "trim|required|alpha_numeric_spaces", array('required' => '{field} cannot be null !', 'alpha_numeric_spaces' => 'Character not allowed !'));
            $this->form_validation->set_rules("initial", "Initial", "trim|required|alpha_numeric_spaces", array('required' => '{field} cannot be null !', 'alpha_numeric_spaces' => 'Character not allowed !'));
            $this->form_validation->set_rules("NIP", "NIP", "trim|required|alpha_numeric_spaces", array('required' => '{field} cannot be null !', 'alpha_numeric_spaces' => 'Character not allowed !'));
            $this->form_validation->set_rules("email", "Email", "trim|required", array('required' => '{field} cannot be null !', 'alpha_numeric_spaces' => 'Character not allowed!'));
            $this->form_validation->set_rules("address", "Address", "trim|required|alpha_numeric_spaces", array('required' => '{field} cannot be null !', 'alpha_numeric_spaces' => 'Character not allowed !'));
            $this->form_validation->set_rules("phone_number", "Phone Number", "trim|required|alpha_numeric_spaces", array('required' => '{field} cannot be null !', 'alpha_numeric_spaces' => 'Character not allowed !'));

            $this->form_validation->set_error_delimiters('<small id="text-error" style="color:red;">*', '</small>');
            if ($this->form_validation->run() == FALSE) {
                $result = array('status' => 'error', 'msg' => 'Data yang anda isi belum benar !');
                foreach ($_POST as $key => $value) {
                    $result['messages'][$key] = form_error($key);
                }
            } else {
                $aidi = $this->input->post('userid');
                $data = array(
                    'full_name'          => htmlspecialchars($this->input->post('full_name')),
                    'nick_name'          => htmlspecialchars($this->input->post('nick_name')),
                    'initial'            => htmlspecialchars($this->input->post('initial')),
                    'NIP'                => htmlspecialchars($this->input->post('NIP')),
                    'email'              => htmlspecialchars($this->input->post('email')),
                    'address'            => htmlspecialchars($this->input->post('address')),
                    'phone_number'       => htmlspecialchars($this->input->post('phone_number')),
                );
                $result['messages']    = '';
                $result        = array('status' => 'success', 'msg' => 'Data Berhasil diubah');
                $this->Model_user->update($aidi, $data);
            }
            $csrf = array(
                'token' => $this->security->get_csrf_hash()
            );
            echo json_encode(array('result' => $result, 'csrf' => $csrf));
            die;
        } else if ($param == 'delete') {
            $this->Model_user->delete($id);
            $result = array('status' => 'success', 'msg' => 'Data berhasil dihapus !');
            echo json_encode(array('result' => $result));
            die;
        }
    }

    function userLogin($param = '', $id = '')
    {
        if (empty($param)) {
            $view['listUser'] = $this->Model_user->getData();
            $this->load->view('administrator/index', $view);
        } else if ($param == 'getAllData') {
            $dt = $this->Model_user_login->getAllData();
            $start = $this->input->post('start');
            $data = array();
            foreach ($dt['data'] as $row) {
                $user_login_id     = $row->user_login_id;
                $th1    = '<div class="text-center">' . ++$start . '</div>';
                $th2    = '<div class="text-left">' . $row->full_name . '</div>';
                $th3    = '<div class="text-center">' . $row->nick_name . '</div>';
                $th4    = '<div class="text-center">' . $row->initial . '</div>';
                $th5    = '<div class="text-center">' . $row->NIP . '</div>';
                $th6    = '<div class="text-center">' . $row->email . '</div>';
                $th7    = '<div class="text-center">' . $row->address . '</div>';
                $th8    = '<div class="text-center">' . $row->phone_number . '</div>';
                $th9    = '<div class="text-center">' . $row->username . '</div>';
                $th10    = '<div class="text-center">' . $row->role . '</div>';
                if ($row->block_status == 0) {
                    $th11    = '<div class="text-center btn btn-primary btn-sm">Unblocked</div>';
                } else {
                    $th11    = '<div class="text-center btn btn-danger btn-sm">Blocked</div>';
                }
                $th12   = '<div class="text-center" style="width:100px;">' . (get_btn_group1('update_user_login(' . $user_login_id . ')', 'delete_user_login(' . $user_login_id . ')')) . '</div>';
                $data[] = gathered_data(array($th1, $th2, $th3, $th4, $th5, $th6, $th7, $th8, $th9, $th10, $th11, $th12));
            }
            $dt['data'] = $data;
            echo json_encode($dt);
            die;
        } else if ($param == 'insert') {
            $this->form_validation->set_rules("userid", "Pilih Pengguna", "trim|required", array('required' => '{field} cannot be null !'));
            $this->form_validation->set_rules("username", "Username", "trim|required", array('required' => '{field} cannot be null !'));
            $this->form_validation->set_rules("password", "Password", "trim|required", array('required' => '{field} cannot be null !'));
            $this->form_validation->set_rules("user_role_id", "Pilih Role", "trim|required", array('required' => '{field} cannot be null !'));
            $this->form_validation->set_rules("block_status", "Status Blokir", "trim|required", array('required' => '{field} cannot be null !'));

            $this->form_validation->set_error_delimiters('<h6 id="text-error" class="help-block help-block-error">* ', '</h6>');
            if ($this->form_validation->run() == FALSE) {
                $result = array('status' => 'error', 'msg' => 'Data is not right, please check again.');
                foreach ($_POST as $key => $value) {
                    $result['messages'][$key] = form_error($key);
                }
            } else {
                $password = md5(htmlspecialchars($this->input->post('password')));
                $data = array(
                    'userid'           => htmlspecialchars($this->input->post('userid')),
                    'username'         => htmlspecialchars($this->input->post('username')),
                    'password'         => $password,
                    'user_role_id'     => htmlspecialchars($this->input->post('user_role_id')),
                    'block_status'     => htmlspecialchars($this->input->post('block_status')),
                );
                $result['messages'] = '';
                $result = array('status' => 'success', 'msg' => 'Data Inserted!');
                $this->Model_user_login->addData($data);
                // $this->B_user_log_model->addLog(userLog('Add Data', $this->session->userdata('first_name') . ' Add data Tracer Study Program Study', $this->session->userdata('id')));
            }

            $csrf = array(
                'token' => $this->security->get_csrf_hash()
            );
            echo json_encode(array('result' => $result, 'csrf' => $csrf));
            die;
        } else if ($param == 'getById') {
            $data = $this->Model_user_login->getById($id);
            echo json_encode(array('data' => $data));
            die;
        } else if ($param == 'update') {
            $this->form_validation->set_rules("userid", "Pilih Pengguna", "trim|required", array('required' => '{field} cannot be null !'));
            $this->form_validation->set_rules("username", "Username", "trim|required", array('required' => '{field} cannot be null !'));
            $this->form_validation->set_rules("password", "Password", "trim|required", array('required' => '{field} cannot be null !'));
            $this->form_validation->set_rules("user_role_id", "Pilih Role", "trim|required", array('required' => '{field} cannot be null !'));
            $this->form_validation->set_rules("block_status", "Status Blokir", "trim|required", array('required' => '{field} cannot be null !'));

            $this->form_validation->set_error_delimiters('<small id="text-error" style="color:red;">*', '</small>');
            if ($this->form_validation->run() == FALSE) {
                $result = array('status' => 'error', 'msg' => 'Data yang anda isi belum benar !');
                foreach ($_POST as $key => $value) {
                    $result['messages'][$key] = form_error($key);
                }
            } else {
                $aidi = $this->input->post('user_login_id');
                $password = md5(htmlspecialchars($this->input->post('password')));

                $data = array(
                    'userid'           => htmlspecialchars($this->input->post('userid')),
                    'username'         => htmlspecialchars($this->input->post('username')),
                    'password'         => $password,
                    'user_role_id'     => htmlspecialchars($this->input->post('user_role_id')),
                    'block_status'     => htmlspecialchars($this->input->post('block_status')),
                );
                $result['messages']    = '';
                $this->Model_user_login->update($aidi, $data);
                $result        = array('status' => 'success', 'msg' => 'Data Berhasil diubah');
            }
            $csrf = array(
                'token' => $this->security->get_csrf_hash()
            );
            echo json_encode(array('result' => $result, 'csrf' => $csrf));
            die;
        } else if ($param == 'delete') {
            $this->Model_user_login->delete($id);
            $result = array('status' => 'success', 'msg' => 'Data berhasil dihapus !');
            echo json_encode($result);
            die;
        }
    }

    function userRole($param = '', $id = '')
    {
        if (empty($param)) {
        } else if ($param == 'getAllData') {
            $dt = $this->Model_user_role->getAllData();
            $start = $this->input->post('start');
            $data = array();
            foreach ($dt['data'] as $row) {
                $user_role_id     = $row->user_role_id;
                $th1    = '<div class="text-center">' . ++$start . '</div>';
                $th2    = '<div class="text-left">' . $row->role . '</div>';
                $th3    = '<div class="text-center">' . $row->description . '</div>';
                if ($row->role == 'sys_manager') {
                    $th4   = '<div class="text-center" style="width:100px;"> </div>';
                } else {
                    $th4   = '<div class="text-center" style="width:100px;">' . get_btn_group1('update_user_role(' . $user_role_id . ')', 'delete_user_role(' . $user_role_id . ')') . '</div>';
                }
                $data[] = gathered_data(array($th1, $th2, $th3, $th4));
            }
            $dt['data'] = $data;
            echo json_encode($dt);
            die;
        } else if ($param == 'insert') {
            $this->form_validation->set_rules("role", "Role", "trim|required", array('required' => '{field} cannot be null !'));
            $this->form_validation->set_rules("description", "Description", "trim|required", array('required' => '{field} cannot be null !'));

            $this->form_validation->set_error_delimiters('<h6 id="text-error" class="help-block help-block-error">* ', '</h6>');
            if ($this->form_validation->run() == FALSE) {
                $result = array('status' => 'error', 'msg' => 'Data is not right, please check again.');
                foreach ($_POST as $key => $value) {
                    $result['messages'][$key] = form_error($key);
                }
            } else {
                $data = array(
                    'role'                => htmlspecialchars($this->input->post('role')),
                    'description'                => htmlspecialchars($this->input->post('description')),

                );
                $result['messages'] = '';
                $result = array('status' => 'success', 'msg' => 'Data Inserted!');
                $this->Model_user_role->addData($data);
                // $this->B_user_log_model->addLog(userLog('Add Data', $this->session->userdata('first_name') . ' Add data Tracer Study Program Study', $this->session->userdata('id')));
            }

            $csrf = array(
                'token' => $this->security->get_csrf_hash()
            );
            echo json_encode(array('result' => $result, 'csrf' => $csrf));
            die;
        } else if ($param == 'getById') {
            $data = $this->Model_user_role->getById($id);
            echo json_encode(array('data' => $data));
            die;
        } else if ($param == 'update') {
            $this->form_validation->set_rules("role", "Full Name", "trim|required", array('required' => '{field} cannot be null !'));
            $this->form_validation->set_rules("description", "Nick Name", "trim|required", array('required' => '{field} cannot be null !'));

            $this->form_validation->set_error_delimiters('<small id="text-error" style="color:red;">*', '</small>');
            if ($this->form_validation->run() == FALSE) {
                $result = array('status' => 'error', 'msg' => 'Data yang anda isi belum benar !');
                foreach ($_POST as $key => $value) {
                    $result['messages'][$key] = form_error($key);
                }
            } else {
                $aidi = $this->input->post('user_role_id');
                $data = array(
                    'role'          => htmlspecialchars($this->input->post('role')),
                    'description'   => htmlspecialchars($this->input->post('description'))
                );
                $result['messages']    = '';
                $this->Model_user_role->update($aidi, $data);
                $result        = array('status' => 'success', 'msg' => 'Data Berhasil diubah');
            }
            $csrf = array(
                'token' => $this->security->get_csrf_hash()
            );
            echo json_encode(array('result' => $result, 'csrf' => $csrf));
            die;
        } else if ($param == 'delete') {
            $this->Model_user_role->delete($id);
            $result = array('status' => 'success', 'msg' => 'Data berhasil dihapus !');
            echo json_encode($result);
            die;
        }
    }
}

/* End of file Administrator.php */
