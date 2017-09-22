<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {

	public function __construct() {
    parent::__construct();
    $this->load->database();
  }

  public function fetch($username, $password) {
    $this->db->from('accounts')->where(array(
      'username' => $username,
      'password' => $password
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
}
