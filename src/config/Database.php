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
        $result = pg_query($conn, $sql);
        pg_close($conn);
        return $result;
    }

    public static function executeSQL($sql){
        $conn = self::getConnection();
        $result = pg_query($conn, $sql);
        if(!$result) {
            throw new Exception(pg_last_error($conn));
        }
        $row = pg_fetch_row($result);
        pg_close($conn);
        return $row;
    }

    public static function executeOnlySQL($sql){
        $conn = self::getConnection();
        $result = pg_query($conn, $sql);
        if(!$result) {
            throw new Exception(pg_last_error($conn));
        }
        pg_close($conn);
    }
}