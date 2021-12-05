<?php

Class Model{
    
    protected static $tablename = '';
    protected static $columns = [];
    protected $values = [];

    function __construct($arr, $sanitize = true){
        $this->loadFromArray($arr, $sanitize);
    }

    public function loadFromArray($arr, $sanitize = true){
        if($arr){
            foreach ($arr as $key => $value){
                $cleanValue = $value;
                if($sanitize && isset($cleanValue)){
                    $cleanValue = strip_tags(trim($cleanValue));
                    $cleanValue = htmlentities($cleanValue, ENT_NOQUOTES);
                }
                $this->$key = $cleanValue;
            }
        }
    }

    public function __get($key){
        return $this->values[$key];
    }

    public function __set($key, $value){
        $this->values[$key] = $value;
    }

    public function getValues(){
        return $this->values;
    }

    public function getOne($filters = [], $columns = '*'){
        $class = get_called_class();
        $result = static::getResultGetFromSelect($filters, $columns);
        return $result ? new $class(pg_fetch_assoc($result)) : null;
    }

    public function get($filters = [], $columns = '*'){
        $objects = [];
        $result = static::getResultGetFromSelect($filters, $columns);
        if($result){
            $class = get_called_class();
            while ($row = pg_fetch_assoc($result)) {
                array_push($objects, new $class($row));
            }
        }
        return $objects;
    }

    public function getResultGetFromSelect($filters = [], $columns = '*'){
        $sql = "SELECT {$columns} FROM "
        . static::$tablename
        . static::getFilters($filters);
        $result = Database::getResultFromQuery($sql);
        if($result->num_rows === 0){
            return null;
        }else{
            return $result;
        }
    }
    
    public function insert(){
        $sql = "INSERT INTO pessoa (id, nome, email, senha, ativo) VALUES (
            default, '{$this->name}', '{$this->email}', '{$this->password}', TRUE) RETURNING id";
        $id = Database::executeSQL($sql);
        $this->id = $id[0];
        
        $sql = " INSERT INTO cliente (id, pessoa_id, endereco, cpf)
            VALUES (default, {$this->id}, '{$this->address}', {$this->cpf})";
        Database::executeSQL($sql);
        
        $sql = " INSERT INTO telefone_pessoa (id, pessoa_id, telefone, principal, descricao)
            VALUES (default, {$this->id}, {$this->phone}, TRUE, 'celular')";
        Database::executeSQL($sql);
    }

    public static function deleteById($id) {
        $sql = "UPDATE pessoa SET ativo = FALSE WHERE id = {$id}";
        Database::executeSQL($sql);
    }

    public function update(){
        $sql = "UPDATE pessoa SET nome = '{$this->name}', senha = '{$this->password}'
            WHERE id = {$this->id}";
        Database::executeSQL($sql);

        $sql = "UPDATE cliente SET endereco = '{$this->address}', cpf = '{$this->cpf}'
            WHERE pessoa_id = {$this->id}";
        Database::executeSQL($sql);

        $sql = "UPDATE telefone_pessoa SET telefone = '{$this->phone}'
            WHERE pessoa_id = {$this->id}";
        Database::executeSQL($sql);
    }

    private static function getFilters($filters){
        $sql = '';
        if(count($filters) > 0){
            $sql .= ' WHERE 1 = 1 ';
            foreach ($filters as $column => $value) {
                $sql .=" AND {$column}  = " . static::getFormatedValue($value);
            }
        }
        return $sql;
    }

    private static function getFormatedValue($value){
        if(is_null($value)){
            return 'null';
        }elseif (gettype($value) === 'string') {
            return "'{$value}'";
        }else {
            return $value;
        }
    }

    public static function getClients(){
        $objects = [];
        $sql = "SELECT pessoa.id, nome, telefone, email FROM pessoa
        INNER JOIN telefone_pessoa ON pessoa_id = pessoa.id
        WHERE pessoa.ativo = TRUE";
        $result = Database::getResultFromQuery($sql);
        if($result){
            $class = get_called_class();
            while ($row = pg_fetch_assoc($result)) {
                array_push($objects, new $class($row));
            }
        }
        return $objects;
    }

    public function getClient($id){
        $objects = [];
        $sql = "SELECT pessoa.id, nome AS name, cpf, telefone AS phone, endereco AS address, email FROM pessoa
        INNER JOIN telefone_pessoa ON telefone_pessoa.pessoa_id = pessoa.id
        INNER JOIN cliente ON cliente.pessoa_id = pessoa.id
        WHERE pessoa.id = {$id}";
        $class = get_called_class();
        $result = Database::getResultFromQuery($sql);
        return $result ? new $class(pg_fetch_assoc($result)) : null;
    }

}