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


}