<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Contract_model extends SP_Model {

    function __construct() {
        $this->load->database(); 
    }

    function get_contract($contract_code = 'TOS', $language_code = 'EN') {
        if(empty($contract_code||$language_code)) return false;
		return $this->sp_call_single_result("SP_Get_Contract('".$contract_code."', '".$language_code."')");
    }

	function get_contract_types() {
		return $this->sp_call_multiple_results("SP_Get_ContractTypes()");
    }

    function get_terms_of_service($language_code = 'EN') {
        if(empty($language_code)) return false;
		return $this->sp_call_single_result("SP_Get_Contract_TOS('".$language_code."')");
    }

	function get_privacy_policy($language_code = 'EN') {
        if(empty($language_code)) return false;
		return $this->sp_call_single_result("SP_Get_Contract_PP('".$language_code."')");
    }

}
