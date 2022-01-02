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
        return parent::insertClient();
    }
    
    public function update() {
        $this->validateUpdateClient();
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        return parent::updateClient();
    }

    private function validateClient(){
        $errors = [];

        if(!$this->name){
            $errors['name'] = 'Insira um nome...';
        }elseif(!validateName($this->name)){
            $errors['name'] = 'Use somente letras, números e espaço...';
        }else{
            $this->name = validateName($this->name);
        }

        if(!$this->cpf){
            $errors['cpf'] = 'Insira um CPF...';
        }elseif(!validateCPF($this->cpf)){
            $errors['cpf'] = 'CPF inválido...';
        }else{
            $this->cpf = validateCPF($this->cpf);
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
        }elseif(parent::verifyEmail($this->email)){
            $errors['email'] = 'Email já cadastrado...';
        }else{
            $this->email = validate($this->email);
        }

        if(!$this->password) {
            $errors['password'] = 'Insira uma senha...';
        }elseif(!validatePassword($this->password)){
            $errors['password'] = 'A senha deve ter pelo menos 6 caracteres...';
        }else{
            $this->password = validatePassword($this->password);
        }

        if(!$this->confirm_password) {
            $errors['confirm_password'] = 'Confirme a senha...';
        }

        if($this->password && $this->confirm_password && $this->password !== $this->confirm_password){
            $errors['password'] = 'As senhas não são iguais...';
            $errors['confirm_password'] = 'As senhas não são iguais...';
        }

        if(count($errors) > 0){
            throw new ValidationException($errors);
        }
    }

    private function validateUpdateClient(){
        $errors = [];

        if(!$this->name){
            $errors['name'] = 'Insira um nome...';
        }elseif(!validateName($this->name)){
            $errors['name'] = 'Use somente letras, números e espaço...';
        }else{
            $this->name = validateName($this->name);
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

        if(!$this->password) {
            $errors['password'] = 'Insira uma senha...';
        }elseif(!validatePassword($this->password)){
            $errors['password'] = 'A senha deve ter pelo menos 6 caracteres...';
        }else{
            $this->password = validatePassword($this->password);
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