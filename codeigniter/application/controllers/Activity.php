<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Activity extends MY_View_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->model('activity_model');
    $this->load->helper('cookie');
  }
  
  public function index() {
    // fetch data first
    $activities = $this->activity_model->fetch();
    $this->_view(array(
      'pages/records', 'alerts/snackbar'
    ), array(
      'title' => 'My Planner',
      'activities' => $activities,
      'msg' => !empty($this->input->cookie('msg')) ? $this->input->cookie('msg') : NULL
    ));
    
    if (!empty($this->input->cookie('msg'))) {
      delete_cookie('msg');
    }
  }

  // create form
  public function create() {
    $this->load->library('form_validation');

    // set rules
    $this->form_validation->set_rules('name', 'Activity Name', 'trim|required');
    $this->form_validation->set_rules('date', 'Date', 'trim|required');
    $this->form_validation->set_rules('time', 'Time', 'trim|required');

    // run
    if ($this->form_validation->run() === FALSE) {
      $this->_view('pages/create', array(
        'title' => 'Add activity'
      ));
    }
    else {
      // convert date and time to unix
      // add to list
    
      if ($this->activity_model->create()) {
        set_cookie('msg', 'Activity added successfully.', 60);
      }
      else {
        set_cookie('msg', 'An error occurred.', 60);
      }
      redirect(base_url('activity'));
      
    }
  }
}

?>