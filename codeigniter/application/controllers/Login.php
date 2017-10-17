<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_View_Controller {
  
  private $_EMAIL = 'mail.arnesfield@gmail.com';

  public function __construct() {
    parent::__construct();
    $this->load->model('login_model');
    $this->load->library(array('email', 'session'));

    if ($this->session->has_userdata('isloggedin') == TRUE) {
      redirect(base_url('item'));
    }
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
      
      $this->_view(array(
        'pages/users/login', 'alerts/snackbar'
      ), $data);
    }
    else {
      // fetch user
      $user = $this->login_model->fetch();
  
      if ($user) {
        echo 'Logged in successful.';

        $this->session->set_userdata('isloggedin', true);
        $this->session->set_userdata('userid', 1);
        $this->session->set_flashdata('msg', 'Logged in successfully.');
  
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

  public function sendmail($email, $code, $reset_password = FALSE) {
    // $code = md5(uniqid(rand(), true));
    
    // true on third param on view
    $this->email->from($this->_EMAIL, 'Jefferson Rylee');
    $this->email->to($email);
    $this->email->subject($reset_password ? 'Reset Password' : 'Email Verification');
    $data = array(
      'code' => $code
    );
    $this->email->message($this->load->view(
      $reset_password ? 'pages/forgot_page' : 'pages/email', $data, TRUE));
    
    if ($this->email->send()) {
      echo 'email sent\n';
    }
    else {
      echo $this->email->print_debugger();
    }
	}

  // forgot
  public function forgot() {
    $this->load->helper('form');
    $this->load->library('form_validation');
    
    $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

    if ($this->form_validation->run() === FALSE) {
      $data = array(
        'title' => 'Forgot Password'
      );
  
      $this->load->view('templates/header', $data);
      $this->load->view('pages/forgot');
      $this->load->view('templates/footer');
    }
    else {

      // check if email exists
      $email = $this->input->post('email', true);

      if ($this->login_model->does_exist_email($email)) {
        // generate code
        $code = $this->generate();
        $this->login_model->update_reset_code($email, $code);
        $this->sendmail($email, $code, TRUE);
      }
      else {
        echo "User does not exist";
      }
    }
  }

}
