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

    $test = $this->fetch(array('datetime' => $unix));
    if ($test) {
      return FALSE;
    }

    return $this->db->insert('activity', $data);
  }

  // update
  public function update() {
    date_default_timezone_set('Asia/Hong_Kong');
    
    $date = $this->input->post('date', true);
    $time = $this->input->post('time', true);

    $unix = strtotime($date . ' ' . $time);

    $data = array(
      'name' => $this->input->post('name', true),
      'datetime' => $unix
    );

    $this->db->where('id', $this->input->post('id', true));
    return $this->db->update('activity', $data);
  }
}

?>