<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserModel extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function insertUser($user){
        $this->db->insert('tbluser', $user);
    }

    public function getUser($user){
        $q = $this->db->get_where('tbluser', $user);
        return $q->row();
    }

    public function verify_code($code) {
        $this->db->from('tbluser')->where('verification_code', $code);
        $this->db->update('tbluser', array('is_verified' => 1));
        return true;
    }

    // returns the user if $email exists in database
    public function get_user_with($email) {
        $this->db->from('tbluser')->where('email', $email);
        $q = $this->db->get()->result();
        return !empty($q) ? $q[0] : FALSE;
    }

    // update user reset code
    public function update_reset_code($id, $code) {
        $this->db->from('tbluser')->where('id', $id);
        return $this->db->update('tbluser', array('reset_code' => $code));
    }
}


?>