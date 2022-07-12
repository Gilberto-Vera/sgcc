<?php

Class Event extends Model{

    protected static $tablename = 'evento';
    protected static $columns = [
        'id',
        'name',
        'date',
        'note',
    ];
    
    public function insert() {
        $this->validate();
        $this->insertEvent();
    }
    
    public function update() {
        $this->validateUpdate();
        $this->updateEvent();
    }

    private function validate(){
        $errors = [];

        if(!$this->name){
            $errors['name'] = 'Insira um nome...';
        }elseif(!validateName($this->name)){
            $errors['name'] = 'Use somente letras, números e espaço...';
        }else{
            $this->name = validateName($this->name);
        }

        if(!$this->situation){
            $errors['situation'] = 'Escolha uma situação...';
        }

        if(!$this->date){
            $errors['date'] = 'Insira uma data...';
        }

        if($this->numGuests == ''){
            $errors['numGuests'] = 'Insira a quantidade de convidados...';
        }elseif(!is_numeric($this->numGuests)){
            $errors['numGuests'] = 'Insira apenas números...';
        }

        if($this->clientId == ''){
            $errors['clientName'] = 'Adicione um cliente...';
        }

        if($this->providerId == ''){
            $errors['providerName'] = 'Adicione o local do evento...';
        }

        if($this->userId == ''){
            $errors['userName'] = 'Adicione um usuário...';
        }

        if(count($errors) > 0){
            throw new ValidationException($errors);
        }else{
            $this->date = formatDateTime($this->date);
        }
    }

    private function validateUpdate(){
        $errors = [];

        if(!$this->name){
            $errors['name'] = 'Insira um nome...';
        }elseif(!validateName($this->name)){
            $errors['name'] = 'Use somente letras, números e espaço...';
        }else{
            $this->name = validateName($this->name);
        }

        if(!$this->situation){
            $errors['situation'] = 'Escolha uma situação...';
        }

        if(count($errors) > 0){
            throw new ValidationException($errors);
        }
    }

    public function insertEvent(){
        $sql = "INSERT INTO evento (id, situacao_id, nome, data, num_convidados, observacao, ativo)
                    VALUES (default, {$this->situation}, '{$this->name}', '{$this->date}', {$this->numGuests},
                    '', TRUE) RETURNING id";
        $id = Database::executeSQL($sql);
        $this->id = $id[0];
        
        $sql = " INSERT INTO cliente_evento (id, cliente_id, evento_id)
            VALUES (default, {$this->clientId}, {$this->id})";
        Database::executeSQL($sql);
        
        $sql = " INSERT INTO usuario_evento (id, usuario_id, evento_id)
            VALUES (default, {$this->userId}, {$this->id})";
        Database::executeSQL($sql);

        $sql = "INSERT INTO parceiro (id, evento_id, fornecedor_id, servico_id, num_colaboradores, situacao)
                    VALUES (default, {$this->id}, {$this->providerId}, {$this->serviceId}, 0, TRUE)";
        Database::executeSQL($sql);
    }

    public function getSituations(){
        $objects = [];
        $sql = "SELECT id, descricao AS description FROM situacao";
        $result = Database::getResultFromQuery($sql);
        if($result){
            $class = get_called_class();
            while($row = pg_fetch_assoc($result)){
                array_push($objects, new $class($row));
            }
        }
        return $objects;
    }

    public function getEventToEdit($id){
        $sql = "SELECT id, evento.nome AS name, situacao_id AS situation FROM evento
                    WHERE evento.id = {$id}";
        $class = get_called_class();
        $result = Database::getResultFromQuery($sql);
        return $result ? new $class(pg_fetch_assoc($result)) : null;
    }
    
    public function updateEvent(){
        $sql = "UPDATE evento SET nome = '{$this->name}', situacao_id = '{$this->situation}'
            WHERE id = {$this->id}";
        Database::executeSQL($sql);
    }
}