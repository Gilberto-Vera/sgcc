<?php

Class Partner extends Model{

    protected static $tablename = 'parceiro';
    protected static $columns = [
        'id',
        'event_id',
        'provider_id',
        'service_id',
        'num_collaborators',
        'situation'
    ];
    
    public function insert() {
        $this->validate();
        return $this->insertPartner();
    }
    
    public function update() {
        $this->validateUpdate();
        return $this->updatePartner();
    }

    private function validate(){
        $errors = [];

        if(!$this->service_id){
            $errors['service_id'] = 'Escolha um serviço...';
        }

        if($this->num_collaborators == ''){
            $errors['num_collaborators'] = 'Insira a quantidade de colaboradores...';
        }elseif(!is_numeric($this->num_collaborators)){
            $errors['num_collaborators'] = 'Insira apenas números...';
        }

        if(!$this->situation){
            $errors['situation'] = 'Selecione...';
        }elseif ($this->situation == 'f'){
            $this->situation = 'FALSE';
        }elseif ($this->situation == 't'){
            $this->situation = 'TRUE';
        }

        if(count($errors) > 0){
            throw new ValidationException($errors);
        }
    }

    private function validateUpdate(){
        $errors = [];

        if(!$this->service_id){
            $errors['service_id'] = 'Escolha um serviço...';
        }

        if($this->num_collaborators == ''){
            $errors['num_collaborators'] = 'Insira a quantidade de colaboradores...';
        }elseif(!is_numeric($this->num_collaborators)){
            $errors['num_collaborators'] = 'Insira apenas números...';
        }

        if(!$this->situation){
            $errors['situation'] = 'Selecione...';
        }elseif ($this->situation == 'f'){
            $this->situation = 'FALSE';
        }elseif ($this->situation == 't'){
            $this->situation = 'TRUE';
        }

        if(count($errors) > 0){
            throw new ValidationException($errors);
        }
    }

    public static function getEventPartners($id){
        $objects = [];
        $sql = "SELECT parceiro.id, evento_id AS event_id, fornecedor_id AS provider_id, nome_fantasia AS business_name,
                    servico AS service, num_colaboradores AS num_collaborators, situacao AS situation FROM parceiro
                    INNER JOIN fornecedor ON fornecedor.id = parceiro.fornecedor_id
                    INNER JOIN servico ON servico.id = servico_id
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

    public static function getPartner($id){
        $objects = [];
        $sql = "SELECT parceiro.id, evento_id AS event_id, nome_fantasia AS business_name, servico AS service,
                    servico_id AS service_id, num_colaboradores AS num_collaborators, 
                    situacao AS situation FROM parceiro
                    INNER JOIN fornecedor ON fornecedor.id = parceiro.fornecedor_id
                    INNER JOIN servico ON servico.id = servico_id
                    WHERE parceiro.id = {$id}";
        $class = get_called_class();
        $result = Database::getResultFromQuery($sql);
        return $result ? new $class(pg_fetch_assoc($result)) : null;
    }

    public static function getPartnerServices($id){
        $objects = [];
        $sql = "SELECT servico.id, servico AS service FROM servico
                    INNER JOIN servico_fornecedor ON servico_fornecedor.servico_id = servico.id
                    WHERE servico_fornecedor.fornecedor_id = {$id}";
        $result = Database::getResultFromQuery($sql);
        if($result){
            $class = get_called_class();
            while($row = pg_fetch_assoc($result)){
                array_push($objects, new $class($row));
            }
        }
        return $objects;
    }
    
    public function insertPartner(){
        $sql = "INSERT INTO parceiro (id, evento_id, fornecedor_id, servico_id, num_colaboradores, situacao)
                    VALUES (default, {$this->event_id}, {$this->provider_id}, {$this->service_id}, {$this->num_collaborators},
                    '{$this->situation}')";
        Database::executeSQL($sql);
    }
    
    private function updatePartner(){

        $sql = "UPDATE parceiro SET servico_id = {$this->service_id}, num_colaboradores = {$this->num_collaborators},
                    situacao = {$this->situation}
                    WHERE id = {$this->id}";
        Database::executeSQL($sql);
    }

    public static function deletePartnerById($id) {
        $sql = "DELETE FROM parceiro 
                    WHERE id = {$id}
                    RETURNING evento_id";
        $result = Database::executeSQL($sql);
        return $result[0];
    }

    public static function getIncludeEventPartners($id){
        $objects = [];
        $sql = "SELECT fornecedor.id, nome_fantasia AS business_name, servico AS service FROM fornecedor
                    INNER JOIN servico_fornecedor ON fornecedor.id = servico_fornecedor.fornecedor_id
                    INNER JOIN servico ON servico_id = servico.id
                    WHERE servico_fornecedor.principal = TRUE AND 
                        fornecedor.id IN (SELECT fornecedor.id FROM fornecedor
                            EXCEPT 
                            SELECT fornecedor_id FROM parceiro
                                WHERE evento_id = {$id})";
        $result = Database::getResultFromQuery($sql);
        if($result){
            $class = get_called_class();
            while ($row = pg_fetch_assoc($result)) {
                array_push($objects, new $class($row));
            }
        }
        return $objects;
    }
}