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
                //     $cleanValue = htmlentities($cleanValue, ENT_NOQUOTES);
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

    public static function getClients(){
        $objects = [];
        $sql = "SELECT pessoa.id, nome, telefone, email FROM pessoa
            INNER JOIN telefone_pessoa ON telefone_pessoa.pessoa_id = pessoa.id
            INNER JOIN cliente ON cliente.pessoa_id = pessoa.id
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

    public static function getProviders(){
        $objects = [];
        $sql = "SELECT fornecedor.id, cnpj, razao_social AS corporate_name, nome_fantasia AS business_name,
            endereco AS address, contato AS contact, email, servico AS service, telefone AS phone  FROM fornecedor
            INNER JOIN telefone_fornecedor ON telefone_fornecedor.fornecedor_id = fornecedor.id
            INNER JOIN servico_fornecedor ON servico_fornecedor.fornecedor_id = fornecedor.id
            INNER JOIN servico ON servico.id = servico_fornecedor.servico_id
            WHERE fornecedor.ativo = TRUE AND servico_fornecedor.principal = TRUE";
        $result = Database::getResultFromQuery($sql);
        if($result){
            $class = get_called_class();
            while ($row = pg_fetch_assoc($result)) {
                array_push($objects, new $class($row));
            }
        }
        return $objects;
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

    public static function deleteProviderById($id) {
        $sql = "UPDATE fornecedor SET ativo = FALSE WHERE id = {$id}";
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

    public function getRoles(){
        $objects = [];
        $sql = "SELECT * FROM funcao";
        $result = Database::getResultFromQuery($sql);
        if($result){
            $class = get_called_class();
            while($row = pg_fetch_assoc($result)){
                array_push($objects, new $class($row));
            }
        }
        return $objects;
    }

    public function getUser($id){
        $objects = [];
        $sql = "SELECT pessoa.id, nome AS name, email, telefone AS phone, funcao_id AS role FROM pessoa
        INNER JOIN telefone_pessoa ON telefone_pessoa.pessoa_id = pessoa.id
        INNER JOIN usuario ON usuario.pessoa_id = pessoa.id
        WHERE pessoa.id = {$id}";
        $class = get_called_class();
        $result = Database::getResultFromQuery($sql);
        return $result ? new $class(pg_fetch_assoc($result)) : null;
    }

    public static function getUsers(){
        $objects = [];
        $sql = "SELECT pessoa.id, nome, telefone, email FROM pessoa
        INNER JOIN telefone_pessoa ON telefone_pessoa.pessoa_id = pessoa.id
        INNER JOIN usuario ON usuario.pessoa_id = pessoa.id
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
    
    public function insertUser(){
        $sql = "INSERT INTO pessoa (id, nome, email, senha, ativo)
            VALUES (default, '{$this->name}', '{$this->email}', '{$this->password}', TRUE) RETURNING id";
        $id = Database::executeSQL($sql);
        $this->id = $id[0];
        
        $sql = "INSERT INTO usuario (id, pessoa_id, funcao_id)
            VALUES (default, {$this->id}, {$this->role})";
        Database::executeSQL($sql);
        
        $sql = "INSERT INTO telefone_pessoa (id, pessoa_id, telefone, principal, descricao)
            VALUES (default, {$this->id}, {$this->phone}, TRUE, 'celular')";
        Database::executeSQL($sql);
    }
    
    public function updateUser(){
        $sql = "UPDATE pessoa SET nome = '{$this->name}', senha = '{$this->password}'
            WHERE id = {$this->id}";
        Database::executeSQL($sql);
        
        $sql = "UPDATE usuario SET funcao_id = {$this->role}
            WHERE pessoa_id = {$this->id}";
        Database::executeSQL($sql);
        
        $sql = "UPDATE telefone_pessoa SET telefone = {$this->phone}
            WHERE pessoa_id = {$this->id}";
        Database::executeSQL($sql);
    }

    public static function deleteUserById($id) {
        $sql = "UPDATE pessoa SET ativo = FALSE WHERE id = {$id}";
        Database::executeSQL($sql);
    }

    public function getEvent(){
        $objects = [];
        $sql = "SELECT evento.id, nome, data, num_convidados FROM evento
        WHERE evento.ativo = TRUE";
        $class = get_called_class();
        $result = Database::getResultFromQuery($sql);
        return $result ? new $class(pg_fetch_assoc($result)) : null;
    }

    //TODO: adicionar outros componentes do evento
    public static function getEvents(){
        $objects = [];
        $sql = "SELECT evento.id, evento.nome AS name, data
                    FROM evento";
        $result = Database::getResultFromQuery($sql);
        if($result){
            $class = get_called_class();
            while ($row = pg_fetch_assoc($result)) {
                array_push($objects, new $class($row));
            }
        }
        return $objects;
    }

    public static function getEventIdFromGuest($id){
        $sql = "SELECT evento.id FROM evento
                    INNER JOIN convidado_evento ON convidado_evento.evento_id = evento.id
                    WHERE convidado_id = {$id}";
        $class = get_called_class();
        $result = Database::getResultFromQuery($sql);
        return $result ? new $class(pg_fetch_assoc($result)) : null;
    }

    public static function getEventIdFromRoadmap($id){
        $sql = "SELECT evento.id FROM evento
                    INNER JOIN roteiro ON roteiro.evento_id = evento.id
                    WHERE roteiro.id = {$id}";
        $class = get_called_class();
        $result = Database::getResultFromQuery($sql);
        return $result ? new $class(pg_fetch_assoc($result)) : null;
    }

    public static function getGuests($id){
        $objects = [];
        $sql = "SELECT convidado.id, convidado.nome AS name, num_acompanhantes AS num_accompany, 
                    email, telefone AS phone, situacao AS confirm, evento.nome AS event_name FROM convidado
                    INNER JOIN telefone_convidado ON telefone_convidado.convidado_id = convidado.id
                    INNER JOIN convidado_evento ON convidado_evento.convidado_id = convidado.id
                    INNER JOIN evento ON convidado_evento.evento_id = evento.id
                    WHERE evento_id = {$id}";
        $result = Database::getResultFromQuery($sql);
        if($result){
            $class = get_called_class();
            while ($row = pg_fetch_assoc($result)) {
                array_push($objects, new $class($row));
            }
        }
        return $objects;
    }

    public static function guestsTotal($event_id){
        $objects = [];
        $sql = "SELECT num_convidados AS initial, SUM(num_acompanhantes + 1) AS guests,
                    SUM(CASE WHEN situacao = TRUE THEN num_acompanhantes + 1 ELSE null END) AS confirmed FROM evento	
                    INNER JOIN convidado_evento ON convidado_evento.evento_id = evento.id
                    INNER JOIN convidado ON convidado.id = convidado_evento.convidado_id
                    WHERE evento.id = {$event_id}
                    GROUP BY evento.id";
        
        $result = Database::getResultFromQuery($sql);
        if($result){
            $class = get_called_class();
            while ($row = pg_fetch_assoc($result)) {
                array_push($objects, new $class($row));
            }
        }
        return $objects;
    }
    
    public function insertGuest(){
        $sql = "INSERT INTO convidado (id, nome, num_acompanhantes, email)
            VALUES (default, '{$this->name}', '{$this->num_accompany}', '{$this->email}') RETURNING id";
        $id = Database::executeSQL($sql);
        $this->id = $id[0];
        
        $sql = "INSERT INTO convidado_evento (id, evento_id, convidado_id, situacao)
            VALUES (default, {$this->event_id}, {$this->id}, {$this->confirm})";
        Database::executeSQL($sql);
        
        $sql = "INSERT INTO telefone_convidado (id, convidado_id, telefone, principal)
            VALUES (default, {$this->id}, {$this->phone}, TRUE)";
        Database::executeSQL($sql);
    }

    public static function getGuest($id){
        $objects = [];
        $sql = "SELECT convidado.id, convidado.nome AS name, num_acompanhantes AS num_accompany, 
                    email, telefone AS phone, situacao AS confirm FROM convidado
                    INNER JOIN telefone_convidado ON telefone_convidado.convidado_id = convidado.id
                    INNER JOIN convidado_evento ON convidado_evento.convidado_id = convidado.id
                    WHERE convidado.id = {$id}";
        $class = get_called_class();
        $result = Database::getResultFromQuery($sql);
        return $result ? new $class(pg_fetch_assoc($result)) : null;
    }
    
    public function updateGuest($id){
        $sql = "UPDATE convidado SET nome = '{$this->name}', num_acompanhantes = '{$this->num_accompany}'
            WHERE id = {$this->id}";
        Database::executeSQL($sql);
        
        $sql = "UPDATE convidado_evento SET situacao = {$this->confirm}
            WHERE convidado_id = {$this->id}";
        Database::executeSQL($sql);
        
        $sql = "UPDATE telefone_convidado SET telefone = {$this->phone}
            WHERE convidado_id = {$this->id}";
        Database::executeSQL($sql);
    }

    public static function deleteGuestById($id) {
        $sql = "DELETE FROM convidado 
            WHERE id = {$id}";
        Database::executeSQL($sql);
    }

    public static function getRoadmaps($id){
        $objects = [];
        $sql = "SELECT id, nome AS name, hora AS hour, minuto AS minute FROM roteiro
                    WHERE evento_id = {$id}";
        $result = Database::getResultFromQuery($sql);
        if($result){
            $class = get_called_class();
            while ($row = pg_fetch_assoc($result)) {
                array_push($objects, new $class($row));
            }
        }
        return $objects;
    }
    
    public function insertRoadmap(){
        $sql = "INSERT INTO roteiro (id, evento_id, nome, hora, minuto)
            VALUES (default, '{$this->event_id}', '{$this->name}', '{$this->hour}', '{$this->minute}')";
        $id = Database::executeSQL($sql);
    }

    public static function getRoadmap($id){
        $objects = [];
        $sql = "SELECT id, evento_id AS event_id, nome AS name, hora AS hour, minuto AS minute FROM roteiro
                    WHERE id = {$id}";
        $class = get_called_class();
        $result = Database::getResultFromQuery($sql);
        return $result ? new $class(pg_fetch_assoc($result)) : null;
    }
    
    public function updateRoadmap($id){
        $sql = "UPDATE roteiro SET nome = '{$this->name}', hora = {$this->hour}, minuto = {$this->minute}
            WHERE id = {$this->id}";
        Database::executeOnlySQL($sql);
    }

    public static function deleteRoadmapById($id) {
        $sql = "DELETE FROM roteiro
            WHERE id = {$id}";
        Database::executeSQL($sql);
    }

    public static function getSequences($id){
        $objects = [];
        $sql = "SELECT id, ordem AS order, descricao AS description, observacao AS note FROM sequencia
                    WHERE roteiro_id = {$id}";
        $result = Database::getResultFromQuery($sql);
        if($result){
            $class = get_called_class();
            while ($row = pg_fetch_assoc($result)) {
                array_push($objects, new $class($row));
            }
        }
        return $objects;
    }
    
    public function insertSequence(){
        $sql = "INSERT INTO sequencia (id, roteiro_id, descricao, ordem, observacao)
            VALUES (default, '{$this->roadmapId}', '{$this->description}', '{$this->order}', '{$this->note}')";
        $id = Database::executeSQL($sql);
    }

    public static function getSequence($id){
        $objects = [];
        $sql = "SELECT id, roteiro_id AS roadmapId, descricao AS description, ordem AS order, observacao AS note FROM sequencia
                    WHERE id = {$id}";
        $class = get_called_class();
        $result = Database::getResultFromQuery($sql);
        return $result ? new $class(pg_fetch_assoc($result)) : null;
    }
    
    public function updateSequence($id){
        $sql = "UPDATE sequencia SET descricao = '{$this->description}', ordem = {$this->order}, observacao = '{$this->note}'
            WHERE id = {$this->id}";
        Database::executeOnlySQL($sql);
    }

    public static function getRoadmapIdFromSequence($id){
        $sql = "SELECT roteiro_id AS roadmapid FROM sequencia
                    WHERE id = {$id}";
        $result = Database::getResultFromQuery($sql);
        $class = get_called_class();
        return $result ? new $class(pg_fetch_assoc($result)) : null;
    }

    public static function getEventIdFromSequence($id){
        $sql = "SELECT evento_id AS eventid FROM sequencia
                    INNER JOIN roteiro ON roteiro.id = roteiro_id
                    WHERE sequencia.id = {$id}";
        $result = Database::getResultFromQuery($sql);
        $class = get_called_class();
        return $result ? new $class(pg_fetch_assoc($result)) : null;
    }

    public static function getLastOrder($id){
        $sql = "SELECT ordem AS next FROM sequencia
                    WHERE roteiro_id = {$id}
                    ORDER BY ordem DESC
                    LIMIT 1";
        $result = Database::executeSQL($sql);
        return $result;
    }

    public static function deleteSequenceById($id, $roadmapId) {
        $result = null;
        $sql = "DELETE FROM sequencia
            WHERE id = {$id}
            RETURNING ordem";
        $result = Database::executeSQL($sql);
        $lastSequence = Model::getLastOrder($roadmapId);
        while($result[0] <= $lastSequence[0]){
            $sql = "UPDATE sequencia
                SET ordem = {$result[0]}";
                $result[0]++;
                $sql .= " WHERE roteiro_id = {$roadmapId} AND ordem = {$result[0]}";
            Database::executeSQL($sql);
        }
    }
}