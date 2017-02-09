<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends REST_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Register_model');
        $this->load->model('User_model');
        $this->import('classes','validate');
        $this->import('libraries','user');
        $this->import('classes','twilio');
        $this->languages=array('EN','ES');
    }
//This API provides an end point to looks up the invitation code and validate it.

//Detail: Process Invitation code and return user Address and info
function invitation_by_code_get($code=null) 
        {			
        $code=trim($code);
	if(empty($code))  $this->response(['error'=>'4100', 'type'=>'input', 'object'=>'invite_code',  'attribute'=>'invitation_code', 'message'=>'<center><b>Invitation Code Missing</b></center>Please enter the Invitation Code.']);
        if(!is_numeriC($code)) $this->response(['error'=>'4200', 'type'=>'format', 'object'=>'invite_code',  'attribute'=>'invitation_code',   'message'=>'<center><b>Invitation Code Not Numeric</b></center>Please enter the Invitation Code in numeric value']);
        if(strlen($code)!=6) $this->response(['error'=>'4250', 'type'=>'format', 'object'=>'invite_code',  'attribute'=>'invitation_code',   'message'=>'<center><b>Invitation Code Wrong Length</b></center>Please enter the Invitation Code in proper length']);

		//retrieve invitation
        $invitation = $this->Register_model->get_invitation_by_code($code);
		//verify valid invitation returned
        if(!$invitation)
            $this->response(['error'=>'5100', 'type'=>'record',  'object'=>'invite_code',  'message'=>'<center><b>Invitation Code Invalid</b><center>The Invitation code you entered is not valid.Please check your code and try again.']);
        $data = new userObject();
        $data = $validate;
        $this->response(['success'=>'<center><b>Invitation Code Valid</b><center>The Invitation code you entered is valid.', 'data'=>['InvitationCode'=>$invitation]]);
    }
//This API validate the mobile number and checks the database to make sure the number is not already registered with an account.

//Detail: Validate mobile number for uniqueness
 function user_by_phone_post() {		
		$phone = $this->post('phone');	
	 //checking email has a value or not
		if(empty($phone))	
		$this->response(['error'=>'4100', 'type'=>'input', 'object'=>'contact',  'attribute'=>'contact_content', 'message'=>'<center><b>Phone Number Missing</b></center>Please enter your phone number']);
                $vl = new validateClass($phone);
	 //phone number verification code
	        if(!$vl->isPhone())
	        $this->response(['error' => '4310','type'=>'input', 'object'=>'contact',  'attribute'=>'contact_content', 'message' => '<center><b>Phone Number Invalid</b></center>Please enter valid phone number']);	
	
	 //Looking for account avalibility against the phone number
	        $check=$this->User_model->count_users($phone);
		if($check[result]==1)
		$this->response(['error'=>'4500', 'type'=>'output', 'object'=>'contact',  'attribute'=>'contact_content', 'message'=>'<center><b>Number Already in Use<b><center><p>'.$phone.' is already registered in our system.Please enter another mobile number or log in to the account associated with the mobile number.</p>']);
	
	    //Returns the user object against phone number    
	        $data=$this->User_model->get_user_by_phone($phone);
	     //Record verification of phone number	
		if(!$data)	
                $this->response(['error' => '5100','type'=>'output', 'object'=>'contact',  'attribute'=>'contact_content', 'message' => '<center><b>Record not found</b></center>Your phone number in not found on db.']);	
		$this->response(['success'=>'Record found','type'=>'output', 'object'=>'user','data'=>$data]); 
    }
//This API validate the email address and checks the database to make sure the email is not already registered with an account.

