<?php
    class SecondaryMecrchant{
        //login function of secondary merchant
        public function logIn($email,$password,$conn){
            //create query
            $query = "SELECT * FROM sec_merchant WHERE email='$email' AND password='$password'";
            $result = $conn->query($query);

            if ($result->num_rows > 0) {
                $row=$result->fetch_assoc();
                return $row;
            }else{
                return false;
            }
             $conn->close();
        }

            //function to view profie of secondary merchant
        public function viewProfile($secMerchantId,$db_conn){
            $query = $db_conn->query("SELECT sec_merchant_id,name,email,join_date,email_send_role,email_list_role,payment_role
            from sec_merchant where sec_merchant_id='$secMerchantId'");
            if ($query->num_rows > 0) {
                $row=$query->fetch_assoc();
                    return $row;
            }else{
            return false;
            }
            $db_conn->close();   
        }


        //function to list emails
        public function listEmails($sec_merchant_id,$db_conn){
            $query = $db_conn->query("SELECT * from request where requester_id='$sec_merchant_id'");
            if ($query->num_rows > 0) {
                $data=array();
                while($row=$query->fetch_assoc()) 
                {
                    // $data['Sec_Merchant_Id']=$row['sec_merchant_id'];
                    // $data['name']=$row['name'];
                    // $data['join_date']=$row['join_date']; 
                    array_push($data,"Send to:",$row['email_to'],"Cc:",$row['cc'],
                    "Bcc:",$row['bcc'],"Subject:",$row['email_subject'],"Body:",
                    $row['body'],"Time:",$row['time']);
                    
                }
                return $data;
            }else{
                return false;
            }
            $db_conn->close(); 
        }
    }


?>