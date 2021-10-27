<?php
require_once '../../validation/imageValidation.php';
require_once '../../models/merchant.php';
require_once '../../config/database.php';
require_once '../../api_response/response.php';
require_once '../../verification/verification.php';

header("Content-Type: application/json");
header("Acess-Control-Allow-Origin: *");
header("Acess-Control-Allow-Methods: POST");
header("Acess-Control-Allow-Headers: Acess-Control-Allow-Headers,Content-Type,Acess-Control-Allow-Methods, Authorization");

require_once '../../config/database.php';

$data = json_decode(file_get_contents("php://input"), true); // collect input parameters and convert into readable format
	
$fileName  =  $_FILES['image']['name'];
$tempPath  =  $_FILES['image']['tmp_name'];
$fileSize  =  $_FILES['image']['size'];


$all_headers = getallheaders();
if(!empty($all_headers['Auth_key'])){      
    $jwt=$all_headers['Auth_key'];
    $verification = new Verification();
    $verify_token=$verification->verifyKey($jwt);
    
    if($verify_token['status']===true){
		//get merchant email id from token and save into variable
		$merchant_id = $verify_token['data']->merchant_id;

		//object of imageValidation class
		$verifyImage = new imageValidation();

		$result=$verifyImage->verifyImage($fileName,$tempPath,$fileSize);
		// if no error caused, continue ....
		if(!isset($result))
		{
			$database = new Database();
		$db = $database->get_Connection();

		$merchant = new Merchant();
		// call sign_in() method and pass required parameters 
		$result = $merchant->uploadProfileImage($merchant_id,$fileName,$db);

		//create response class object
		$res = new Response();
			if($result==true){    
				$res->set_response($result ,"Image uploaded!",200);
				$res->respond_api();
			}
			else{
			$user_arr=array(
				"status" => 406,
				"message" => "Server error!",
			);
			$res->set_response($result ,$user_arr['message'],$user_arr['status']);
			$res->respond_api();
			}
		}
	}else{
		$res->set_response(null,$verify_token['data'],404);
		$res->respond_api();
	}
	}else{
	$res->set_response(NULL,"Auth_key required",404);
	$res->respond_api();
	} 
?>