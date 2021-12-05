<?php

Class People extends Model{

    protected static $tablename = 'pessoa';
    protected static $columns = [
        'id',
        'name',
        'email',
        'password',
    ];

    public function verifyEmail(){
        $sql = "SELECT * FROM pessoa WHERE email='{$this->email}'";
        $result = Database::executeSQL($sql);
        if($result[2] === $this->email){
            return false;
        }else{
            return true;
        }
    }
}