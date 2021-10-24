<?php
require_once '../../config/database.php';
require_once '../../models/merchant.php';
require_once '../../api_response/response.php';

//create response class object
$res = new Response();
//get the data from postman
$data = json_decode(file_get_contents("php://input"),true);
$email=$data['email'];
$password=$data['password'];
//perform validation on email format
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
{
      $res->set_response(null,'invalid email format',409);
     $res->respond_api();
}
else{
     // create object of database class
     $database = new Database();
     // get database connection
     $db = $database->get_Connection();
     
     // create user object
     $merchant = new Merchant();

     // call sign_in() method and pass required parameters 
     $result = $merchant->signIn($email,$password,$db);
          if($result){    
               $res->set_response(null,"Successfully Login!",200);
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
        }
?>