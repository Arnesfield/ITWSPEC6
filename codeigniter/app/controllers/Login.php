<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
  
  public function __construct() {
    parent::__construct();
    $this->load->model('login_model');
    $this->load->library('email');
  }

  public function index() {
    $this->load->helper('form');
    $this->load->library('form_validation');

    $this->form_validation->set_rules('username', 'Username', 'trim|required');
    $this->form_validation->set_rules('password', 'Password', 'trim|required');

    if ($this->form_validation->run() === FALSE) {
      $data = array(
        'title' => 'Login',
        'action' => base_url()
      );
      
      $this->load->view('templates/header', $data);
      $this->load->view('pages/users/login');
      $this->load->view('templates/footer');
    }
    else {
      // fetch user
      $user = $this->login_model->fetch();
  
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
    $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[accounts.email]');
    $this->form_validation->set_rules('password', 'Password', 'trim|required');
    $this->form_validation->set_rules('confirm_password', 'Password Confirmation', 'trim|required|matches[password]');
    $this->form_validation->set_rules('account_access', 'Account access', 'trim|required');

    if ($this->form_validation->run() === FALSE) {
      $data = array(
        'title' => 'Signup',
        'action' => base_url() . 'login/signup'
      );
  
      $this->load->view('templates/header', $data);
      $this->load->view('pages/users/signup');
      $this->load->view('templates/footer');
    }
    else {
      $email = $this->input->post('email', true);
      $code = $this->generate();

      $this->sendmail($email, $code);
      $this->login_model->create($code);
      echo 'Successfully created account! Please check your email.';
    }
    
  }

  public function generate() {
    $this->load->helper('string');
    return random_string('alnum', 5);
  }

  public function sendmail($email, $code) {
    // $code = md5(uniqid(rand(), true));
    
    // true on third param on view
    $this->email->from('email@mail.com', 'Jefferson Rylee');
    $this->email->to($email);
    $this->email->subject('Email Verification');
    $data = array(
      'code' => $code
    );
    $this->email->message($this->load->view('pages/email', $data, TRUE));
    
    if ($this->email->send()) {
      echo 'email sent\n';
    }
    else {
      echo $this->email->print_debugger();
    }
	}

}
