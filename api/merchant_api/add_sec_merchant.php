
<?php
    require_once '../../models/merchant.php';
    require_once '../../config/database.php';
    require_once '../../api_response/response.php';
    require_once '../../models/sendEmail.php';
    require_once '../../verification/verification.php';

    $data = json_decode(file_get_contents("php://input"),true);
    $name =$data['name'];
    $email = $data['email'];
    $password = $data['password'];
    $email_send_role = $data['email_send_role'];
    $email_list_role = $data['email_list_role'];
    $payment_role = $data['payment_role'];

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

            //print array of data in token
            // print_r($verify_token['data']);

            //get merchant id from token and save into variable
            $merchant_id = $verify_token['data']->merchant_id;

            //make an object of merchant class
            $merchant = new Merchant();
            $result= $merchant->addSecMerchant($merchant_id,$name,$email,$password,$email_send_role,$email_list_role,$payment_role,$conn);

            if($result)
            {
                //if secondary merchant successfully added into database, call accountConfirmation method
                //and pass parameter to send the login credential to secondary merchant
                $emailObj = new Email();

                 //get merchant email from token and save into variable
                $from = $verify_token['data']->email ;
                $subject = "Email service provider login credentials.";
                $body ="Hi $name , Welcome to Email Service provider, here are you login credentials. username: $email  Password: $password";
                $rslt = $emailObj->accountConfirmation($from,$email,$subject,$body);
                if($rslt=true){
                $res->set_response(NULL,"Secondary merchent added and credential send to email successfully.",200);
                $res->respond_api();
                }
                else{
                    $res->set_response(NULL,"Secondary merchent added but fail to send login credential.",409);
                    $res->respond_api();
                } 
            }

            if($result==false)
            {
                $res->set_response(NULL,"Error occur in adding secondary merchant!",406);
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