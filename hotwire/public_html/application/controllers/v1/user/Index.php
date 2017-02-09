<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Contact_model');

    }

    public function index_get($id = null) {

        if(empty($id)){
            $this->response(['error'=>'4100', 'type'=>'input', 'object'=>'user',  'attribute'=>'user_id', 'message'=>'User ID Missing']);
        }else if(!is_numeric($id)){
            $this->response(['error'=>'4200', 'type'=>'format', 'object'=>'user', 'attribute'=>'user_id',  'message'=>'User ID Not Numeric']);
        }

            $user = $this->User_model->get_user($id);

            if($user== NULL)
            {
                $this->response(['error'=>'5100', 'type'=>'record',  'object'=>'user',  'message'=>'User Record Not Found']);
            }

            $user['contacts'] = $this->Contact_model->get_contacts($id);
            $this->response(['success'=>'Got user', 'data'=>['User'=>$user]]);

    }



}
