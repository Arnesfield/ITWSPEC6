<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Activity extends MY_View_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->model('activity_model');
  }
  
  public function index() {
    // fetch data first
    $activities = $this->activity_model->fetch();
    $this->_view('pages/records', array(
      'title' => 'My Planner',
      'activities' => $activities
    ));
  }
}

?>