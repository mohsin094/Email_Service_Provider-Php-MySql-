<?php
    require_once '../../models/merchant.php';
    require_once '../../config/database.php';
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
            //get database connection
            $database = new DataBase();
            $conn =$database->get_connection();

            //get merchant id from token and save into variable
            $merchant_id = $verify_token['data']->merchant_id;

            //make an object of merchant class
            $merchant = new Merchant();
            $result= $merchant->listEmails($merchant_id,$conn);

            if($result)
            {
                $res->set_response($result,"List of emails.",200);
                $res->respond_api();
            }
            else{
                $res->set_response(NULL,"server error",406);
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