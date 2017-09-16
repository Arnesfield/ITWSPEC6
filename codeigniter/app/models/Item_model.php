<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Item_model extends CI_Model {
  
  public function __construct() {
    parent::__construct();
    $this->load->database();
  }

  public function get_items() {
    $this->db->from('tbl_item');
    $this->db->where('item_status', '1');
    $this->db->order_by('item_added_at', 'desc');
    $query = $this->db->get();
    return $query->result();
  }

  public function create_slug($name) {
    $count = 0;
    $slug = $name = url_title($name, '-', TRUE);
    while(true) {
      $this->db->from('tbl_item')->where('item_slug', $slug);
      if ($this->db->count_all_results() == 0)
        break;
      $slug = $name . '-' . (++$count);
    }
    return $slug;
  }

  public function add_item() {
    $slug = $this->create_slug($this->input->post('name', true));

    $data = array(
      'item_name' => $this->input->post('name', true),
      'item_desc' => $this->input->post('desc', true),
      'item_price' => $this->input->post('price', true),
      'item_added_at' => time(),
      'item_updated_at' => time(),
      'item_slug' => $slug,
      'item_status' => '1'
    );

    return $this->db->insert('tbl_item', $data);
  }

}

?>