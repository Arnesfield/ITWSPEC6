<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
  
  public function __construct() {
    parent::__construct();
    $this->load->model('login_model');
  }

  public function index() {
    $data = array(
      'title' => 'Login',
      'action' => base_url() . 'login/submit'
    );
    
		$this->load->view('templates/header', $data);
    $this->load->view('pages/users/login');
    $this->load->view('templates/footer');
  }
  
  public function submit() {
    $username = $this->input->post('username', true);
    $password = sha1($this->input->post('password', true));

    // fetch user
    $user = $this->login_model->fetch($username, $password);

    if ($user) {
      echo 'Logged in successful.';

      // if admin
      if ($user->account_access == 1) {
        echo 'Access level: Admin';
      }

      // else if normal
      else {
        echo 'Access level: User';
      }
    }
  }
}
