<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {

	public function __construct() {
    parent::__construct();
    $this->load->database();
  }

  public function fetch() {
    $this->db->from('accounts')->where(array(
      'username' => $this->input->post('username', true),
      'password' => sha1($this->input->post('password', true))
    ));
    $user = $this->db->get();
    
    // if user exists
    if ($user->num_rows() == 1) {
      $user = $user->result()[0];

      // check status
      if ($user->status == 0) {
        echo 'Account access is blocked.';
        return FALSE;
      }

    }
    // else if user does not exist
    else {
      echo 'Invalid username or password.';
      return FALSE;
    }
    
    return $user;
  }

  // create account
  public function create() {
    $user = array(
      'firstname' => $this->input->post('firstname', true),
      'lastname' => $this->input->post('lastname', true),
      'username' => $this->input->post('username', true),
      'password' => sha1($this->input->post('password', true)),
      'account_access' => $this->input->post('account_access', true),
    );
    return $this->db->insert('accounts', $user);
  }
}
