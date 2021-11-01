<?php
require_once '../../config/database.php';
require_once '../../models/merchant.php';
require_once '../../api_response/response.php';
require_once '../../verification/verification.php';

//create response class object
$res = new Response();

$all_headers = getallheaders();
if(!empty($all_headers['Auth_key'])){      
    $jwt=$all_headers['Auth_key'];
    $verification = new Verification();
    $verify_token=$verification->verifyKey($jwt);
    
    if($verify_token['status']===true){
          // create object of database class
          $database = new Database();
          // get database connection
          $db = $database->get_Connection();
          
          // create user object
          $merchant = new Merchant();

          //get merchant email id from token and save into variable
          $merchant_id = $verify_token['data']->merchant_id;

          // call sign_in() method and pass required parameters 
          $result = $merchant->viewProfile($merchant_id,$db);
               if($result){    
                    $res->set_response($result,"User data",200);
                    $res->respond_api();
               }
               else{
               $user_arr=array(
                    "status" => 406,
                    "message" => "Invalid Username or Password!",
               );
               $res->set_response(null,$user_arr['message'],$user_arr['status']);
               $res->respond_api();
          
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