<?php
require_once '../../config/database.php';
require_once '../../models/sec_merchant.php';
require_once '../../api_response/response.php';

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
     $secMer = new SecondaryMecrchant();

     // call sign_in() method and pass required parameters 
     $result = $secMer->logIn($email,$password,$db);
          if($result->num_rows > 0){    
               $row = $result->fetch_assoc();
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
     
?>