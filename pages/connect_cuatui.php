<?php
class ConnectDB{
    private $host = 'localhost';
    private $user = 'root';
    private $password = '';
    private $database = 'mypham';
    public $conn;

    public function __construct(){
        $this->conn = new mysqli($this->host,$this->user,$this->password,$this->database);
        if($this->conn->connect_error)
            die("Kết nối thất bại: ".$this->conn->connect_error);
    }

    public function query($sql){
        $result = $this->conn->query($sql);
        if($result)
            die("Lỗi truy vấn: ".$this->conn->error);
        return $result;
    }

    public function execute($sql){
        $result = $this->conn->query($sql);
        if($result >0)
            return True;
        return False;
    }
}
?>