<?php
class connect{
    private $conn;
    function constructor() {
        $this->conn=new mysqli("127.0.0.1","root","","mypham");
        $this->conn->set_charset("utf8");
        if($this->conn->connect_error){
            die("connect failed");
        }
    }
    function excuteSQL($sql){
        return $this->conn->query($sql);
    }
    function modifySQL($sql){
        $result=$this->conn->query($sql);
        if($result>0)
            return true;
        return false;
    }
    function disconnect() {
        $this->conn->close();
    }

}
?>