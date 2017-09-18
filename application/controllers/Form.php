<?php

class Form extends CI_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->view('templates/header');
  }

	public function index() {
    $this->load->view('pages/form1');
    $this->load->view('templates/footer');
  }

  public function no1() {
    $this->load->view('pages/form1');
    $this->load->view('templates/footer');
  }

  public function no2() {
    $this->load->view('pages/form2');
    $this->load->view('templates/footer');
  }

  public function no3() {
    $this->load->view('pages/form3');
    $this->load->view('templates/footer');
  }

  // actions
  public function action1() {
    $n = $this->input->post('length');

    for ($i = 0; $i < $n; $i++) {
      $m = floor($i / 4) * 10 + pow(2, $i - floor($i / 4) * 4);
      if ($m > $n) break;
      echo $m . ' ';
    }

  }

  public function action2() {
    $n = $this->input->post('length');
    $x = 1;

    for ($i = -1; $i < $n; $i++) {
      
      if ($i > -1) {
        $m = pow(2, $i - floor($i / 3) * 3);
        $x += $m;
      }
      
      if ($x > $n) break;
      echo $x . ' ';
    }
  }
  
  public function action3() {
    $n = $this->input->post('length');
    $m = $this->input->post('partner');

    // start of second
    $x = $n / 2;

    // check for second col
    if ($m >= $x) {
      echo $m - $x;
    }

    // check for first
    else {
      echo $m + $x;
    }

  }

}
