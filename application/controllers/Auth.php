<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
	
	public function index()
	{
		$this->load->view('home/login');
	}

	public function login() 
    {
        $admin_data = [
            'username' => 'admin',
            'password' => 'admin123'
        ];

        $username = $this->input->post('username');
        $password = $this->input->post('password');

        if ($username === $admin_data['username'] && $password === $admin_data['password']) {
            $this->session->set_userdata('logged_in', true);
			$this->session->set_flashdata('success', 'Selamat Datang Admin');
            redirect('admin/index');
        } else {
            $this->session->set_flashdata('error', 'Username atau Password salah.');
            redirect('auth/index');
        }
    }

	public function logout() 
    {
        $this->session->unset_userdata('logged_in');
        redirect('home/index');
    }
}