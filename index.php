<?php

/* ====================================================== 
 * 
 * 
 * 		EMAIL TEST APPLICATION
 * 	
 * 		@Author: JA
 * 		@Date: 	July 8th, 2014
 * 
 * 		@Revised: July 9th, 2014
 * 			-	Joseph Alonzi
 * 				-	Moved the Class to own file/directory.
 * 				- 	Code comment and organizations.
 * 				-	Changed to cleaner variable format.
 * 				-	Reformatted styles/page.
 * 
 * 
 * ====================================================== */
 
 
/* ======================================================
 * 
 * 	If the form has been posted:
 * 
 * ====================================================== */ 
if(isset($_POST['email-message'])){
	
	/* Incude the SendMail class */
	include('class/sendmail.php');
	$MAIL = new sendMail();
	
	/* Get the Email Components */
	$EMAIL_LIST = rtrim($_POST['email-list'],',');
	$SUBJECT = $_POST['email-subject'];
	$MESSAGE = stripslashes($_POST['email-message']);
	
	/* Run the email Class */
	$SEND = $MAIL->send($EMAIL_LIST,$SUBJECT,$MESSAGE);
		
	/* Check if the email has passed and has been sent */
	/* If yes: */	
	if($SEND!='false'){
		$CONFIRM = ('<div class="email-success">Email Sent!</div>');
		
	/* If no: */	
	}else{ 	
		$CONFIRM = ('<div class="email-fail">Email Failed</div>');
	}
	
	/* AngularJS Helper - Email List */
	$EMAILS = explode(',',$EMAIL_LIST);
	$count = count($EMAILS);
	if($count!=0){
		for($i=0;$i<$count;$i++){
			$ng_data .= ('"'.$EMAILS[$i].'",');
		}
		$ng_data = rtrim($ng_data,',');
	}
		
}
/* ====================================================== */
/* ====================================================== */ 

/* ======================================================
 * 
 * 	HTML Page:
 * 
 * ====================================================== */ 
echo 
('<html ng-app>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width,initial-scale=1.0">
	
<title>Email PRE-PROOF System</title>

<script type="text/javascript" src="/email-test/js/framework/angular-js/angular-1.3.0.min.js"></script>
<script>
	function emailCtrl($scope){
		var email_list = document.getElementById("ng-list");	
		$scope.emails = ['.$ng_data.'];
		$scope.addEmail = function(){
			$scope.emails.push($scope.addEmailToList);
			email_list.value = $scope.emails;
			$scope.formToDoText = "";
		}
		$scope.removeEmail = function(index){
		   $scope.emails.splice(index, 1);
		   email_list.value = $scope.emails;
		}
	}	
</script>
	
<link rel="stylesheet" href="/email-test/css/styles.css" />
	
</head>
<body>
	
	<!--//  Page Body  //-->
	<div id="page-frame">
	
		<header>
			<img src="" alt="" id="logo" />
			<div id="title">
				<h1>Email Pre-Proof System</h1>
			</div>
		</header>
	
		'.$CONFIRM.'
		
		<!--//  Form Body  //-->		
		<div id="form">
		
				<div id="control" ng-controller="emailCtrl">
				
					Add Email:<br />
					<form>
						<input type="text" ng-model="addEmailToList" class="add-email" ng-model-instant />
		            	<button ng-click="addEmail()" class="btn add-btn">ADD</button>
	            	</form>
	  				
					<form>
	     				<div class="email-list" ng-repeat="email in emails">
	     					<div class="email">{{email}}</div>
	     					<div class="remove">
	     						<button ng-click="removeEmail($index)" class="btn remove-btn">REMOVE</button>
	     					</div>
	     				</div>
	     			</form>
	            
				</div><br /><br />
			
			<!--//  Form  //-->		
			<form id="email-form" method="post" action="/email-test/">
				
				<input id="ng-list" type="text" name="email-list" value="'.$EMAIL_LIST.'" style="display:none;" /><br /><br />
					
				Subject:<br />
				<input type="text" name="email-subject" value="'.$SUBJECT.'" /><br /><br />
					
				HTML:<br />
				<textarea id="email-message" name="email-message">'.$MESSAGE.'</textarea><br /><br />
				
				<input type="submit" value="send" class="btn btn-submit" />
					
			</form>
			<!--//  Form  //-->
				
		</div>
		<!--//  Form Body  //-->	
		
		<footer>
			<img src="" alt="footer-logo" />
		</footer>
		
	</div>
	<!--//  Page Body  //-->

</body>
</html>');
/* ====================================================== */
/* ====================================================== */ 
?>
