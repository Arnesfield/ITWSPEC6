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
    $this->db->order_by('datetime', 'desc');
    $res = $this->db->get()->result();
    return !empty($res) ? $res : FALSE;
  }

  // add
  public function create() {
    date_default_timezone_set('Asia/Hong_Kong');

    $date = $this->input->post('date', true);
    $time = $this->input->post('time', true);

    $unix = strtotime($date . ' ' . $time);

    $data = array(
      'name' => $this->input->post('name', true),
      'datetime' => $unix
    );

    return $this->db->insert('activity', $data);
  }
}

?>