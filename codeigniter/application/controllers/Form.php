<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Form extends MY_View_Controller {

  public function __construct() {
    parent::__construct();
  }
  
  public function index() {
    $this->load->library('form_validation');

    $this->form_validation->set_rules('username', 'Username', 'trim|required|alpha_numeric|min_length[5]|max_length[12]');
    $this->form_validation->set_rules('password', 'Password', 'trim|required');
    $this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required|matches[password]');
    $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

    if ($this->form_validation->run() === FALSE) {
      $this->_view('pages/form', 'Form');
    }
    else {
      $this->_view('pages/form_success');
    }

  }
}

?>