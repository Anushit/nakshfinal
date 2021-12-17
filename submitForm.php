<?php 
	
	include('config.php');
    //print_r($_POST);die();
	if(!empty($_POST)){ 
        //print_r("CHECKS");
       //print_r($_POST);die(); //print_r($_POST);die();
        session_start();
        
        $data = $_POST;  
        //print_r($data);die;
        $contactData = postData('saveinquery', $data);  
        //$msg = $contactData['message'];
        //print_r($msg);die();
        //return $msg;
         
    }

?>