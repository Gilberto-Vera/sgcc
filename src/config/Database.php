<?php

class Database {

    public static function getConnection(){
        $envPath = realpath(dirname(__FILE__) . '/../env.ini');
        $env = parse_ini_file($envPath);
        $conn = pg_connect("host = {$env['host']} user = {$env['user']}
             password = {$env['password']} dbname = {$env['dbname']}");

        if($conn->connect_error) {
            die('Erro:' . $conn->connect_error);
        }

        return $conn;
    }

    public static function getResultFromQuery($sql){
        $conn = self::getConnection();
        $result = pg_query($sql);
        pg_close($conn);
        return $result;
    }
}