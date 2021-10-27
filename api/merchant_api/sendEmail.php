<?php
    require_once '../../models/sendEmail.php';
    require_once '../../models/merchant.php';
    require_once '../../config/database.php';
    require_once '../../api_response/response.php';
    require_once '../../verification/verification.php';

    $data = json_decode(file_get_contents("php://input"),true);
    $to=$data['to'];
    $cc=$data['cc'];
    $bcc=$data['bcc'];
    $subject=$data['subject'];
    $body=$data['body'];

    //create response class object
    $res = new Response();
    $all_headers = getallheaders();
    if(!empty($all_headers['Auth_key'])){      
        $jwt=$all_headers['Auth_key'];
        $verification = new Verification();
        $verify_token=$verification->verifyKey($jwt);
        
        if($verify_token['status']===true){

                //make an object of Email class in models folder
                $emailObj = new Email();

                //get merchant email id from token and save into variable
                 $merchant_id = $verify_token['data']->merchant_id;

                //get merchant email id from token and save into variable
                $from = $verify_token['data']->email;
                
                $credit = $verify_token['data']->credit;

                //call the sendEmail unction in Email class and pass parameters
                $result = $emailObj->sendEmail($from,$to,$cc,$bcc,$subject,$body);

                //if sendEmail method return true, run this portion of code
                if($result=true){
                    $database = new Database();
                    // get database connection
                    $conn = $database->get_Connection();

                    $query="INSERT into request (requester_id,email_from,email_to,cc,bcc,email_subject,body) 
                    values('$merchant_id','$from','$to','$cc','$bcc','$subject','$body')";
                    $conn->query($query);  
                  
                    $credit =$credit - 0.0489; 
                         $query1=" UPDATE merchant SET credit ='$credit' WHERE merchant_id = $merchant_id";
                         $result = $conn->query($query1);
                    $res->set_response(null,'Email send successfully',400);
                    $res->respond_api();
                }
                else{
                $res->set_response(null,'Email not send',404);
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