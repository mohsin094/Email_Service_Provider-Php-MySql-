<?php
    require_once '../../models/admin.php';
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

                //make an object of merchant class
                $admin = new Admin();
                $result= $admin->listEmails($conn);

                //create response class object
                $res = new Response();
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