<?php
    session_start();
    class Merchant{
    public function signUp($name, $email, $password,$db_conn)
    {
      //create query
      $query = "INSERT INTO merchant (name,email,password) values ('$name','$email','$password')";
        $result = $db_conn->query($query);
        if($result)
        {
            return $result;
        }else{
            return false;
        }
         $db_conn->close();
    }

    //merchant sign function
    public function signIn($email,$password,$db_conn){
        //Query
        $result = $db_conn->query("SELECT merchant_id,name,email,password FROM merchant WHERE email='$email' AND password='$password'");
        if ($result->num_rows > 0) {
            $row=$result->fetch_assoc();
            $_SESSION["merchant_id"]=$row['merchant_id'];
            return $result;
        }else{
            return false;
        }
         $db_conn->close();
    }

    //function to add secondary merchant
    public function addSecMerchant($name,$email,$password,$role1,$role2,$role3,$db_conn){
    //create query
    $merchant_id = $_SESSION["merchant_id"];
      $query = "INSERT INTO sec_merchant
       (merchant_id,name,email,password,email_send_role,email_list_role,payment_role)
        values ('$merchant_id','$name','$email','$password','$role1','$role2','$role3')";
      $result = $db_conn->query($query);
      if($result)
      {
          return $result;
      }else{
          return false;
      }
       $db_conn->close();
    }

    //function to show list of sec merchant
    function listSecMerchant($db_conn){
        $merchant_id = $_SESSION["merchant_id"];
            $query = $db_conn->query("SELECT * from sec_merchant where merchant_id='$merchant_id'");
            if ($query->num_rows > 0) {
                $data=array();
                while($row=$query->fetch_assoc()) 
                {
                    // $data['Sec_Merchant_Id']=$row['sec_merchant_id'];
                    // $data['name']=$row['name'];
                    // $data['join_date']=$row['join_date']; 
                    array_push($data,"Id:",$row['sec_merchant_id'],"Name:",$row['name'],"Join Date:",$row['join_date']);
                }
                return $data;
        }else{
            return false;
        }
         $db_conn->close();   
    }

    //function to view profie
    public function viewProfile($db_conn){
        $merchant_id = $_SESSION["merchant_id"];
        $query = $db_conn->query("SELECT merchant_id,name,join_date from merchant where merchant_id='$merchant_id'");

        if ($query->num_rows > 0) {
            $data=array();
            $row=$query->fetch_assoc();
                $data['Merchant Id:']=$row['merchant_id'];
                $data['Name:']=$row['name'];
                $data['join date:']=$row['join_date']; 
                return $data;
    }else{
        return false;
    }
     $db_conn->close();   
    }

    //function to upload profile image
       //function to view profie
       public function uploadProfileImage($filename,$conn){
        $merchant_id = $_SESSION["merchant_id"];
        $query = "UPDATE merchant SET image='$filename' WHERE merchant_id='$merchant_id'";
        $result = $conn->query($query);

        if ($result) {
                return true;
        }else{
            return false;
        }
     $conn->close();   
    }

    } 
?>