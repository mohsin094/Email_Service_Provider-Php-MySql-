<?php
    require_once '../../models/sendEmail.php';
    require_once '../../Payment/recharge.php';
    require_once '../../config/database.php';
    require_once '../../api_response/response.php';
    require_once '../../verification/verification.php';

    $data = json_decode(file_get_contents("php://input"),true);
    $card_num=$data['card_num'];
    $exp_month=$data['exp_month'];
    $exp_year=$data['exp_year'];
    $cvc=$data['cvc'];

    //create response class object
    $res = new Response();
    $all_headers = getallheaders();
    if(!empty($all_headers['Auth_key'])){      
        $jwt=$all_headers['Auth_key'];
        $verification = new Verification();
        $verify_token=$verification->verifyKey($jwt);
        
        if($verify_token['status']===true){
                $sec_merchant_id = $verify_token['data']->sec_merchant_id;
                $merchant_id = $verify_token['data']->merchant_id;
                $name = $verify_token['data']->name;
                $mail = $verify_token['data']->email;
                $paymentAccess = $verify_token['data']->payment_role;
                  
                if($paymentAccess==1){
                    $recharge = new Recharge();
                    $recharge->rechargeAccount($card_num,$exp_month,$exp_year,$cvc,$name,$mail,$sec_merchant_id,$merchant_id);
                }
                else{
                    $res->set_response(NULL,"Sorry you don't have permission to send email.",404);
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