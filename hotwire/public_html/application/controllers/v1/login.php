<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends REST_Controller {

   function __construct() {
        parent::__construct();
		$this->languages=array('EN','ES');
        $this->import('classes','validate');		
		$this->load->model('User_model');
		//$this->import('classes','utility');
		$this->load->library('utility');
		$this->import('classes','twilio');
				
    }
function password_reset_by_email_get() {
		$this->response(['error' => '204', 'message' => 'POST Method Required'], REST_Controller::HTTP_OK);
	}	
	
//process email and search for user account,generate otp and send to email
	
function password_reset_by_email_post() {
	
	    //input
		$email = $this->post('email');			
		$language= $this->post('language')?$this->post('language'):'EN';
		$this->lang->load('email_lang',$language);
		
		if(!in_array($language,$this->languages))		
			$language='EN';		
		
	    //Email verification code
		 if(empty($email))
                 $this->response(['error'=>'4600', 'type'=>'input', 'message'=>'Email address Missing#Please enter your email address.']);
                 $vl = new validateClass($email);	    
	     if(!$vl->isEmail())
		 $this->response(['error'=>'4300', 'type'=>'input', 'message'=>'Email address Invalid#Your email address is not valid.']);	
	    
		
		//Looking for account avalibility against the email address 
	     $check=$this->User_model->count_users($email);		 
		 if($check['result']==1)
		 $this->response(['error'=>'4500', 'type'=>'output', 'object'=>'contact',  'attribute'=>'contact_content', 'message'=>'EmailId Already in Use#'.$email.' is already registered in our system.Please enter another mobile number or log in to the account associated with the mobile number.']);
        
		//returns user object
	    $data=$this->User_model->get_user_by_email($email);
		
		
	    //Record verification of email address
		if(!$data)	
                $this->response(['error' => '5100','type'=>'output', 'object'=>'contact',  'attribute'=>'contact_content', 'message' => 'Record not found#Your email address is not found in db']);	
		
							
		// Gerenating OTP
		$otp=$this->User_model->generate_otp($email);
		
		// Mail preparation.
		
		$subject=$this->lang->line('email_sub');
		$from="kritikab@chetu.com";	
		/*********Email Body******/
		$e_header=$this->lang->line('email_header');
		$e_body1=$this->lang->line('email_body1');
		$e_body2=$this->lang->line('email_body2');
		$message = $e_header.$data['first_name'].','.$e_body1.$otp['code'].$e_body2;
		
		// Mail parameter 
		$param = array('email_address'=>$email,
					'subject'=>$subject,
					'message'=>$message,
					'from'=>$from
					);
		
		$this->utility->Mail_Send_Utility($param);		
		$this->response(['success'=>'Your password is reset','type'=>'output', 'object'=>'user']); 

	
	}
	function password_reset_by_mobile_get() {
		$this->response(['error' => '204', 'message' => 'POST Method Required'], REST_Controller::HTTP_OK);
	}
	
//process Mobile Number and search for user account,generate otp and send to email
	
function password_reset_by_mobile_post() {
	
	    //input
		$mobile = $this->post('mobile');           
      $language= $this->post('language')?$this->post('language'):'EN';		
		if(!in_array($language,$this->languages))		
			$language='EN';
		$this->lang->load('sms',$language);
		
		
	    //phone number verification code
		if(empty($mobile))	
			$this->response(['error'=>'4100', 'type'=>'input', 'object'=>'contact',  'attribute'=>'contact_content', 'message'=>'Mobile Number Missing#Please enter your mobile number.']);
        $vl = new validateClass($mobile);
	    if(!$vl->isPhone())
	        $this->response(['error' => '4310','type'=>'input', 'object'=>'contact',  'attribute'=>'contact_content', 'message' => 'Mobile number Invalid#Mobile number is not valid.']);	
		
	   //Looking for account avalibility against the phone number
	    $check=$this->User_model->count_users($mobile);
		if($check['result']==1)
		$this->response(['error'=>'4500', 'type'=>'output', 'object'=>'contact',  'attribute'=>'contact_content', 'message'=>'Number Already in Use'.$mobile.' is already registered in our system.Please enter another mobile number or log in to the account associated with the mobile number.']);
          
	    //Returns the user object against phone number    
	        $data=$this->User_model->get_user_by_phone($mobile);
			
	    //Record verification of phone number	
		if(!$data)	
                $this->response(['error' => '5100','type'=>'output', 'object'=>'contact',  'attribute'=>'contact_content', 'message' => 'Record not found#Your mobile number '.$mobile.'  is not found in our db.']);	
				
		// Gerenating OTP                   
                 $otp=$this->User_model->generate_otp($mobile);
                //$tw = new twilio();        
                 $sms_start=$this->lang->line('sms_header'); 				 
                 $sms_msg=$this->lang->line('sms_otp');              
            	 $from ="9542800017";
		//Message body
           	     $message= $sms_start.$data['first_name']."<br>".$sms_msg.$otp['code'];				  				 
        //Mail sent by Twilio				 
                 //$tw->send_message($mobile, $from, $message);                  					 
                 $this->response(['success'=>'Your password is reset','type'=>'output','data'=>$message]);				 
                 
	
	}
	function verify_phone_by_otp_get() {
		$this->response(['error' => '204', 'message' => 'POST Method Required'], REST_Controller::HTTP_OK);
	}
//This function is used to verify otp pin

function verify_phone_by_otp_post()
{
$mobile = $this->post('mobile');	
$otp= $this->post('otp');
	
 if(empty($mobile))
     $this->response(['error'=>'4100', 'type'=>'input', 'message'=>'Mobile Number Missing#Please enter your mobile number.']);
     $vl = new validateClass($mobile);             
        if(!$vl->isPhone())
        $this->response(['error'=>'4310', 'type'=>'input', 'message'=>'Mobile Number Invalid#Your mobile number is not valid.']); 	
if(empty($otp))
$this->response(['error'=>'4100', 'type'=>'input', 'message'=>'OTP Missing#Please enter your OTP pin.']);	
$record=$this->User_model->verify_otp($otp,$mobile);
if($record['record']==0)	
$this->response(['error'=>'5100', 'type'=>'input', 'message'=>'Record not found#Your account is not found in db.']);	
$verify=$this->User_model->check_otp($otp,$mobile);
$data=$this->User_model->get_user_by_email($mobile);
$userId=$data['emailaddress_login'];
if($verify['verified']==1)
$this->response(['success'=>'OTP verified#Your otp is verified.','object'=>'user']);
elseif($verify['expired']==1)
$this->response(['error'=>'4310', 'message'=>'OTP expired#Your otp is expired.']);
}
	function verify_email_by_otp_get() {
		$this->response(['error' => '204', 'message' => 'POST Method Required'], REST_Controller::HTTP_OK);
	}
//This function is used to verify otp pin

function verify_email_by_otp_post()
{
$email = $this->post('email');	
$otp= $this->post('otp');
$vl = new validateClass($email);
if(empty($email))
$this->response(['error'=>'4100', 'type'=>'input', 'message'=>'EmailId Missing#Please enter your email Address.']);				
if(!$vl->isEmail())
$this->response(['error'=>'4310', 'type'=>'input', 'message'=>'EmailId Invalid#Your Email address is not valid.']);
if(empty($otp))
$this->response(['error'=>'4100', 'type'=>'input', 'message'=>'OTP Missing#Please enter your OTP pin.']);	
$record=$this->User_model->verify_otp($otp,$email);	
if($record['record']==0)	
$this->response(['error'=>'5100', 'type'=>'input', 'message'=>'Record not found#Your email address is not found in db.']);	
$verify=$this->User_model->check_otp($otp,$email);
$data=$this->User_model->get_user_by_email($email);
$userId=$data['emailaddress_login'];
if($verify['verified']==1)
$this->response(['success'=>'OTP verified#Your otp is verified.','object'=>'user']);
elseif($verify['expired']==1)
$this->response(['error'=>'4310', 'message'=>'OTP expired#Your otp is expired.']);
	
}

	function username_recovery_by_email_get() {
		$this->response(['error' => '204', 'message' => 'POST Method Required'], REST_Controller::HTTP_OK);
	}
	//Process Email Address,search for user account.Generate email with username and send to email address.
function username_recovery_by_email_post(){
	    $email = $this->post('email');	
	   $language= $this->post('language')?$this->post('language'):'EN';		
		if(!in_array($language,$this->languages))		
			$language='EN';
		$this->lang->load('usernotification',$language);
	    
		//checking email has a value or not
		if(empty($email))
            $this->response(['error'=>'4600', 'type'=>'input', 'message'=>'Email address Missing#Please enter your email address.']);
            $vl = new validateClass($email);	
	    
		//Email verification code
	        if(!$vl->isEmail())
		 $this->response(['error'=>'4300', 'type'=>'input', 'message'=>'Email address Invalid#Email address is not valid.']);	
	    
		//Looking for account avalibility against the email address 
	    $check=$this->User_model->count_users($email);
		if($check['result']==1)
		$this->response(['error'=>'4500','object'=>'contact',  'attribute'=>'contact_content', 'message'=>'EmailId Already in Use#'.$email.' is already registered in our system.Please enter another mobile number or log in to the account associated with the mobile number.']);
        
		//Returns the user object against email address 
	        $data=$this->User_model->get_user_by_email($email);
	       //Record verification of email address
		if(!$data)	
            $this->response(['error' => '5100','object'=>'contact',  'attribute'=>'contact_content', 'message' => 'Record not found#Your email address is not found on db.']);	
	
		// Mail preparation.
		
		$subject=$this->lang->line('usernotify_sub');
		$from="kritikab@chetu.com";	
		
		/*********Email Body******/
		$e_header=$this->lang->line('usernotify_header');
		$e_body1=$this->lang->line('usernotify_body1');
		$e_body2=$this->lang->line('usernotify_body2');
		$message = $e_header.$data['first_name'].','.$e_body1.$data['emailaddress_login'].$e_body2;
		
		// Mail parameter 
		$param = array('email_address'=>$email,
					'subject'=>$subject,
					'message'=>$message,
					'from'=>$from
					);
	$response="We sent the username to ".$email;
        $this->utility->Mail_Send_Utility($param);	
		$this->response(['success'=>$response,'type'=>'output', 'object'=>'user']); 
			
}
	function username_recovery_by_sms_get() {
		$this->response(['error' => '204', 'message' => 'POST Method Required'], REST_Controller::HTTP_OK);
	}
//Process Mobile Number,search for user account.Generate sms with username and send to email address.
function username_recovery_by_sms_post(){
	    $mobile = $this->post('mobile');           
        $language= $this->post('language')?$this->post('language'):'EN';		
		if(!in_array($language,$this->languages))		
			$language='EN';       
        $this->lang->load('sms',$language);
 
        //Email verification code
        if(empty($mobile))
        $this->response(['error'=>'4100', 'type'=>'input', 'message'=>'Mobile Number Missing#Please enter your mobile number.']);
        $vl = new validateClass($mobile);             
        if(!$vl->isPhone())
        $this->response(['error'=>'4310', 'type'=>'input', 'message'=>'Mobile Number Invalid#Please enter your valid mobile number.']); 
 
        //Record verification of email                                     
        $data=$this->User_model->get_user_by_phone($mobile);                                       
        if(!$data)                                                            
        $this->response(['error' => '5100','object'=>'contact',  'attribute'=>'contact_content', 'message' => 'Record not found#Your mobile number is not found in db.']);  
        //$tw = new twilio();     
        $sms_start=$this->lang->line('sms_header'); 				 
        $sms_msg=$this->lang->line('sms_user');              
        $from ="9542800017";
        $message= $sms_start.$data['first_name']."<br>".$sms_msg.$data['emailaddress_login'];  
		//$tw->send_message($mobile, $from, $message); 
	$response="We sent the username to ".$mobile;
        $this->response(['success'=>$response,'type'=>'output', 'object'=>'user','data'=>$message]);		
                  
}
	
	function password_change_get() {
		$this->response(['error' => '204', 'message' => 'POST Method Required'], REST_Controller::HTTP_OK);
	}
//Update Password and send password reset Notification Email.	
function password_change_put()
{
// Assume input is coming from Billing System.
		$accountNumber = $this->put('accountNumber');
		$userId = $this->put('userId');
		$password = $this->put('password');
		$postalCode= $this->put('postalCode');
		$parentalControls= $this->put('parentalControls');
		$entitlements= $this->put('entitlements');
		$email = $this->put('email');	
		$language= $this->put('language')?$this->put('language'):'EN';			
		if(!in_array($language,$this->languages))		
			$language='EN';
	
		$urlApi = "http://id-bridge.ent-web01.dev.synacor.com/userinfo/affiliates/hotwire/accounts/".$accountNumber."/users/".$userId;

		if (isset($accountNumber) && isset($userId) && isset($password))
			{ 
		   $data = array(
			"accountNumber" => $accountNumber,
			"userId" => $userId,
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
	
		$data = json_encode($data);

		$curl = curl_init($urlApi);

		curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
		curl_setopt($curl, CURLOPT_HEADER, false);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json',"OAuth-Token: $data"));
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		$response = curl_exec($curl);	
		
		if (!$response) {	
			$this->response(['error'=>'4100', 'type'=>'input', 'message'=>'Connection Failure']);
		}
		}
		$this->lang->load('notificationemail',$language);
		//Email verification code
		if(empty($email))
				 $this->response(['error'=>'4100', 'type'=>'input', 'message'=>'EmailId Missing#Please enter your email address.']);
		$vl = new validateClass($email);	
		if(!$vl->isEmail())
			     $this->response(['error'=>'4310', 'type'=>'input', 'message'=>'EmailId is not valid']);		
		
		//Record verification of email	
		
		$data=$this->User_model->get_user_by_email($email);	
		if(!$data)			
		$this->response(['error' => '5100','object'=>'contact',  'attribute'=>'contact_content', 'message' => 'Record not found#Your email address is not found in db.']);	
	
		// Mail preparation.		
		$subject=$this->lang->line('nemail_sub');
		$from="kritikab@chetu.com";	
		
		/*********Email Body******/
		$e_header=$this->lang->line('nemail_header');
		$e_body1=$this->lang->line('nemail_body1');
		$e_body2=$this->lang->line('nemail_body3');
		$message = $e_header.$data['first_name'].','.$e_body1.$e_body2;
		
		// Mail parameter 
		$param = array('email_address'=>$email,
				'subject'=>$subject,
				'message'=>$message,
				'from'=>$from
				);
		
		$ut = $this->utility->Mail_Send_Utility($param);
        $this->response(['success'=>$response,'type'=>'output', 'object'=>'user']); 
    		  

	}

}
