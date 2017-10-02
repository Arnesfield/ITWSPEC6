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

    // returns true if $email exists in database
    public function does_email_exist($email) {
        $this->db->from('tbluser')->where('email', $email);
        $q = $this->db->get();
        return $q->num_rows();
    }
}


?>