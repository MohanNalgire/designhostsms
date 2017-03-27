<?php
 	error_reporting(E_ALL);
 	ini_set('display_startup_errors', 1);
 	ini_set("display_errors",1);
	//echo '<pre>',print_r($_POST); exit;
	
	$csv_mimetypes = array(
	'text/csv', 
	'text/plain', 
	'application/csv', 
	'text/comma-separated-values', '
	application/excel', 
	'application/vnd.ms-excel', 
	'application/vnd.msexcel', 
	'text/anytext', 
	'application/octet-stream', 
	'application/txt'
	);
 
 
if (
	in_array($_FILES['csvfile']['type'], $csv_mimetypes) &&
	isset($_POST['msg'])
	) 
	{
	/**
	*	Each time create new file at server side and delete old file of csv.
	*/
	
	//chmod(__FILE__,0777);
	$info = pathinfo($_FILES['csvfile']['name']);
	$ext = $info['extension']; // get the extension of the file
	$newname = "mobileno.".$ext; 

	$msg=$_POST['msg'];
	//echo mb_detect_encoding($msg);exit;
	$target = $newname;
	$success=move_uploaded_file( $_FILES['csvfile']['tmp_name'], $target);
	if($success){
		//echo "File uploaded successfully.";
	}else{
		echo "File uploade fail.";
	}

	function getMobileNo($file){	
		/**
		*	Read phone number from server side file.
		*/
		
		$filedata=file_get_contents($file);
		$mobilenostr=preg_replace("/[\n\r]/", ',', $filedata);
		return $mobilenostr;
	}

	/**
	*	Created on 		:	
	*	Created by 		:	
	*	Modified by 	:		
	*	Modified by 	:	
	*/	

	function openurl($url,$postvars) {
		
		$ch=curl_init();
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
		curl_setopt($ch,CURLOPT_POSTFIELDS,$postvars);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch,CURLOPT_TIMEOUT, '3');  
		$content = trim(curl_exec($ch));
		print_r($content);
		curl_close($ch); 
		echo "MSG send sucessfully";
		echo "<a href='./readmobilefile.php'><button>BACK</button></a>";
		//sleep(5);
		//header("location:readmobilefile.php");

	  }
################################################ Manual configuration for designhost sms ##################################
	$sms_url="";//domain with directroy path for designhost api.
	$param['uname'] = ""; //Your user name from designhost api.
	$param['password'] = "";//Your password for design host api.
	$param['sender'] = "";//YOur api sender type.
	$param['receiver'] =getMobileNo($target);// Your mobile number whom you want to send sms provide as string with comma.
	$param['route'] = "";//Your route type with your plan.
	$param['msgtype'] = "3"; //Message type for your sms.
	$param['sms'] =$_POST['msg'];
	
	$paramset=http_build_query($param);
####################################### Manual configuration for designhost sms ends #################################
	openurl($sms_url,$paramset);
}
?>
