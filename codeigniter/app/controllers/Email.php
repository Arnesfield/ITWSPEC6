<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Email extends CI_Controller {
  
  public function __construct() {
    parent::__construct();
    $this->load->model('login_model');
    $this->load->library('email');
  }

  public function verify() {
    $code = $this->uri->segment(3);

    $this->login_model->verify_email($code);
  }
}