//Detail: Validate email address for uniqueness
    function user_by_email_post() {
		$email = $this->post('email');	
	    //checking email has a value or not
		 if(empty($email))
                 $this->response(['error'=>'4600', 'type'=>'input', 'message'=>'<center><b>Email address Missing</b></center>please enter your email address.']);
                 $vl = new validateClass($email);	
	    //Email verification code
	         if(!$vl->isEmail())
		 $this->response(['error'=>'4300', 'type'=>'input', 'message'=>'<center><b>Email Invalid</b></center>Please enter the valid email address.']);	
	    //Looking for account avalibility against the email address 
	        $check=$this->User_model->count_users($email);
		if($check[result]==1)
		$this->response(['error'=>'4500','object'=>'contact',  'attribute'=>'contact_content', 'message'=>'<center><b>Email Already in Use<b><center><p>'.$email.' is already registered in our system.Please enter another email Adress or log in.</p>']);
               //Returns the user object against email address 
	        $data=$this->User_model->get_user_by_email($email);
	       //Record verification of email address
		if(!$data)	
                $this->response(['error' => '5100', 'object'=>'contact',  'attribute'=>'contact_content', 'message' => '<center><b>Record not found</b></center>Your email address is not found on db.']);	
		$this->response(['success'=>'Record found', 'object'=>'user', 'data'=>$data]); 
    }

 function create_user_get() {
        $this->response(['error' => '204', 'message' => 'POST Method Required']);
    }

