<?php
class Admin extends CI_Controller
{
    public function index()
    {
        $data['judul'] = "Dashboard";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('user/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('user/footer');
        $this->load->view('templates/footer');
    }
}
