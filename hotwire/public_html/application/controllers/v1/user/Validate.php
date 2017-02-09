<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Validate extends REST_Controller {

    function __construct() {
        parent::__construct();
        $this->import('classes','validate');
    }


    function username_post() {//Does not actually validate
        $username = $this->post('username');
        if(empty($username)) $this->response(['error'=>'4100', 'type'=>'input', 'object'=>'user',  'attribute'=>'username', 'message'=>'Username Missing']);

        $validate = new validateClass($username);
        if( !$validate->isString()) $this->response(['error'=>'4500', 'type'=>'validation', 'object'=>'user',  'attribute'=>'username', 'message'=>'Username Already Exists']);

        $this->response(['success'=>'Username is Valid', 'data'=>array("Username"=>$username)]);

    }



}
