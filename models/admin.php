<?php
    class Admin{
    public function sign_in($email, $password, $db_conn)
    {
      //create query
      $query = "SELECT admin_id,name,email FROM admin WHERE email='$email' AND password='$password'";
        $result = $db_conn->query($query);
        if($result)
        {
            return $result;
        }else{
            return false;
        }
         $db_conn->close();
    }

     //admin function to show list of all merchants
     public function listMerchants($db_conn){
        $query = $db_conn->query("SELECT * from merchant");
        if ($query->num_rows > 0) {
            $data=array();
            while($row=$query->fetch_assoc()) 
            {
                array_push($data,"Merchant id:",$row['merchant_id'],"Name:",$row['name'],
                "Email:",$row['email'],"Join data:",$row['join_date']);
                
            }
            return $data;
    }else{
        return false;
    }
     $db_conn->close(); 
    }
   //admin function to show list of all secondary merchants
   public function listSecMerchants($db_conn){
    $query = $db_conn->query("SELECT * from sec_merchant");
    if ($query->num_rows > 0) {
        $data=array();
        while($row=$query->fetch_assoc()) 
        { 
            array_push($data,"Secondary Merchant id:",$row['sec_merchant_id'],"Name:",$row['name'],
            "Email:",$row['email'],"Join data:",$row['join_date']);
            
        }
        return $data;
}else{
    return false;
}
 $db_conn->close(); 
}
    //admin function to show list of all emails
    public function listEmails($db_conn){
        $query = $db_conn->query("SELECT * from request");
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