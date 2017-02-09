<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Firstlogin extends REST_Controller {

    function __construct() {
        parent::__construct();
       $this->load->model('User_model');	  
    }
	
	function get_sdk_authentication_get($username)
	{
		
$url="http://id-bridge.ent-web01.dev.synacor.com/userinfo/affiliates/hotwire/accounts/7867645/users/".$username;		
//  Initiate curl
$ch = curl_init();
// Disable SSL verification
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
// Will return the response, if false it print the response
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// Set the url
curl_setopt($ch, CURLOPT_URL,$url);
// Execute
$result=curl_exec($ch);
// Closing
curl_close($ch);
if($result)
{
	$this->response(['success'=>'User Authenticated','object'=>'user']);
}
// Will dump a beauty json :3
//var_dump(json_decode($result, true));
}
	
	function verify_otp_by_phone_post()
{
$mobile = $this->post('mobile');	
$otp= $this->post('otp');
	
 if(empty($mobile))
     $this->response(['error'=>'4100', 'type'=>'input', 'message'=>'<center><b>Mobile Number Missing<b><center><p>Please enter your mobile number.</p>']);
     $vl = new validateClass($mobile);             
        if(!$vl->isPhone())
        $this->response(['error'=>'4310', 'type'=>'input', 'message'=>'<center><b>Mobile Number Invalid<b><center><p>Your mobile number is not valid.</p>']); 	
if(empty($otp))
$this->response(['error'=>'4100', 'type'=>'input', 'message'=>'<center><b>OTP Missing<b><center><p>Please enter your OTP pin.</p>']);	
$record=$this->User_model->verify_otp($otp,$mobile);
if($record['record']==0)	
$this->response(['error'=>'5100', 'type'=>'input', 'message'=>'<center><b>Record not found<b><center><p>Your account is not found in db.</p>']);	
$verify=$this->User_model->check_otp($otp,$mobile);
$data=$this->User_model->get_user_by_email($mobile);
$userId=$data['emailaddress_login'];
if($verify['verified']==1)
$this->response(['success'=>'True','object'=>'user', 'data'=>$userId]);
elseif($verify['expired']==1)
$this->response(['error'=>'4310', 'message'=>'<center><b>OTP expired<b><center><p>Your otp is expired.</p>']);
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
$this->response(['error'=>'4100', 'type'=>'input', 'message'=>'<center><b>EmailId Missing<b><center><p>Please enter your email Address.</p>']);				
if(!$vl->isEmail())
$this->response(['error'=>'4310', 'type'=>'input', 'message'=>'<center><b>EmailId Invalid<b><center><p>Your Email address is not valid.</p>']);
if(empty($otp))
$this->response(['error'=>'4100', 'type'=>'input', 'message'=>'<center><b>OTP Missing<b><center><p>Please enter your OTP pin.</p>']);	
$record=$this->User_model->verify_otp($otp,$email);	
if($record['record']==0)	
$this->response(['error'=>'5100', 'type'=>'input', 'message'=>'<center><b>Record not found<b><center><p>Your email address is not found in db.</p>']);	
$verify=$this->User_model->check_otp($otp,$email);
$data=$this->User_model->get_user_by_email($email);
$userId=$data['emailaddress_login'];
if($verify['verified']==1)
$this->response(['success'=>'True','object'=>'user', 'data'=>$userId]);
elseif($verify['expired']==1)
$this->response(['error'=>'4310', 'message'=>'<center><b>OTP expired<b><center><p>Your otp is expired.</p>']);
	
}

function turn_on_push_notification_post($id)
{
	$id=$this->User_model->post('id');
	$this->User_model->update_push_notification($id,true);
}
function turn_off_push_notification_post($id)
{
	$id=$this->User_model->post('id');
	$this->User_model->update_push_notification($id,false);
}

function Authy_request_post()
{
	// set post fields
$post = [
    'api_key' => $this->post('api_key'),
    'via' => $this->post('via'),
	'country_code' => $this->post('country_code'),
    'phone_number' => $this->post('phone_number'),
    'locale'   => $this->post('locale'),
];

$ch = curl_init('https://api.authy.com/protected/json/phones/verification/start');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

// execute!
$response = curl_exec($ch);
print_r($response);
// close the connection, release resources used
curl_close($ch);

// do anything you want with your response
//($response);
}

function Authy_verify_post()
{
	// set post fields
$post = [
    'api_key' => $this->post('api_key'),
    'via' => $this->post('via'),
	'country_code' => $this->post('country_code'),
    'phone_number' => $this->post('phone_number'),
    'locale'   => $this->post('locale'),
];

$ch = curl_init('https://api.authy.com/protected/json/phones/verification/start');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

// execute!
$response = curl_exec($ch);
print_r($response);
// close the connection, release resources used
curl_close($ch);

// do anything you want with your response
//($response);
}
}