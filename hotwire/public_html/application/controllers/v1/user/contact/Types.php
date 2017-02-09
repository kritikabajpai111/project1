<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Types extends REST_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('contact_model');
    }

    function index_get() {
        $this->response(['success'=>'Contact Types', 'data'=>array("ContactTypes"=>$this->contact_model->get_contact_types())]);
    }

}
