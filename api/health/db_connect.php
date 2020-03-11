<?php
class Database{
    private $conn;
    private $username = 'id12625652_ihealthprojectdb';
    private $password = 'iHealthProject2020';
    private $host = 'localhost';
    private $db_name = 'id12625652_ihealthproject'; 
   
    public function connect(){
        try{
            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->db_name",$this->username,$this->password);
            //set error attribute(attr_mode,type)
            $this->conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
            echo "Connection error occur :".$e->getMessage();
        }
        return $this->conn;
    }
   
}

?>