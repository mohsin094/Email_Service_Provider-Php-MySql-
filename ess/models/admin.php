<?php
    class Admin{
    public function sign_in($email, $password, $db_conn)
    {
      //create query
      $query = "SELECT name,email FROM admin WHERE email='$email' AND password='$password'";
        $result = $db_conn->query($query);
        if($result)
        {
            return $result;
        }else{
            return false;
        }
         $db_conn->close();
    }
    }
?>