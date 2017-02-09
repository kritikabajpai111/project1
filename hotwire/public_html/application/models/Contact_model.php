<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Contact_model extends SP_Model {

    function __construct() {
        $this->load->database(); 
    }

    function check_contact_exists($input = null) {
        if(empty($input)) return false;
		return $this->sp_call_single_result("SP_Check_ContactExists('".$input."')");
    }

    function get_contact($input = null) {
        if(empty($input)) return false;
		return $this->sp_call_single_result("SP_Get_Contact('".$input."')");
    }

	function get_contacts($input = null) {
        if(empty($input)) return false;
		return $this->sp_call_multiple_results("SP_Get_Contacts('".$input."')");
    }
	
 function update_contact($contact_id,$content) {
				
		$this->sp_call_single_result("SP_UPDATE_CONTACT('".$contact_id."','".$content."')");      
        return $this->sp_call_single_result("SP_GET_CONTACT('".$contact_id."')");								  
		
    }
    

	function get_contact_types() {
		return $this->sp_call_multiple_results("SP_Get_ContactTypes()");
    }

}
