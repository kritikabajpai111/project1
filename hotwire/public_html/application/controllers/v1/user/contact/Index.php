<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Contact_model');
		$this->import('classes','validate');
    }

    public function index_get($contact_id = '') {
		//validate input
        if(empty($contact_id)){
            $this->response(['error'=>'4100', 'type'=>'input', 'object'=>'contact',  'attribute'=>'contact_id', 'message'=>'Contact ID Missing']);
        }else if(!is_numeric($contact_id)){
            $this->response(['error'=>'4200', 'type'=>'format', 'object'=>'contact', 'attribute'=>'contact_id',  'message'=>'Contact ID Not Numeric']);
        } else {
		//get contact	
            $contact = $this->Contact_model->get_contact($contact_id);
            if(empty($contact)){
                $this->response(['error'=>'5100', 'type'=>'record',  'object'=>'contact',  'message'=>'Contact Record Not Found']);
			}
            $this->response(['success'=>'Got user/contact', 'data'=>['Contact'=>$contact]]);
        }
    }

    public function index_put($contact_id = ''){

        if(empty($contact_id)){
            $this->response(['error'=>'4100', 'type'=>'input', 'object'=>'contact',  'attribute'=>'contact_id', 'message'=>'Contact ID Missing']);
        }else if(!is_numeric($contact_id)){
            $this->response(['error'=>'4200', 'type'=>'format', 'object'=>'contact', 'attribute'=>'contact_id',  'message'=>'Contact ID Not Numeric']);
        }

        $content=$this->put('content');
		 
		$checkdata=$this->Contact_model->get_contact($contact_id);
		if($checkdata== NULL)	
		{
                $this->response(['error'=>'5100', 'type'=>'record',  'object'=>'contact',  'message'=>'Contact Record Not Found']);
		}
	
		$vl = new validateClass($content);	
		if($checkdata['code']=='CONTACTTYPEMOBPHONE')
		{
            if(empty(content)){
                $this->response(['error'=>'4000', 'type'=>'input', 'object'=>'contact',  'attribute'=>'content', 'message'=>'Phone Number Missing']);
            }
			if(!$vl->isPhone())
			{
				$this->response(['error'=>'4310', 'type'=>'format',  'object'=>'contact',  'attribute'=>'content',  'message'=>'Phone Number Invalid']);
			}
			$updatedata=$this->Contact_model->update_contact($contact_id,$content);	
		}
		elseif($checkdata['code']=='CONTACTTYPEEMAIL')
		{
            if(empty(content)){
                $this->response(['error'=>'4100', 'type'=>'input', 'object'=>'contact',  'attribute'=>'content', 'message'=>'Email Address Missing']);
            }
			if(!$vl->isEmail())
			{
				$this->response(['error'=>'4300', 'type'=>'format',  'object'=>'contact',  'attribute'=>'content',  'message'=>'Email Address Invalid']);
			}
			$updatedata=$this->Contact_model->update_contact($contact_id,$content);	
			
		}	
		$this->response(['success'=>'True','data'=>['Contact'=>$updatedata]]);
	}

}
