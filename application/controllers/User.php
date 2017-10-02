<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    // change this for email (same with config/email.php)
    private $_EMAIL = "mail.arnesfield@gmail.com";

    public function __construct(){
        parent:: __construct();
        $this->load->model('UserModel');
        $this->load->helper('url');
        $this->load->library(array('form_validation','session'));
        $this->load->database();
        $this->load->library('email');
    }

    public function index(){
        

        $this->load->view('includes/header');
        $this->load->view('includes/navbar');
        $this->load->view('user/index');
        $this->load->view('includes/footer');
    }

    public function do_login(){
        $data = array(
            'email' => $this->input->post('email'),
            'password' => sha1($this->input->post('password'))
        );

        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        
        if ($this->form_validation->run() == FALSE)
        {
                $this->index();
        }
        else
        {
                $user = $this->UserModel->getUser($data);
                //print_r($user); die();
                if($user != NULL){
                    if ($user->status != 1) {
                        $this->index();
                        echo "<script>alert('Account access denied.')</script>";
                    }
                    else if ($user->is_verified != 1) {
                        $this->index();
                        echo "<script>alert('Account not verified.')</script>";
                    }
                    else {
                        $newdata = array(
                            'email'     => $data['email'],
                            'logged_in' => TRUE
                        );
                        
                        $this->session->set_userdata($newdata);
                        redirect('user/dashboard');
                    }
                    
                }
                else{
                    
                    $this->index();
                    echo "<script>alert('No user found')</script>";
                }
        }
    }

    public function register(){
        
        $this->load->view('includes/header');
        $this->load->view('includes/navbar');
        $this->load->view('user/register');
        $this->load->view('includes/footer');
    }
    
    public function dashboard(){
        if($this->session->logged_in){
            $this->load->view('includes/header');
            $this->load->view('includes/navbar');
            $this->load->view('user/dashboard');
            $this->load->view('includes/footer');
        }else{
            redirect('user/index');
        }
        
    }

    public function logout(){
        $this->session->sess_destroy();
        redirect('user/index');
    }

    public function do_register(){

        $this->form_validation->set_rules('name', 'Name', 'required|min_length[3]|is_unique[tbluser.name]');
        $this->form_validation->set_rules('email', 'Email', 'required|is_unique[tbluser.email]|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('repassword', 'Confirm Password', 'required|matches[password]');

        if ($this->form_validation->run() == FALSE)
        {
                $this->register();
        }
        else
        {
            $verification_code = $this->generate();
            $email = $this->input->post('email');

            $data = array(
                'name' => $this->input->post('name'),
                'email' => $email,
                'password' => sha1($this->input->post('password')),
                'account_access' => $this->input->post('type_account'),
                'verification_code' => $verification_code
            );
            
            $this->sendemail($email, $verification_code);
            $this->UserModel->insertUser($data);
            // redirect('user/index');
        }

        
    }

    public function edit(){

    }

    public function do_edit(){

    }



    public function generate(){
        $this->load->helper('string');
        return random_string('alnum',rand(5,15));
    }

    public function sendemail($to, $code) {

        $this->email->from($this->_EMAIL, 'Cha');
        $this->email->to($to);
        $this->email->subject('Email Test');
        
        $data = array('name' => "Ben", 'body' => "Welcome to CI from W31",'code'=>$code);
        $this->email->message($this->load->view('welcome_message',$data,true));

        
        if(! $this->email->send()){
            $this->email->print_debugger();
        }else{
            echo "Email was sent";
        }
    }

    public function forgot() {
        // add form validtion for email
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

        // if fields are not valid
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('user/forgot');
        }
        // successful submit
        else {
            // check if email exists in database
            // if exists, send email for reset password
            // else, show error

            $email = $this->input->post('email', true);
            
            // if email exists
            if ($user = $this->UserModel->get_user_with($email)) {
                // first, generate code
                // create field in tblusers named 'reset_code'
                // update $user 'reset_code' field with generated code
                // send email for reset password

                $code = $this->generate();

                $this->UserModel->update_reset_code($user->id, $code);
                $this->send_reset_to($email, $code);
            }
            else {
                echo "User not found";
            }
        }
    }
    
    // send email for reset password
    public function send_reset_to($email, $code) {
        // credentials
        $this->email->from($this->_EMAIL, 'Cha');
        $this->email->to($email);
        $this->email->subject('Reset Password');
        $data = array('code' => $code);
        $this->email->message($this->load->view('user/email/reset',$data,true));
        
        if(! $this->email->send()){
            echo $this->email->print_debugger();
        }else{
            echo "Email was sent";
        }
    }

    // function for views/user/email/reset.php
    public function reset() {
        // get 3rd segment (the code)
        $code = $this->uri->segment(3);

        // get user with $code
        if ($user = $this->UserModel->get_user_with_code($code)) {
            $this->reset_password($user);
        }
        // if user does not exist
        else {
            echo "User not found";
        }
    }

    // reset password form here
    public function reset_password($user = NULL) {

        // form validation
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('repassword', 'Confirm Password', 'required|matches[password]');

        if ($this->form_validation->run() == FALSE) {
            // display form with reset password
            // if form was submitted, use id from form instead
            $data = array(
                'user_id' => !empty($this->input->post()) ? $this->input->post('user_id') : $user->id
            );

            // load view for reset password
            $this->load->view('user/reset_password', $data);
        }
        // if reset is successful
        else {
            // update password using post(user_id)
            $this->UserModel->reset_password();
            echo "Password successfully reset!";
        }
    }
}


?>