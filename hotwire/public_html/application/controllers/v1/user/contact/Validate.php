<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Validate extends REST_Controller {

    function __construct() {
        parent::__construct();
        $this->import('classes','validate');
    }

    function index_get() {
        $this->load->helper('url');
        $this->load->view('v1/user/contact/validate');
    }

    function phone_post($phone = null) {
        $this->phone_get($this->post('phone'));
    }

    function phone_get($phone = null) {
        if(empty($phone))  $this->response(['error'=>'4100', 'type'=>'input', 'object'=>'contact',  'attribute'=>'content', 'message'=>'Phone Number Missing']);


        $validate = new validateClass($phone);
        if( !$validate->isPhone()) $this->response(['error'=>'4310', 'type'=>'format',  'object'=>'contact',  'attribute'=>'content',  'message'=>'Phone Number Format']);


        $phone = $validate->value;

        $this->load->model('contact_model');
        $result = $this->contact_model->check_contact_exists($phone);
        if($result['result']=='1')
            $this->response(['error' => '4500', 'type'=>'validation',  'object'=>'contact',  'attribute'=>'content', 'message' => 'Phone Number is already used']);

        $this->response(['success'=>'Phone Number is Valid', 'data'=>array("Phone"=>$validate->value)]);
    }

    function email_post($email = null) {
        $this->email_get($this->post('email'));
    }

    function email_get($email = null) {
        if(empty($email))  $this->response(['error'=>'4100', 'type'=>'input', 'object'=>'contact',  'attribute'=>'content', 'message'=>'Email Address Missing']);


        $validate = new validateClass($email);
        if( !$validate->isEmail()) $this->response(['error'=>'4300', 'type'=>'format',  'object'=>'contact',  'attribute'=>'content',  'message'=>'Email Address Format']);


        $this->load->model('contact_model');
        $result = $this->contact_model->check_contact_exists($email);
        if($result['result']=='1')
            $this->response(['error' => '4500', 'type'=>'validation',  'object'=>'contact',  'attribute'=>'content', 'message' => 'Email Address is already used']);

        $this->response(['success'=>'Email Address is Valid', 'data'=>array("Email"=>$email)]);

    }

}
