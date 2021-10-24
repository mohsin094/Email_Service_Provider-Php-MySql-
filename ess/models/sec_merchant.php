<?php
    class SecondaryMecrchant{
        //login function of secondary merchant
        public function logIn($email,$password,$conn){
            //create query
            $query = "SELECT name,email FROM sec_merchant WHERE email='$email' AND password='$password'";
            $result = $conn->query($query);
            if($result)
            {
                return $result;
            }else{
                return false;
            }
            $conn->close();
            }
    }
?>