<?php
    require_once '../../models/merchant.php';
    require_once '../../config/database.php';
    require_once '../../api_response/response.php';

    $data = json_decode(file_get_contents("php://input"),true);
    $name =$data['name'];
    $email = $data['email'];
    $password = $data['password'];
    $email_send_role = $data['email_send_role'];
    $email_list_role = $data['email_list_role'];
    $payment_role = $data['payment_role'];

    //get database connection
    $database = new DataBase();
    $conn =$database->get_connection();

    //make an object of merchant class
    $merchant = new Merchant();
    $result= $merchant->addSecMerchant($name,$email,$password,$email_send_role,$email_list_role,$payment_role,$conn);

    //create response class object
    $res = new Response();
    if($result==true)
    {
        $res->set_response(NULL,"secondary merchent added success",200);
        $res->respond_api();
    }

    if($result==false)
    {
        $res->set_response(NULL,"Unsuccessful signup",406);
        $res->respond_api();
    }
?>