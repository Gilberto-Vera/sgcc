<?php

Class Provider extends Model{

    protected static $tablename = 'fornecedor';
    protected static $columns = [
        'id',
        'cnpj',
        'corporate_name',
        'business_name',
        'address',
        'contact',
        'email',
    ];

    public function insert() {
        $this->validate();
        return parent::insertProvider();
    }

    public function update() {
        $this->validateUpdate();
        return parent::updateProvider();
    }

    public function verifyEmail($email){
        $sql = "SELECT email FROM fornecedor
            WHERE email = '{$email}'";
        $result = Database::getResultFromQuery($sql);
        return $result ? pg_fetch_assoc($result) : null;
    }

    private function validate(){
        $errors = [];

        if(!$this->corporate_name){
            $errors['corporate_name'] = 'Insira uma Razão Social...';
        }elseif(!validateName($this->corporate_name)){
            $errors['corporate_name'] = 'Use somente letras, números e espaço...';
        }else{
            $this->corporate_name = validate($this->corporate_name);
        }

        if(!$this->business_name){
            $errors['business_name'] = 'Insira um Nome Fantasia...';
        }elseif(!validateName($this->business_name)){
            $errors['business_name'] = 'Use somente letras, números e espaço...';
        }else{
            $this->business_name = validate($this->business_name);
        }

        if(!$this->cnpj){
            $errors['cnpj'] = 'Insira um CNPJ...';
        }elseif(!validateCNPJ($this->cnpj)){
            $errors['cnpj'] = 'CNPJ inválido...';
        }else{
            $this->cnpj = validateCNPJ($this->cnpj);
        }

        $phone = validatePhone($this->phone);
        if(!$this->phone){
            $errors['phone'] = 'Insira um telefone...';
        }elseif(!$phone){
            $errors['phone'] = 'Telefone inválido...';
        }else{
            $this->phone = $phone['number'];
        }

        if(!$this->address){
            $errors['address'] = 'Insira um Endereço...';
        }else{
            $this->address = validate($this->address);
        }

        if(!$this->email){
            $errors['email'] = 'Insira um email...';
        }elseif(!validateEmail($this->email)){
            $errors['email'] = 'Email inválido...';
        }elseif($this->verifyEmail($this->email)){
            $errors['email'] = 'Email já cadastrado...';
        }else{
            $this->email = validate($this->email);
        }

        if(!$this->contact){
            $errors['contact'] = 'Insira um nome para contato...';
        }elseif(!validateName($this->contact)){
            $errors['contact'] = 'Use somente letras, números e espaço...';
        }else{
            $this->contact = validate($this->contact);
        }

        if(!$this->service_id){
            $errors['service_id'] = 'Escolha um serviço...';
        }

        if(count($errors) > 0){
            throw new ValidationException($errors);
        }
    }

    private function validateUpdate(){
        $errors = [];

        if(!$this->corporate_name){
            $errors['corporate_name'] = 'Insira uma Razão Social...';
        }elseif(!validateName($this->corporate_name)){
            $errors['corporate_name'] = 'Use somente letras, números e espaço...';
        }else{
            $this->corporate_name = validate($this->corporate_name);
        }

        if(!$this->business_name){
            $errors['business_name'] = 'Insira um Nome Fantasia...';
        }elseif(!validateName($this->business_name)){
            $errors['business_name'] = 'Use somente letras, números e espaço...';
        }else{
            $this->business_name = validate($this->business_name);
        }

        $phone = validatePhone($this->phone);
        if(!$this->phone){
            $errors['phone'] = 'Insira um telefone...';
        }elseif(!$phone){
            $errors['phone'] = 'Telefone inválido...';
        }else{
            $this->phone = $phone['number'];
        }

        if(!$this->address){
            $errors['address'] = 'Insira um Endereço...';
        }else{
            $this->address = validate($this->address);
        }

        if(!$this->contact){
            $errors['contact'] = 'Insira um nome para contato...';
        }elseif(!validateName($this->contact)){
            $errors['contact'] = 'Use somente letras, números e espaço...';
        }else{
            $this->contact = validate($this->contact);
        }

        if(!$this->service_id){
            $errors['service_id'] = 'Escolha um serviço...';
        }

        if(count($errors) > 0){
            throw new ValidationException($errors);
        }
    }

    public function getProviderForPartner($id){
        $objects = [];
        $sql = "SELECT id AS provider_id, nome_fantasia AS business_name FROM fornecedor
            WHERE fornecedor.id = {$id}";
        $class = get_called_class();
        $result = Database::getResultFromQuery($sql);
        return $result ? new $class(pg_fetch_assoc($result)) : null;
    }

    public static function searchToIncludeEvent($name){
        $objects = [];
        $sql = "SELECT fornecedor.id, nome_fantasia AS business_name, servico.id AS service_id FROM fornecedor
            INNER JOIN servico_fornecedor ON servico_fornecedor.fornecedor_id = fornecedor.id
            INNER JOIN servico ON servico.id = servico_fornecedor.servico_id
            WHERE servico.servico = 'Recepção' AND nome_fantasia ILIKE '%{$name}%'";
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