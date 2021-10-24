<?php
class DataBase
{
    private $server_name = "localhost";
    private $username = "root";
    private $password = "";
    private $db_name = "ess";
    public $conn = null;

    //connecting database and return the connection
 public function get_connection()
    {
        $this->conn = new mysqli($this->server_name, $this->username, $this->password, $this->db_name);

        if ($this->conn->connect_error) {
            die("connection failed: " . $this->conn->connect_error);
        } else {
            return $this->conn;
        }
    }

    //getting database connection reference / identifier
    public function close_connection()
    {
        $this->conn->close();
    }
}
