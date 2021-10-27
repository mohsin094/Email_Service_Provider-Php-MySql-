<?php
require_once '../../config/database.php';
require_once '../../models/sec_merchant.php';
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
          $secMerchant = new SecondaryMecrchant();

           //get merchant email id from token and save into variable
           $sec_merchant_id = $verify_token['data']->sec_merchant_id;
     
          // call sign_in() method and pass required parameters 
          $result = $secMerchant->viewProfile($sec_merchant_id,$db);
               if($result){    
                    $res->set_response($result,"User data",200);
                    $res->respond_api();
               }
               else{
               $user_arr=array(
                    "status" => 406,
                    "message" => "Login to view profile!",
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