<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Email extends MY_View_Controller {
  
  public function __construct() {
    parent::__construct();
    $this->load->model('login_model');
    $this->load->library('email');
  }

  public function verify() {
    $code = $this->uri->segment(3);
    $this->login_model->verify_email($code);
  }
  
  public function reset() {
    $code = $this->uri->segment(3);
    $id = $this->login_model->get_id_for_reset($code);

    if ($id) {
      // show reset password view
      
      $this->load->helper('form');
      $this->load->library('form_validation');

      $this->form_validation->set_rules('password', 'Password', 'trim|required');
      $this->form_validation->set_rules('confirm_password', 'Password Confirmation', 'trim|required|matches[password]');

      if ($this->form_validation->run() === FALSE) {
        $data = array(
          'title' => 'Signup',
          'id' => $id,
		  'code' => $code
        );

        $this->load->view('templates/header', $data);
        $this->load->view('pages/reset');
        $this->load->view('templates/footer');
      }
      else {
        if ($this->login_model->reset($id)) {
          echo "Password successfully reset.";
        }
        else {
          echo "An error occurred while updating password.";
        }
      }

    }
    else {
      echo "Invalid code";
    }
  }
}

