<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends SP_Model {

    function __construct() {
        $this->load->database();
    }

    function get_user($input = null) {
        if(empty($input)) return false;
		return $this->sp_call_single_result("SP_Get_User('".$input."')");
    }

    function update_user($input = null) {
        if(empty($input)) return false;
		return $this->sp_call_single_result("SP_Update_User('".$input."')");
    }

	function get_contacts($input = null) {
        if(empty($input)) return false;
		return $this->sp_call_multiple_results("SP_Get_Contacts('".$input."')");
    }
	//The following procedure is used to check the number of user in one contact.
        function count_users($input)
	{
		if(empty($input)) return false;
		return $this->sp_call_single_result("SP_GET_USER_COUNT('".$input."')");
	}
	//The following procedure is used to get the user object by phone.
	 function get_user_by_phone($contact) 
	{		
        if(empty($contact)) return false;
		return $data=$this->sp_call_single_result("SP_GET_USER_BY_PHONE('".$contact."')");		
        }
	
	//The following procedure is used to get user object by email.
	 function get_user_by_email($contact) 
	{		
        if(empty($contact)) return false;
        return $data=$this->sp_call_single_result("SP_GET_USER_BY_EMAIL('".$contact."')");		
        }
	
	//The following procedure is used to generate and store a verify code.
	function generate_otp($contact)
	{
		if(empty($contact)) return false;
		return $data=$this->sp_call_single_result("SP_Generate_VerifyCode('".$contact."')");		
	}
	 function verify_otp($code = null, $input = null) {		 
        if(empty($code)||empty($input)) return false;		
		return $this->sp_call_single_result("SP_Check_VerifyCode_exist('".$code."', '".$input."')");
	 }
	
	//The following procedure is used to check verify code with email or phone.
	function check_otp($code = null, $input = null) {
        if(empty($code)||empty($input)) return false;		
		return $this->sp_call_single_result("SP_Check_VerifyCode('".$code."', '".$input."')");
	 }
	 
	 function update_push_notification($userid = null, $enable = null)
	 {
		 return $this->sp_call_single_result("SP_Update_PushNotification('".$userid."', '".$enable."')");	 	 
	 }
}
//end
