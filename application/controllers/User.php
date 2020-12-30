<?php

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data['judul'] = "My Profile";
        // echo 'selamat datang ' . $data['user']['name'];

        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('user/topbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('user/footer');
        $this->load->view('templates/footer');
    }
    public function edit()
    {
        $data['judul'] = "Edit Profile";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('user/topbar', $data);
        $this->load->view('user/edit', $data);
        $this->load->view('user/footer');
        $this->load->view('templates/footer');
    }
}
