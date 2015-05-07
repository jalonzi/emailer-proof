<?php

/* ====================================================== 
 * 
 * 
 * 		EMAIL TEST APPLICATION
 * 	
 * 		@Author: JA
 * 		@Date: July 9th, 2014
 * 
 * 		//	This is the main mailer class which handles
 * 		//	sending out the email HTML provided.
 * 		
 * ====================================================== */
 
class sendMail{

	/******************************************************
	 * 
	 * 		- Main Send Function
	 * 
	 * 		@Author: JA
	 * 		@Date: July 9th, 2014
	 * 
	 ****************************************************** */
	function send($sendto,$subject,$message){
		
		/******************************************************
		 * 
		 * 	Set the Headers for the emaul.
		 * 
		 ****************************************************** */
		$headers  = "From: Joseph <donotreply@alonzi.com>\r\n";
		$headers .= "Reply-To: 5thBusiness <donotreply@alonzi.com>\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
		
		/******************************************************
		 * 
		 * 	Send mail, return the response.
		 * 
		 ****************************************************** */
		if(mail($sendto, $subject, $message, $headers)){
			return 'true';
		}else {
			return 'false';
		}
		
	}
	
}

?>