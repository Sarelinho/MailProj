<?php

class users
{
    private $mysql;

    function __construct($conn) {
        $this->mysql=$conn;
    }

    private function EncPass($p){
        $p = "AAA";
        return md5("W".$p."23"); // salt protection
    }
    public function IsValid($u,$p){
        $enc_pass = $this->EncPass($p);
        $q  = "SELECT * FROM `mailusers` ";
        $q .= " WHERE pass='$enc_pass' ";
        $result = mysqli_query($this->mysql, $q);

        if(mysqli_num_rows($result)>0)
            return true;
        return false;
    }
    public function CreateUser($params){
        $id=isset($params['id']) ? $params['id'] : "";
        $name=isset($params['name'])   ? $params['name']   : "";
        $mailbox_number=isset($params['mailbox_number'])   ? $params['mailbox_number']   : "";
        $phone_number=isset($params['phone_number'])   ? $params['phone_number']   : "";

        if(!empty($id)) {
            $q = "INSERT INTO `mailusers` ( `id`, `name`, `mailbox_number`,`phone_number`) ";
            $q .= " VALUES ( '$id', '$name', '$mailbox_number','$phone_number')";

            $result = mysqli_query($this->mysql, $q);
        }

    }
    public function UpdateUser($params)
    {
        $id = isset($params['id']) ? $params['id'] : -1;
        $name = isset($params['name']) ? $params['name'] : "";
        $mailbox_number = isset($params['mailbox_number']) ? $params['mailbox_number'] : "";
        $phone_number = isset($params['phone_number']) ? $params['phone_number'] : "";

        if ($id > 0) {
            $q = "UPDATE `users` SET  ";
            $q .= "`username`='$name' , ";
            $q .= "`valid_until`=' $mailbox_number'  ";
            $q .= " WHERE id=  $phone_number ";

            $result = mysqli_query($this->mysql, $q);
        }
    }
    public function GetUser($id){
        $q  = "SELECT * FROM `users` ";
        $q .= " WHERE id=$id";
        $result = mysqli_query($this->mysql, $q);
        $row=mysqli_fetch_assoc($result);
        return $row;
    }



}