<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Contract extends REST_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Contract_model');
    }

    function index_get() {
        $this->load->helper('url');
        $this->load->view('v1/contract');
    }

     public function privacy_policy_get($lang='EN') { 
     $lang = $this->get_input('lang');
     $lang_array = array('EN', 'ES');
     if(!in_array($lang,$lang_array))  $this->response(['error'=>'4600', 'type'=>'language', 'message'=>'Language Not Supported']);

	   $contract_data =  $this->Contract_model->get_privacy_policy($lang);
         if($contract_data== NULL)
         {
             $this->response(['error'=>'5100', 'type'=>'record',  'object'=>'contract',  'message'=>'Privacy Policy Not Found']);
         }
       $this->response(['success'=>'True', 'data'=>array("PP"=>$contract_data['text'])]);
    }
    
    public function terms_of_service_get($lang='EN') { 
	    //added lang array for languages. We can add multiple language but for now we are considering only eng langage.
        
         $lang_array = array('EN', 'ES');
        if(!in_array($lang,$lang_array)) $this->response(['error'=>'4600', 'type'=>'language', 'message'=>'Language Not Supported']);
        $contract_data =  $this->Contract_model->get_terms_of_service($lang);
        if($contract_data== NULL)
        {
            $this->response(['error'=>'5100', 'type'=>'record',  'object'=>'contract',  'message'=>'TOS Not Found']);
        }
        $this->response(['success'=>'True', 'data'=>array("TOS"=>$contract_data['text'])]);
    }
	
    public function retrieve_get($contract_type, $lang="EN") { 
	    //added lang array for languages. We can add multiple language but for now we are considering only eng langage.
		
         $lang_array = array('EN', 'ES');
        if(!in_array($lang,$lang_array) && empty($contract_type)) $this->response(['error'=>'4600', 'type'=>'language', 'message'=>'Language Not Supported']);
	    $contract_data=$this->Contract_model->get_contract($contract_type, $lang);

        if($contract_data== NULL)
        {
            $this->response(['error'=>'5100', 'type'=>'record',  'object'=>'contract',  'message'=>'Contract Not Found']);
        }

	$this->response(['success'=>'True','data'=>array(strtoupper($contract_type)=>$contract_data['text'])]);
    }

    function list_get() {
        $this->response(['success'=>'Contract Types', 'data'=>array("ContractTypes"=>$this->contract_model->get_contract_types())]);
    }

}
