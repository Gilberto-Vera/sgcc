<?php

Class Client extends People{

    protected static $tablename = 'cliente';
    protected static $columns = [
        'id',
        'name',
        'cpf',
        'phone',
        'address',
        'email',
        'password',
    ];
    
    public function insert() {
        $this->validateClient();
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        return parent::insert();
    }
    
    public function update() {
        $this->validateClient();
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        return parent::update();
    }

    private function validateClient(){
        $errors = [];

        if(!$this->name){
            $errors['name'] = 'Insira um nome...';
        }elseif(!validateName($this->name)){
            $errors['name'] = 'Use somente letras, números e espaço...';
        }

        if(!$this->cpf){
            $errors['cpf'] = 'Insira um CPF...';
        }elseif(!validateCPF($this->cpf)){
            $errors['cpf'] = 'CPF inválido...';
        }

        if(!$this->phone){
            $errors['phone'] = 'Insira um telefone...';
        }

        if(!$this->address){
            $errors['address'] = 'Insira um Endereço...';
        }

        if(!$this->email){
            $errors['email'] = 'Insira um email...';
        }elseif(!validateEmail($this->email)){
            $errors['email'] = 'Email inválido...';
        }
        // elseif(!parent::verifyEmail($this->email)){
        //     $errors['email'] = 'Email já cadastrado...';
        // }

        if(!$this->password) {
            $errors['password'] = 'Insira uma senha...';
        }elseif(!validatePassword($this->password)){
            $errors['password'] = 'A senha deve ter pelo menos 6 caracteres...';
        }

        if(!$this->confirm_password) {
            $errors['confirm_password'] = 'Confirme um senha...';
        }

        if($this->password && $this->confirm_password && $this->password !== $this->confirm_password){
            $errors['password'] = 'As senhas não são iguais...';
            $errors['confirm_password'] = 'As senhas não são iguais...';
        }

        if(count($errors) > 0){
            throw new ValidationException($errors);
        }
    }
}