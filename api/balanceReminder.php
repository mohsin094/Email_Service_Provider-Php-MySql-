<?php
    require_once '../../models/sendEmail.php';
    require_once '../../models/merchant.php';
    require_once '../../config/database.php';
    require_once '../../api_response/response.php';
    require_once '../../verification/verification.php';

    
    //create response class object
    $res = new Response();
                //make an object of Email class in models folder
                $emailObj = new Email();
                $database = new Database();
                
                $query = "SELECT * FROM merchant WHERE credit<=10";
                $result = $db_conn->query($query);
        
                if($result->num_rows > 0){    
                    while($user_data = $result->fetch_assoc()){
                        print_r($user_data);                  
                     }
                    echo "dj"; 
                }else{
                    return false;
                }
                 $db_conn->close();
                //call the sendEmail unction in Email class and pass parameters
               // $result = $emailObj->sendEmail($from,$to,$cc,$bcc,$subject,$body);
?>