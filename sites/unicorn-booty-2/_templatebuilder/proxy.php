<?php 
	//Stop if no Ajax request
	if(!isset($_SERVER['HTTP_X_REQUESTED_WITH'])){
		header('Location: ./');
		exit;
	}
	if (function_exists ('ini_set')){
		//prevent display errors
	  ini_set("display_errors", 0);
		//but log them
	  ini_set('log_errors', 1 ); 
		//in the document root
	  ini_set('error_log', getcwd().'/php_error.log' );
	}
	
	//only this methods are allowed
	$allowedMethod = array('ping','templateAdd');
	
	//makeing some variables
	$apikey = $_POST['apikey'];
	$dc = substr($apikey,strrpos($apikey,'-')+1);
	$method = $_POST['method'];
	$data = $_POST['data'];
	
	//check apikey syntax an allowed method
	if(!preg_match('#^[0-9a-f]{32}-[0-9a-z]{3}$#', $apikey) || !in_array($method, $allowedMethod)){
		$return['success'] = false;
		$return['msg'] = 'Error';
		echo json_encode($return);
		exit;
	}
	
	//building the url
	$url = 'http://'.$dc.'.api.mailchimp.com/1.3/?apikey='.$apikey.'&method='.$method.'&rand='.time();
	
	if(isset($data)){
		foreach($data as $k => $v){
			//html is to long so we don't add it
			if($k != 'html'){
				$url .= '&'.$k.'='.urlencode($v);	
				unset($data[$k]);
			}else{
				// slahes comes from the text field -> get rid of them
				$data[$k] = stripslashes($data[$k]);	
			}
		}
	}
	
	//send the request
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$data = curl_exec($ch);
	
	//return error on error
	if(!$data){
		$return['success'] = false;
		$return['msg'] = 'Something is wrong :(';
		echo json_encode($return);
		exit;
	}
	
	//return results
	$return['success'] = true;
	$return['response'] = json_decode($data);
	echo json_encode($return);





?>