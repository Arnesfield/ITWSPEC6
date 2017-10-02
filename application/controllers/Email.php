<?php

class Email extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('email');
        $this->load->model('UserModel');
        $this->load->database();
    }

    public function verify() {
        $code = $this->uri->segment(3);
        if ($this->UserModel->verify_code($code)) {
            echo "Account verified";
        }
        
    }
    
    
    public function generate(){
        $this->load->helper('string');
        
        echo random_string('alnum',rand(5,15));
        
    }

    public function sendemail() {

        $this->email->from("charlynannn@gmail.com", 'Cha');
        $this->email->to('charlynannn@gmail.com');
        $this->email->subject('Email Test');
        
        $data = array('name' => "Ben", 'body' => "Welcome to CI from W31",'code'=>"asd123");
        $this->email->message($this->load->view('welcome_message',$data,true));

        
        if(! $this->email->send()){
            $this->email->print_debugger();
        }else{
            echo "Email was sent";
        }
    }

}
