<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Register_model extends SP_Model {

    function __construct() {
        $this->load->database(); 
    }

    function get_invitation_by_code($code = null) {
        if(empty($code)) return false;
		return $this->sp_call_single_result("SP_GET_INVITATION_BY_CODE('".$code."')"); //78846
    }
    
    function get_customer_by_number($number = null) {
        if(empty($number)) return false;
		return $this->sp_call_single_result("SP_GET_CUSTOMER_BY_NUMBER('".$number."', @error)");
    }

    function register_user($params) {

       	$invite_code_id = 0;
		$cloud_id = 1;
		$mod_person_id = 1;
		$error_return = '';
								  
		return $this->sp_call_single_result("SP_INSERT_ACCOUNT_REGISTRATION(
								  '".$params->invitation_code."',
								  '".$params->property_address_id."',
								  '".$params->customer_number."',
								  '".$params->first_name."',
								  '".$params->last_name."',
								  '".$params->email."',
								  '".$params->email."',
								  '".$params->phone."',
								  '".$params->pin."',
								  '".$params->password."',
								  '".$params->is_head_of_household."',
								  '".$params->mod_person_id."',								  
								  '".$params->language_iso_code."',
								  '".$params->time_zone_name."',
								    TRUE,@`_OutputId`
							)"); //$query;

    }

}