//This API validates the data and creates a new account in the Hotwire DB and the Synacor Cloud ID DB

	 /*function create_user_put() {		
		
        // default simulation data
        $params = new userObject();
        $params->invitation_code = $this->put('invitation_code');
        $params->customer_number = '';
        $params->first_name = $this->put('first_name'); //'john';
        $params->last_name = $this->put('last_name'); //'smith';
        $params->phone = $this->put('phone'); //'(561) 555-1234';
        $params->email = $this->put('userId'); //'webteam@hotwiremail.com';
        $params->password = $this->put('password'); //'aBc3d7*8gL';
        $params->pin = $this->put('pin'); //'1234';
        $params->head_of_household = '1';
		$accountNumber = $this->put('accountNumber');
		$email = $this->put('userId');
		$password = $this->put('password');
		$email = $params->email;
		$postalCode= $this->put('postalCode');
		$parentalControls= $this->put('parentalControls');
		$entitlements= $this->put('entitlements');	
        
        
        $verify = ($this->post('verify')?true:false);
            
		//Check for input of all fields  
		
        $data = new userObject();
        foreach((array) $data as $k => $v){
            $data->{$k} = $params->{$k};
            if(empty($data->{$k}) && $k!='id' && $k!='customer_number' && $k!='invitation_code' && $k!='property_address_id' && $k!='property_object' && $k!='property_name')
                $this->response(['error' => '101', 'message' => 'Invalid Entry - '.$k]);
        }

		//Email and phone validation
		
        $validate = new validateClass();

        if( !$validate->isEmail($data->email))
            $this->response(['error' => '102', 'message' => '<center><b>Invalid Email Address</b></center>Your email address is not valid.']);

        if( !$validate->isPhone($data->phone))
            $this->response(['error' => '102', 'message' => '<center><b>Invalid Phone Number</b></center>Your Phone Number is not valid.']);

        $data->phone = $validate->value;

       //Create an account via Synacor Cloud ID DB

       $urlApi = "http://id-bridge.ent-web01.dev.synacor.com/userinfo/affiliates/hotwire/accounts/".$accountNumber."/users/".$email;

		if (isset($accountNumber) && isset($email) && isset($password))
			{ 
		//Array for curl input
		   $datasyn = array(
			"accountNumber" => $accountNumber,
			"userId" => $email,
			"password" => $password,
			"primary" => false,
			"postalCode" => $postalCode,
			"parentalControls" => $parentalControls,	
			"entitlements" => [
				$entitlements[0],
				$entitlements[1],
				$entitlements[2]
				]	
			);			
		$datasyn = json_encode($datasyn);

		$curl = curl_init($urlApi);

		curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
		curl_setopt($curl, CURLOPT_HEADER, false);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json',"OAuth-Token: $datasyn"));
		curl_setopt($curl, CURLOPT_POSTFIELDS, $datasyn);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		$response = curl_exec($curl);
		
		//Connection failure error from Synacor Cloud ID DB
		if (!$response) {	
			$this->response(['error'=>'4100', 'type'=>'input', 'message'=>'<center><b>Sign Up Error</b><center>Sorry,something has gone wrong.We are unable to create your account at this time.Please try again.If you continue having problems,please contact(555)-555-5555 for assistance.']);
		}
		}

        $result = $this->register_model->create_user($data);
        if(isset($result['user_id'])&&$verify)
        {
            $this->load_library('verify');
            $this->verify->send($data->email);
            $this->verify->send($data->phone);
        }
        
//Response when user registration successfull.		
        $this->response(['success'=>'Registration Successful', 'data'=>array("User"=>$result)]);

    }*/
	
	function create_user_put() {
		
        $params = new userObject();
        $params->invitation_code = $this->put('invitation_code');
        $params->customer_number = '';
        $params->first_name = $this->put('first_name'); //'john';
        $params->last_name = $this->put('last_name'); //'smith';
        $params->phone = $this->put('phone'); //'(561) 555-1234';
        $params->email = $this->put('userId'); //'webteam@hotwiremail.com';
        $params->password = $this->put('password'); //'aBc3d7*8gL';
        $params->pin = $this->put('pin'); //'1234';
        $params->head_of_household = '1';
		$accountNumber = $this->put('accountNumber');
		$email = $this->put('userId');
		$params->property_object = $this->put('property_object');
		$params->property_name= $this->put('property_name');
		$params->property_address_id= $this->put('property_address_id');
		$params->language_iso_code= $this->put('language_iso_code');
		$params->time_zone_name=$this->put('time_zone_name');
		$password = $this->put('password');
		$email = $params->email;
		$postalCode= $this->put('postalCode');
		$parentalControls= $this->put('parentalControls');
		$entitlements= $this->put('entitlements');        	
        
        $verify = ($this->put('verify')?true:false);
		  
        $data = new userObject();
        foreach((array) $data as $k => $v){
            $data->{$k} = $params->{$k};
            if(empty($data->{$k}) && $k!='id' && $k!='customer_number' && $k!='invitation_code')
                $this->response(['error' => '101', 'message' => 'Invalid Entry - '.$k]);
//                $this->response(['status' => FALSE, 'error' => '101', 'message' => 'Invalid Entry - '.$k], REST_Controller::HTTP_OK);
        }
        
        $validate = new validateClass();

        if( !$validate->isEmail($data->email))
            $this->response(['error' => '102', 'message' => 'Invalid Email Address']);

        if( !$validate->isPhone($data->phone))
            $this->response(['error' => '102', 'message' => 'Invalid Phone Number']);

        $data->phone = $validate->value;
        
        // synacor
      $urlApi = "http://id-bridge.ent-web01.dev.synacor.com/userinfo/affiliates/hotwire/accounts/".$accountNumber."/users/".$email;

		if (isset($accountNumber) && isset($email) && isset($password))
			{ 
		   $datasyn = array(
			"accountNumber" => $accountNumber,
			"userId" => $email,
			"password" => $password,
			"primary" => false,
			"postalCode" => $postalCode,
			"parentalControls" => $parentalControls,	
			"entitlements" => [
				$entitlements[0],
				$entitlements[1],
				$entitlements[2]
				]	
			);		
		$datasyn = json_encode($datasyn);

		$curl = curl_init($urlApi);

		curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
		curl_setopt($curl, CURLOPT_HEADER, false);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json',"OAuth-Token: $datasyn"));
		curl_setopt($curl, CURLOPT_POSTFIELDS, $datasyn);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		$response = curl_exec($curl);

		if (!$response) {	
			$this->response(['error'=>'4100', 'type'=>'input', 'message'=>'Connection Failure']);
		}
		}
        $result = $this->Register_model->register_user($data);
       if(isset($result['user_id'])&&$verify)
        {
            $this->load_library('verify');
            $this->verify->send($data->email);
            $this->verify->send($data->phone);
        }
           
        $this->response(['success'=>'Registration Successful', 'data'=>array("User"=>$result)]);

    }
//This API generates an OTP and SMS and send to the Mobile Number entered if the mobile number was not skipped during sign up

