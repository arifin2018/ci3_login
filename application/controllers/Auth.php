<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Registration_Model');
    }

    public function index()
    {
        $config = array(
            array(
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'required|trim|valid_email'
            ),
            array(
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'required|trim'
            ),
        );

        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
            $data['judul'] = "login";
            $this->load->view('templates/header', $data);
            $this->load->view('auth/login');
            $this->load->view('templates/footer');
        } else {
            $this->Registration_Model->login();
        }
    }
    public function registration()
    {
        $config = array(
            array(
                'field' => 'name',
                'label' => 'Name',
                'rules' => 'required|trim|min_length[4]'
            ),
            array(
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'required|valid_email|trim|is_unique[user.email]',
                'errors' => ['is_unique' => "This email has already registered!"]
            ),
            array(
                'field' => 'password1',
                'label' => 'Password',
                'rules' => 'required|matches[password2]|trim|min_length[4]',
                'errors' => array(
                    'matches' => "Password Doesn't matches",
                    'min_length' => "password's too short "
                ),
            ),
            array(
                'field' => 'password2',
                'label' => 'Password',
                'rules' => 'required|trim'
            ),
        );
        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == false) {
            $data['judul'] = "Registration";
            $this->load->view('templates/header', $data);
            $this->load->view('auth/Registration');
            $this->load->view('templates/footer');
        } else {
            $data['Registration'] = $this->Registration_Model->Registration();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Congratulation! Your account has been created. Please Login buddy!
            </div>');
            redirect('auth');
        }
    }
    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                You have been logout!
                </div>');
        redirect('auth');
    }
}
