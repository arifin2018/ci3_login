<?php

class Registration_Model extends CI_Model
{
    protected function Registration()
    {
        $data = array(
            'name' => htmlspecialchars($this->input->post('name', true)),
            'email' => htmlspecialchars($this->input->post('email', true)),
            'image' => 'default.jpg',
            'password' => password_hash($this->input->post('password1', true), PASSWORD_BCRYPT),
            'role_id' => 2,
            'is_active' => 1,
            // 'data_created' =>  date('Y-m-d H:i:s', time())
        );
        $this->db->insert('user', $data);
    }

    public function login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        if ($user > 0) {
            #code
            if (password_verify($password, $user['password'])) {
                # code...
                if ($user['is_active'] == 1) {
                    $data = [
                        'email' => $user['email'],
                        'role_id' => $user['role_id']
                    ];
                    $this->session->set_userdata($data);
                    redirect('user');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                user have not been activated, please check email for activated!
                </div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Password is wrongs, please check again!
                </div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            email is not registered!
            </div>');
            redirect('auth');
        }
    }
}
