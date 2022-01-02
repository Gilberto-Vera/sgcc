<?php

Class People extends Model{

    protected static $tablename = 'pessoa';
    protected static $columns = [
        'id',
        'name',
        'email',
        'password',
    ];

    public function verifyEmail($email){
        $sql = "SELECT email FROM pessoa
            WHERE email = '{$email}'";
        $result = Database::getResultFromQuery($sql);
        return $result ? pg_fetch_assoc($result) : null;
    }
}