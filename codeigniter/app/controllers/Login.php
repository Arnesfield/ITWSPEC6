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
        // echo 'Access level: Admin';
        redirect(base_url('item'));
      }

      // else if normal
      else {
        echo 'Access level: User';
      }
    }
  }

  // signup
  public function signup() {
    $this->load->helper('form');
    $this->load->library('form_validation');

    // name of input field
    // name on error message
    // rule
    $this->form_validation->set_rules('firstname', 'First name', 'trim|required');
    $this->form_validation->set_rules('lastname', 'Last name', 'trim|required');
    $this->form_validation->set_rules('username', 'Username', 'trim|required|is_unique[accounts.username]');
    $this->form_validation->set_rules('password', 'Password', 'trim|required');
    $this->form_validation->set_rules('confirm_password', 'Password Confirmation', 'trim|required|matches[password]');
    $this->form_validation->set_rules('account_access', 'Account access', 'trim|required');

    if ($this->form_validation->run() === FALSE) {
      $data = array(
        'title' => 'Login',
        'action' => base_url() . 'login/signup'
      );
  
      $this->load->view('templates/header', $data);
      $this->load->view('pages/users/signup');
      $this->load->view('templates/footer');
    }
    else {
      $this->login_model->create();
      echo 'Successfully created account!';
    }
    
  }

}
