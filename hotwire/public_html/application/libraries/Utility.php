<?php
class Utility {

	/* 
		#### @Param 	: Take email parameters as input and send mail to the recipient email address.
		#### @Author	: Kritika Bajpai
	*/
	function Mail_Send_Utility($param){	
		/*setting up gmail smtp*/	
		$config = array(
						'protocol' => 'smtp',
						'smtp_host' => 'ssl://smtp.googlemail.com',
						'smtp_port' => 465,
						'smtp_user' => 'kritikabajpai111@gmail.com', 
						'smtp_pass' => 'madhuswap', 
						'mailtype' => 'html',
						'charset' => 'iso-8859-1',
						'wordwrap' => TRUE
					   );
		$CI =& get_instance();
		$CI->load->library('email',$config);
		$CI->email->set_newline("\r\n");
		$CI->email->initialize($config); 
		$CI->email->from($param['from']);
		$CI->email->to($param['email_address']);
		$CI->email->subject($param['subject']);
		$CI->email->message($param['message']);
		// TO DO: make a proper response format 
		$send_message='Email sent.';
		if($CI->email->send()) 
			 return true; 
		else
		  //print_r($CI->email->print_debugger());  	
             return false;		  
	 
	 }
}

?>