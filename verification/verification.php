<?php
require '../../vendor/autoload.php';
use \Firebase\JWT\JWT;
 
require_once '../../config/database.php';
require_once '../../models/admin.php';
class Verification{

  public function verifyKey($key){
    if(!empty($key)){
      try{
        $secret = "owt125";
        $decoded_data = JWT::decode($key, $secret,array('HS512'));
        $user_data = $decoded_data->data;
        return array("status"=>true, "data"=>$user_data);
      }
      catch(Exception $ex){
        return array("status"=>false, "data"=>$ex->getMessage());  
      }
    }
  }
  public function createToken($user_data,$user_type){
    try{
    $iss = "localhost";
      $iat = time();
      $nbf = $iat + 10;
      $exp = $iat +4550;
      $aud = $user_type;
      $user_array = $user_data;

      $secret_key = "owt125";
      $payload_info=array(
          "iss"=> $iss,
          "iat"=> $iat,
          "nbf"=> $nbf,
          "exp"=> $exp,
          "aud"=> $aud,
          "data"=>$user_array
      ); 

      $jwt = JWT::encode($payload_info, $secret_key,'HS512');
      return array("status"=>true, "Token"=>$jwt);
    }
    catch(Exception $ex){
      return array("status"=>false, "Token"=>null);  
    }
  }


}


?>