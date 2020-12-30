<?php

class Menu extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Menu_Model');
    }
    public function index()
    {
        $data['judul'] = "Menu Management";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['menu'] = $this->Menu_Model->getMenu();
        $this->form_validation->set_rules('menu', 'Menu', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/user_header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('user/topbar', $data);
            $this->load->view('menu/index', $data);
            $this->load->view('user/footer');
            $this->load->view('templates/footer');
        } else {
            $this->Menu_Model->addMenu();
            $this->session->set_flashdata('menu', '<div class="alert alert-success" role="alert">Add menu success</div>');
            redirect('menu');
        }
    }
    public function edit($id)
    {
        $data['judul'] = "Edit menu";
        $data['menu'] = $this->Menu_Model->getMenuID($id);
        $this->form_validation->set_rules('menu', 'Menu', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/user_header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('user/topbar', $data);
            $this->load->view('menu/index', $data);
            $this->load->view('user/footer');
            $this->load->view('templates/footer');
        } else {
            $data['menu'] = $this->Menu_Model->editMenu($id);
            $this->session->set_flashdata('menu', '<div class="alert alert-success" role="alert">Edit menu success</div>');
            redirect('menu');
        }
    }
    public function hapus($id)
    {
        $this->Menu_Model->hapus($id);
        $this->session->set_flashdata('menu', '<div class="alert alert-danger" role="alert">Delete menu success</div>');
        redirect('menu');
    }

    public function subMenu()
    {
        $data['judul'] = "SubMenu Management";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['menu'] = $this->Menu_Model->subMenu();

        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('user/topbar', $data);
        $this->load->view('menu/subMenu', $data);
        $this->load->view('user/footer');
        $this->load->view('templates/footer');
    }
}
