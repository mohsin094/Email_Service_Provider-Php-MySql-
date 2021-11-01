<?php
require_once '../../config/database.php';
require_once '../../models/sec_merchant.php';
require_once '../../api_response/response.php';
require_once '../../verification/verification.php';

//create response class object
$res = new Response();
//get the data from postman
$data = json_decode(file_get_contents("php://input"),true);
$email=$data['email'];
$password=$data['password'];


     // create object of database class
     $database = new Database();
     // get database connection
     $db = $database->get_Connection();
     
     // create user object
     $secMerchant = new SecondaryMecrchant();

     // call sign_in() method and pass required parameters 
     $userData = $secMerchant->logIn($email,$password,$db);
          if($userData){    
               $user_type="secMerchant";
               //jwt token
               $verification = new Verification();
               $verification_data=$verification->createToken($userData,$user_type);

               if($verification_data['status'])
               {    
                    $res->set_response($verification_data['Token'],"use this data in your header!",200);
                    $res->respond_api();
               }else{
                    $res->set_response(null,"server problem please try again",500);
                    $res->respond_api();
               }
          }
          else{
          $user_arr=array(
               "status" => 406,
               "message" => "Invalid Username or Password!",
          );
          $res->set_response(null,$user_arr['message'],$user_arr['status']);
          $res->respond_api();
          }
     
?>