<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Item extends CI_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->helper('cookie');
    $this->load->model('item_model');
  }

  public function index() {
    $items = $this->item_model->get_items();

    $data = array(
      'title' => 'Item Records',
      'items' => $items
    );

    $this->load->view('templates/header', $data);
    $this->load->view('pages/item_records');
    
    if (!empty($this->input->cookie('msg_add'))) {
      $this->load->view('alerts/snackbar', array(
        'msg' => $this->input->cookie('msg_add')
      ));
      delete_cookie('msg_add');
    }

    $this->load->view('templates/footer');
  }

  // create item
  public function create() {
    $this->load->helper('form');
    $this->load->library('form_validation');

    $this->form_validation->set_rules('name', 'item name', 'required');
    $this->form_validation->set_rules('desc', 'item description', 'required');
    $this->form_validation->set_rules('price', 'item price', 'required');
    
    if ($this->form_validation->run() === FALSE) {
      $data['title'] = 'Add Item';
      $this->load->view('templates/header', $data);
      $this->load->view('pages/item_create');
      $this->load->view('templates/footer');
    }
    else {
      if ($this->item_model->add_item()) {
        set_cookie('msg_add', 'Item added successfully.', 60);
      }
      else {
        set_cookie('msg_add', 'An error occurred.', 60);
      }
      redirect(base_url());
    }

  }

  // update item
  public function update($slug) {
    $item = $this->item_model->get_item($slug);

    if (!$item) {
      show_404();
    }

    $data = array(
      'title' => 'Update Item',
      'item' => $item
    );

    $this->load->helper('form');
    $this->load->library('form_validation');

    $this->form_validation->set_rules('name', 'item name', 'required');
    $this->form_validation->set_rules('desc', 'item description', 'required');
    $this->form_validation->set_rules('price', 'item price', 'required');
    
    if ($this->form_validation->run() === FALSE) {
      $this->load->view('templates/header', $data);
      $this->load->view('pages/item_update');
      $this->load->view('templates/footer');
    }
    else {
      if ($this->item_model->update_item($item->item_id)) {
        set_cookie('msg_add', 'Item updated successfully.', 60);
      }
      else {
        set_cookie('msg_add', 'An error occurred.', 60);
      }
      redirect(base_url());
    }
  }
  
}

?>