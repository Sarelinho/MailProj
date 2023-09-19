<?php

class users
{
    private $mysql;

    function __construct($conn) {
        $this->mysql=$conn;
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
            $q = "UPDATE `mailusers` SET ";
            $q .= "id='$id' , ";
            $q .= "name='$name' , ";
            $q .= "mailbox_number= '$mailbox_number' , ";
            $q .= "phone_number=  '$phone_number' ";
            $q.= "WHERE id=$id";
           $result = mysqli_query($this->mysql, $q);

        }
    }

    public function GetList()
    {
        $q  = "SELECT * FROM `mailusers` ";
        $result = mysqli_query($this->mysql, $q);
        $data=array();
        while($row=mysqli_fetch_assoc($result)){
            $data[]=$row;
        }
        return $data;
    }
    public function GetUser($id)
    {
        $q  = "SELECT * FROM `mailusers` ";
        $q .= " WHERE id=$id";
        $result = mysqli_query($this->mysql, $q);
        $row =mysqli_fetch_assoc($result);
        return $row;
    }
    public function  DeleteUser($id)
    {
        $q  = "DELETE  FROM `mailusers` ";
        $q.= "WHERE id=$id";
       $result = mysqli_query($this->mysql, $q);
    }



}
