<?php 
 ini_set('display_errors', 1); ini_set('log_errors', 1); error_reporting(E_ALL);
// API auth credentials 
define("ApiUser", "aytadmin");
define("ApiPass", "12345");
// API key 
define("APIKEY", "AYTWEB@12345");
// Site Path
// Site Path
define("SITE_URL", "https://technolite.in/staging/nakshmarwadimasale/admin/api/");
define("ADMIN_PATH", "https://technolite.in/staging/nakshmarwadimasale/admin/"); 
define("BASE_PATH", "https://technolite.in/staging/nakshmarwadimasale/");
define("DOC_PATH", "/var/www/vhosts/technolite.in/httpdocs/staging/nakshmarwadimasale/admin/");



function getData($url,$id = NULL)
{   
	// API URL
	if(empty($id)){
		$url = SITE_URL.$url; 
	}else{
		$url = SITE_URL.$url.'/'.$id; 
	}  

	// Create a new cURL resource
	$ch = curl_init($url);
	$apiUser  = ApiUser;
	$apiPass = ApiPass;
	curl_setopt($ch, CURLOPT_TIMEOUT, 30);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("X-API-KEY: " . APIKEY));
	curl_setopt($ch, CURLOPT_USERPWD, "$apiUser:$apiPass");

	$result = curl_exec($ch);  
	// Close cURL resource
	curl_close($ch);
	$mydata=json_decode($result, true); 
    return $mydata;
}
	

function postData($url, $data)
{
	// User account login info
	$apiData = $data;
	//print_r($apiData);die();
	// API URL
	$url = SITE_URL.$url; 
	// print_r($url);die();
	// Create a new cURL resource
	$ch = curl_init($url);
	$apiUser  = ApiUser;
	$apiPass = ApiPass;
	curl_setopt($ch, CURLOPT_TIMEOUT, 30);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("X-API-KEY: " . APIKEY));
	curl_setopt($ch, CURLOPT_USERPWD, "$apiUser:$apiPass");
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $apiData);

	$result = curl_exec($ch); 
	// print_r(APIKEY);die();  
	//print_r($result);die();  
	// Close cURL resource
	curl_close($ch);
	$mydata=json_decode($result, true);
	//print_r($mydata);die(); 
    return $mydata;
}

function postFile($url, $fdata,$data)
{
	// User account login info
	
	$data = $_POST;
	//$apiDta = $dta['image'];
	//print_r($data);die();
	if (!empty($_FILES)) {
		//$fdata = $_FILES;
		$name = $_FILES['image']['name'];
		$tmp_name = $_FILES['image']['tmp_name'];
		$type = $_FILES['image']['type'];
		$data1 = array("image"=>curl_file_create($tmp_name,$type,$name));
		// API URL
		$dataC = array_merge($data,$data1);
		$url = SITE_URL.$url; 
		//print_r($dataC);die();
		// Create a new cURL resource
		$ch = curl_init($url);
		$apiUser  = ApiUser;
		$apiPass = ApiPass;
		curl_setopt($ch, CURLOPT_TIMEOUT, 30);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("X-API-KEY: " . APIKEY));
		curl_setopt($ch, CURLOPT_USERPWD, "$apiUser:$apiPass");
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $dataC);

		$result = curl_exec($ch); 
		// print_r(APIKEY);die();  
		//print_r($result);die();  
		// Close cURL resource
		curl_close($ch);
		$mydata=json_decode($result, true);
		//print_r($mydata);die(); 
	    return $mydata;
	}
}


function putData($url, $data)
{
	// User account login info
	$apiData = $data;
	// API URL
	$url = SITE_URL.$url; 

	// Create a new cURL resource 
	$ch = curl_init($url);
	$apiUser  = ApiUser;
	$apiPass = ApiPass;
	curl_setopt($ch, CURLOPT_TIMEOUT, 30);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('X-API-KEY: '.APIKEY, 'Content-Type: application/x-www-form-urlencoded'));
	curl_setopt($ch, CURLOPT_USERPWD, "$apiUser:$apiPass");
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
	curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($apiData));

	$result = curl_exec($ch);
	// Close cURL resource
	curl_close($ch);
	$mydata=json_decode($result, true); 
    return $mydata;

}

function redirect($url){
	header("Location: ".BASE_PATH.$url."");
	die();
}
 
/*Othere Bacis functions for site*/
function getimage($image,$defaultImg=NULL){
	$defaultImgPath = 'assets/img/'; 
	if(isset($image) && !empty($image) && file_exists(DOC_PATH.$image)){
        $img = ADMIN_PATH.$image;
    }elseif(isset($defaultImg) && !empty($defaultImg) && file_exists(DOC_PATH.$defaultImgPath.$defaultImg)){
        $img = ADMIN_PATH.$defaultImgPath.$defaultImg;
    }else{
        $img = ADMIN_PATH.'assets/img/profileicon.png';
    }
    return $img;
}

?>