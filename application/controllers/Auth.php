<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // Load google oauth library
        // $this->load->library('google');
        $this->load->model('Model_user');
        $this->load->helper('notif&log');
        $this->load->helper('my_function');
        // Load user model
    }

    function index()
    {
        // Redirect to profile page if the user already logged in
        if ($this->session->userdata('loggedIn') == true) {
            redirect('Administrator');
        }
        //Melakukan validasi untuk username dan password
        $this->form_validation->set_rules('username', 'Username', 'required|trim|min_length[6]', array('min_length' => 'Too {field} short Character !', 'required' => '{field} required !'));
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[6]', array('min_length' => 'Too {field} short Character !', 'required' => '{field} required !'));
        $this->form_validation->set_error_delimiters('<span class="text-left" style="color:red;"> <br>', '</span>');

        //Jika validasi input username dan password bernilai false
        if ($this->form_validation->run() == FALSE) {
        } else {
            $username = htmlspecialchars($this->input->post('username'));
            $password = htmlspecialchars($this->input->post('password'));
            $user = $username;
            $pass = md5($password);
            $cek = $this->Model_user_login->cek_user_pwd($user, $pass);
            if ($cek->num_rows() != 0) {
                foreach ($cek->result() as $qad) {
                    $sess_data['id']              = $qad->user_login_id;
                    $sess_data['userid']       = $qad->userid;
                    $sess_data['full_name']       = $qad->full_name;
                    $sess_data['nick_name']       = $qad->nick_name;
                    $sess_data['username']        = $qad->username;
                    $sess_data['email']           = $qad->email;
                    $sess_data['picture']         = $qad->picture;
                    $sess_data['role']            = $qad->role;
                    $sess_data['phone_number']            = $qad->role;
                    $sess_data['user_role_id']    = $qad->user_role_id;
                    $sess_data['online_status']   = $qad->online_status;
                    $sess_data['block_status']    = $qad->block_status;
                    echo $this->session->set_userdata($sess_data);
                }
                if ($sess_data['block_status'] != 1) {
                    $this->session->set_userdata('loggedIn', TRUE);
                    $this->session->set_flashdata('success', 'Welcome ' . $sess_data['nick_name'] . ' ! <br> You success login to Arniuz Open Projects');
                    $this->Model_user_login->change_on_off($sess_data['id'], online_status('online'));
                    // $this->B_notif_model->insert_notif(notifLog('Login', 'Selamat Datang ' . $sess_data['first_name'] . ' ' . $sess_data['last_name'] . ' !', 'Login', $sess_data['id']));
                    // $this->B_user_log_model->addLog(userLog('Login System',  $sess_data['first_name'] . ' ' . $sess_data['last_name'] . ' Login ke System', $sess_data['id']));
                    redirect('Administrator', 'refresh');
                } else {
                    $this->session->set_flashdata('result_login', 'This user has blocked, you can not login ! ');
                    redirect('auth/');
                }
            } else {
                $this->session->set_flashdata('result_login', 'Username or Password is not true !');
                redirect('auth/');
            }
        }
        $this->load->view('auth/index');


        // ini untuk konfirmasi pengguna apakah ada atau tidak
        // $email = $this->User->get_email_user();
        // foreach ($email as $row) {
        //     $var[] = $row->email;
        // }
        // Google authentication url
        // $data['loginURL'] = $this->google->loginURL();
        // $data['jenis_user_log'] = $this->B_user_log_model->countUserLogbyJenisAksi('jenis_aksi');
        // Load google login view

    }

    function registrasi()
    {
        $this->form_validation->set_rules("full_name", "Full Name", "trim|required", array('required' => '{field} cannot be null !'));
        $this->form_validation->set_rules("email", "Email", "trim|required", array('required' => '{field} cannot be null !'));
        $this->form_validation->set_rules("phone_number", "Phone Number", "trim|required", array('required' => '{field} cannot be null !'));
        $this->form_validation->set_rules("username", "Username", "trim|required", array('required' => '{field} cannot be null !'));
        $this->form_validation->set_rules("password", "Password", "trim|required", array('required' => '{field} cannot be null !'));
        $this->form_validation->set_rules("user_role_id", "User role", "trim|required", array('required' => '{field} cannot be null !'));
        $this->form_validation->set_error_delimiters('<small id="text-error" style="color:red;">* ', '</small>');
        if ($this->form_validation->run() == FALSE) {
            $result = array('status' => 'error', 'msg' => 'Data is not right, please check again.');
            foreach ($_POST as $key => $value) {
                $result['messages'][$key] = form_error($key);
            }
        } else {
            $data1 = array(
                'full_name'          => htmlspecialchars($this->input->post('full_name')),
                'email'          => htmlspecialchars($this->input->post('email')),
                'phone_number'          => htmlspecialchars($this->input->post('phone_number')),
            );

            $getMaxUserID = $this->db->query('SELECT MAX(userid) AS max_value FROM user')->result();
            $data2 = array(
                'userid'          => $getMaxUserID[0]->max_value,
                'username'          => htmlspecialchars($this->input->post('username')),
                'password'          => md5($this->input->post('password')),
                'user_role_id'          => htmlspecialchars($this->input->post('user_role_id')),
            );
            $result['messages'] = '';
            $result = array('status' => 'success', 'msg' => 'Data Inserted!');
            $this->Model_user->addData($data1);
            $this->Model_user_login->addData($data2);
        }

        $csrf = array(
            'token' => $this->security->get_csrf_hash()
        );
        echo json_encode(array('result' => $result, 'csrf' => $csrf));
        die;
    }

    public function logout()
    {
        // Remove token and user data from the session
        $this->session->unset_userdata('loggedIn');
        $this->session->unset_userdata('userData');
        // Destroy entire session data
        $this->session->sess_destroy();
        $user_id = $this->session->userdata('id');
        // $this->B_user_log_model->addLog(userLog('Logout System',  $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name') . ' Logout dari System', $this->session->userdata('id')));
        $this->Model_user_login->change_on_off($user_id, online_status('offline'));
        // Redirect to login page
        echo json_encode(array("status" => 'success', 'msg' => 'Thanks for using this system !'));
    }

    public function force_logout()
    {

        // Remove token and user data from the session
        $this->session->unset_userdata('loggedIn');
        $this->session->unset_userdata('userData');
        // Destroy entire session data
        $this->session->sess_destroy();
        $user_id = $this->session->userdata('id');
        // $this->B_user_log_model->addLog(userLog('Logout System',  $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name') . ' Logout dari System', $this->session->userdata('id')));
        $this->Model_user_login->change_on_off($user_id, online_status('offline'));
        // Redirect to login page
        redirect('auth/');
    }
}
