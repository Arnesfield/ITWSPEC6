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

      // check email
      if ($user->is_verified == 0) {
        echo 'Account is not verified.';
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
  public function create($email_verification) {
    $user = array(
      'firstname' => $this->input->post('firstname', true),
      'lastname' => $this->input->post('lastname', true),
      'username' => $this->input->post('username', true),
      'email' => $this->input->post('email', true),
      'verification_code' => $email_verification,
      'password' => sha1($this->input->post('password', true)),
      'account_access' => $this->input->post('account_access', true),
    );
    return $this->db->insert('accounts', $user);
  }

  public function verify_email($code) {
    $this->db->from('accounts')->where(array(
      'verification_code' => $code,
      'is_verified' => 0
    ));
    $user = $this->db->get();
    
    // if user exists
    if ($user->num_rows() == 1) {
      $data = array(
        'is_verified' => 1
      );
      $this->db->where('verification_code', $code);
      echo 'Email verified.';

      return $this->db->update('accounts', $data);
    }
    else {
      echo "No user found";
    }

    return FALSE;
  }

  public function get_id_for_reset($code) {
    $this->db->from('accounts')->where(array(
      'reset_code' => $code
    ));
    $user = $this->db->get();

    return $user->num_rows() == 1 ? $user->result()[0]->user_id : FALSE;
  }

  public function reset($id) {
    $data = array(
      'password' => sha1($this->input->post('password', true))
    );
    $this->db->where('user_id', $id);
    return $this->db->update('accounts', $data);
  }

  public function does_exist_email($email) {
    $this->db->from('accounts')->where(array(
      'email' => $email
    ));
    $user = $this->db->get();

    return $user->num_rows() == 1;
  }

  public function update_reset_code($email, $code) {
    $data = array(
      'reset_code' => $code
    );
    $this->db->where('email', $email);
    return $this->db->update('accounts', $data);
  }
}
