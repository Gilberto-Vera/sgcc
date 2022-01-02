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
    
    public function insertClient(){
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
    
    public function updateClient(){
        $sql = "UPDATE pessoa SET nome = '{$this->name}', senha = '{$this->password}'
            WHERE id = {$this->id}";
        Database::executeSQL($sql);
        
        $sql = "UPDATE cliente SET endereco = '{$this->address}'
            WHERE pessoa_id = {$this->id}";
        Database::executeSQL($sql);
        
        $sql = "UPDATE telefone_pessoa SET telefone = '{$this->phone}'
            WHERE pessoa_id = {$this->id}";
        Database::executeSQL($sql);
    }
    
        public static function deleteClientById($id) {
            $sql = "UPDATE pessoa SET ativo = FALSE WHERE id = {$id}";
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

    public static function getProviders(){
        $objects = [];
        $sql = "SELECT fornecedor.id, cnpj, razao_social AS corporate_name, nome_fantasia AS business_name,
            endereco AS address, contato AS contact, email, servico AS service, telefone AS phone  FROM fornecedor
        INNER JOIN telefone_fornecedor ON telefone_fornecedor.fornecedor_id = fornecedor.id
        INNER JOIN servico_fornecedor ON servico_fornecedor.fornecedor_id = fornecedor.id
        INNER JOIN servico ON servico.id = servico_fornecedor.servico_id
        WHERE fornecedor.ativo = TRUE";
        $result = Database::getResultFromQuery($sql);
        if($result){
            $class = get_called_class();
            while ($row = pg_fetch_assoc($result)) {
                array_push($objects, new $class($row));
            }
        }
        return $objects;
    }

    public function getProvider($id){
        $objects = [];
        $sql = "SELECT fornecedor.id, cnpj, razao_social AS corporate_name, nome_fantasia AS business_name,
            endereco AS address, contato AS contact, email, servico.id AS serviceid, servico AS service, 
            telefone AS phone  FROM fornecedor
        INNER JOIN telefone_fornecedor ON telefone_fornecedor.fornecedor_id = fornecedor.id
        INNER JOIN servico_fornecedor ON servico_fornecedor.fornecedor_id = fornecedor.id
        INNER JOIN servico ON servico.id = servico_fornecedor.servico_id
        WHERE servico_fornecedor.principal = TRUE
        AND fornecedor.id = {$id}";
        $class = get_called_class();
        $result = Database::getResultFromQuery($sql);
        return $result ? new $class(pg_fetch_assoc($result)) : null;
    }
    
    public function insertProvider(){
        $sql = "INSERT INTO fornecedor (id, cnpj, razao_social, nome_fantasia, endereco, contato, email, ativo) VALUES (
            default, '{$this->cnpj}', '{$this->corporate_name}', '{$this->business_name}', '{$this->address}',
            '{$this->contact}', '{$this->email}', TRUE) RETURNING id";
        $id = Database::executeSQL($sql);
        $this->id = $id[0];
        
        $sql = " INSERT INTO servico_fornecedor (id, fornecedor_id, servico_id, principal)
            VALUES (default, {$this->id}, '{$this->service_id}', TRUE)";
        Database::executeSQL($sql);
        
        $sql = " INSERT INTO telefone_fornecedor (id, fornecedor_id, descricao, telefone, principal)
            VALUES (default, {$this->id}, 'celular', {$this->phone}, TRUE)";
        Database::executeSQL($sql);
    }
    
    public function updateProvider(){

        $sql = "UPDATE fornecedor SET razao_social = '{$this->corporate_name}', 
            nome_fantasia = '{$this->business_name}', endereco = '{$this->address}', contato = '{$this->contact}'
            WHERE id = {$this->id}";
        $id = Database::executeSQL($sql);
        
        $sql = "UPDATE servico_fornecedor SET servico_id = {$this->service_id}
            WHERE fornecedor_id = {$this->id} AND principal = TRUE";
        Database::executeSQL($sql);
        
        $sql = "UPDATE telefone_fornecedor SET telefone = {$this->phone}
            WHERE fornecedor_id = {$this->id}  AND principal = TRUE";
        Database::executeSQL($sql);
    }

    public function getServices(){
        $objects = [];
        $sql = "SELECT * FROM servico";
        $result = Database::getResultFromQuery($sql);
        if($result){
            $class = get_called_class();
            while($row = pg_fetch_assoc($result)){
                array_push($objects, new $class($row));
            }
        }
        return $objects;
    }

    public static function deleteProviderById($id) {
        $sql = "UPDATE fornecedor SET ativo = FALSE WHERE id = {$id}";
        Database::executeSQL($sql);
    }
}