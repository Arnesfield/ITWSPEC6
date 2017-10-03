<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Activity_model extends CI_Model {

  public function __construct() {
    parent::__construct();
    $this->load->database();
  }
  
  // fetch item
  public function fetch($cond = NULL) {
    $this->db->from('activity');
    if (is_array($cond)) {
      $this->db->where($cond);
    }
    $res = $this->db->get()->result();
    return !empty($res) ? $res : FALSE;
  }
}

?>