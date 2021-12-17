<?php 
 ini_set('display_errors', 1); ini_set('log_errors', 1); error_reporting(E_ALL);
// API auth credentials 
define("ApiUser", "aytadmin");
define("ApiPass", "12345");
// API key 
define("APIKEY", "AYTWEB@12345");
// Site Path
if ($_SERVER['HTTP_HOST'] == 'localhost') {
	define("SITE_URL", "http://localhost/Naksh_Website/admin/api/");
	define("ADMIN_PATH", "http://localhost/Naksh_Website/admin/"); 
	define("BASE_PATH", "http://localhost/Naksh_Website/");
	define("DOC_PATH", __DIR__."/admin/");
}

define("con_code", json_decode('{"BD": "880", "BE": "32", "BF": "226", "BG": "359", "BA": "387", "BB": "+1-246", "WF": "681", "BL": "590", "BM": "+1-441", "BN": "673", "BO": "591", "BH": "973", "BI": "257", "BJ": "229", "BT": "975", "JM": "+1-876", "BV": "", "BW": "267", "WS": "685", "BQ": "599", "BR": "55", "BS": "+1-242", "JE": "+44-1534", "BY": "375", "BZ": "501", "RU": "7", "RW": "250", "RS": "381", "TL": "670", "RE": "262", "TM": "993", "TJ": "992", "RO": "40", "TK": "690", "GW": "245", "GU": "+1-671", "GT": "502", "GS": "", "GR": "30", "GQ": "240", "GP": "590", "JP": "81", "GY": "592", "GG": "+44-1481", "GF": "594", "GE": "995", "GD": "+1-473", "GB": "44", "GA": "241", "SV": "503", "GN": "224", "GM": "220", "GL": "299", "GI": "350", "GH": "233", "OM": "968", "TN": "216", "JO": "962", "HR": "385", "HT": "509", "HU": "36", "HK": "852", "HN": "504", "HM": " ", "VE": "58", "PR": "+1-787 and 1-939", "PS": "970", "PW": "680", "PT": "351", "SJ": "47", "PY": "595", "IQ": "964", "PA": "507", "PF": "689", "PG": "675", "PE": "51", "PK": "92", "PH": "63", "PN": "870", "PL": "48", "PM": "508", "ZM": "260", "EH": "212", "EE": "372", "EG": "20", "ZA": "27", "EC": "593", "IT": "39", "VN": "84", "SB": "677", "ET": "251", "SO": "252", "ZW": "263", "SA": "966", "ES": "34", "ER": "291", "ME": "382", "MD": "373", "MG": "261", "MF": "590", "MA": "212", "MC": "377", "UZ": "998", "MM": "95", "ML": "223", "MO": "853", "MN": "976", "MH": "692", "MK": "389", "MU": "230", "MT": "356", "MW": "265", "MV": "960", "MQ": "596", "MP": "+1-670", "MS": "+1-664", "MR": "222", "IM": "+44-1624", "UG": "256", "TZ": "255", "MY": "60", "MX": "52", "IL": "972", "FR": "33", "IO": "246", "SH": "290", "FI": "358", "FJ": "679", "FK": "500", "FM": "691", "FO": "298", "NI": "505", "NL": "31", "NO": "47", "NA": "264", "VU": "678", "NC": "687", "NE": "227", "NF": "672", "NG": "234", "NZ": "64", "NP": "977", "NR": "674", "NU": "683", "CK": "682", "XK": "", "CI": "225", "CH": "41", "CO": "57", "CN": "86", "CM": "237", "CL": "56", "CC": "61", "CA": "1", "CG": "242", "CF": "236", "CD": "243", "CZ": "420", "CY": "357", "CX": "61", "CR": "506", "CW": "599", "CV": "238", "CU": "53", "SZ": "268", "SY": "963", "SX": "599", "KG": "996", "KE": "254", "SS": "211", "SR": "597", "KI": "686", "KH": "855", "KN": "+1-869", "KM": "269", "ST": "239", "SK": "421", "KR": "82", "SI": "386", "KP": "850", "KW": "965", "SN": "221", "SM": "378", "SL": "232", "SC": "248", "KZ": "7", "KY": "+1-345", "SG": "65", "SE": "46", "SD": "249", "DO": "+1-809 and 1-829", "DM": "+1-767", "DJ": "253", "DK": "45", "VG": "+1-284", "DE": "49", "YE": "967", "DZ": "213", "US": "1", "UY": "598", "YT": "262", "UM": "1", "LB": "961", "LC": "+1-758", "LA": "856", "TV": "688", "TW": "886", "TT": "+1-868", "TR": "90", "LK": "94", "LI": "423", "LV": "371", "TO": "676", "LT": "370", "LU": "352", "LR": "231", "LS": "266", "TH": "66", "TF": "", "TG": "228", "TD": "235", "TC": "+1-649", "LY": "218", "VA": "379", "VC": "+1-784", "AE": "971", "AD": "376", "AG": "+1-268", "AF": "93", "AI": "+1-264", "VI": "+1-340", "IS": "354", "IR": "98", "AM": "374", "AL": "355", "AO": "244", "AQ": "", "AS": "+1-684", "AR": "54", "AU": "61", "AT": "43", "AW": "297", "IN": "91", "AX": "+358-18", "AZ": "994", "IE": "353", "ID": "62", "UA": "380", "QA": "974", "MZ": "258"}',1));


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
	//echo "<pre>";print_r($result);die; 
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