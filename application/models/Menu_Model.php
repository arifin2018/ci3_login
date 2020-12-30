<?php
class Menu_Model extends CI_Model
{
    public function getMenu()
    {
        $query = $this->db->get('user_menu');
        return $query->result_array();
    }
    public function addMenu()
    {
        $data = array(
            'menu' => htmlspecialchars($this->input->post('menu', true)),
        );
        $this->db->insert('user_menu', $data);
    }
    public function getMenuID($id)
    {
        $query = $this->db->get_where('user_menu', array('id' => $id));
        return $query->row_array();
    }
    public function hapus($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('user_menu');
    }
    public function editMenu($id)
    {
        $data = [
            'menu' => $this->input->post('menu', true)
        ];
        $this->db->where('id', $id);
        $this->db->update('user_menu', $data);
        redirect('menu');
    }
}