//Detail: Generate otp and send to mobile sms
function send_otp_by_sms_post()
{                $mobile = $this->post('mobile');           
                 $language= $this->post('language');        
                 $this->lang->load('sms',$language);
 
                 //Email verification code
                 if(empty($mobile))
                 $this->response(['error'=>'4100', 'type'=>'input', 'message'=>'<center><b>Mobile Number Missing</b></center>Please enter your mobile number.']);
                 $vl = new validateClass($mobile);             
                 if(!$vl->isPhone())
                 $this->response(['error'=>'4310', 'type'=>'input', 'message'=>'<center><b>Mobile Number Invalid</b></center>Please enter valid mobile number.']); 
 
                 //Record verification of email                                     
                 $data=$this->User_model->get_user_by_phone($mobile);                                       
                 if(!$data)                                                            
                 $this->response(['error' => '5100','object'=>'contact',  'attribute'=>'contact_content', 'message' => '<center><b>Record not found</b></center>Your mobile number is not found in db.']);  
 
                 // Gerenating OTP                   
                 $otp=$this->User_model->generate_otp($mobile);
                 $tw = new twilio();        
                 $sms_start=$this->lang->line('sms_header1'); 				 
                 $sms_msg=$this->lang->line('sms_expire');              
            	 $from ="9542800017";
				 
				 //Message Body
           	     $message= $sms_start.$otp['code'].$sms_msg; 
                 
				 //Send message from Twilio
                 $res=$tw->send_message($mobile, $from, $message);  
                 //Message successfully sent by sms				 
                 $this->response(['success'=>'<center><b>Otp is sent by sms</b></center>Otp is sent in your mobile number.']); 

}
// This API will generate an OTP and Email and send to the Email Address entered.

//Detail: Generate otp and send to email Addresss
    function send_otp_to_email_post(){
		$email = $this->post('email');				
		$language= $this->post('language')?$this->post('language'):'EN';
		$this->lang->load('signup_email_lang',$language);
		
		if(!in_array($language,$this->languages))		
			$language='EN';	
		//Email verification code
		if(empty($email))
				 $this->response(['error'=>'4100', 'type'=>'input', 'object'=>'contact',  'attribute'=>'contact_content', 'message'=>'<center><b>EmailId Missing</b></center>Please enter your emailId.']);
		$vl = new validateClass($email);	
		if(!$vl->isEmail())
		$this->response(['error'=>'4310', 'type'=>'input', 'object'=>'contact',  'attribute'=>'contact_content', 'message'=>'<center><b>Email Invalid</b></center>Please enter your valid email Address.']);	
				
		$data=$this->User_model->get_user_by_email($email);	
	        //Record verification of email	
		if(!$data)			
			$this->response(['error' => '5100','type'=>'output', 'object'=>'contact',  'attribute'=>'contact_content', 'message' => 'Record not found']);	
		// Gerenating OTP
		$otp=$this->User_model->generate_otp($email);
		
		// Mail preparation.
		
		$subject=$this->lang->line('signup_email_subject');
		$from="kritikab@chetu.com";	
		/*********Email Body******/
		$e_header=$this->lang->line('signup_email_header');
		$e_body1=$this->lang->line('signup_email_body');
		$e_body2=$this->lang->line('signup_email_body2');
                $e_body3=$this->lang->line('signup_email_body3');
               
                $message =$e_header.$data['first_name'].','.$e_body1.$data['emailaddress_login'].$e_body2.$otp['code'].$e_body3;
		
                // Mail parameter 
		$param = array('email_address'=>$email,
					'subject'=>$subject,
					'message'=>$message,
					'from'=>$from
					);		
		$this->utility->Mail_Send_Utility($param);
		//OTP is successfully sent via mail. 
        $this->response(['success'=>'<center><b>Otp is sent by email</b></center>Otp is sent in your EmailId.']); 
}

	
function user_by_customer_id($number = null) {//get user by customer number.  INCOMPLETE
		 //validate input
        if(empty($number)) $this->response(['error' => '101', 'message' => 'Invalid Entry']);
		if(!is_numeric($code)) $this->response(['error' => '101', 'message' => 'Invalid Entry']);
		//retrieve customer
        $validate = $this->Register_model->get_customer_by_number($number);
        if(!$validate)
            $this->response(['error' => '102', 'message' => 'Invalid Customer Number']);
        $data = new userObject();
//        $data->customer_number = $number;
        $data = $validate;
        $this->response(['success'=>'Customer Number is Valid', 'data'=>array("CustomerNumber"=>$data)]);
    }

}
