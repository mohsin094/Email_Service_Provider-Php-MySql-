<?php
    require_once '../../config/database.php';
    require_once '../../api_response/response.php';
    require_once '../../verification/verification.php';
    require_once '../../models/sec_merchant.php';
    
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

            //get merchant email id from token and save into variable
            $sec_merchant_id = $verify_token['data']->sec_merchant_id;
     
             //save email_send_role value
             $emailListRole = $verify_token['data']->email_list_role;
             if($emailListRole==1){
            //make an object of merchant class
             // create user object
             $secMerchant = new SecondaryMecrchant();
             $result= $secMerchant->listEmails($sec_merchant_id,$conn);

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
            $res->set_response(NULL,"Sorry you don't have permission to view email list.",404);
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