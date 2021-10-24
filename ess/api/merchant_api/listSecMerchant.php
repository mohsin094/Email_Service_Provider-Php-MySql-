<?php
    require_once '../../models/merchant.php';
    require_once '../../config/database.php';
    require_once '../../api_response/response.php';


    //get database connection
    $database = new DataBase();
    $conn =$database->get_connection();

    //make an object of merchant class
    $merchant = new Merchant();
    $result= $merchant->listSecMerchant($conn);

    //create response class object
    $res = new Response();
    if($result)
    {
        $res->set_response($result,"data of sec merchant",200);
        $res->respond_api();
    }
    else{
        $res->set_response(NULL,"server error",406);
        $res->respond_api();
    }
?>