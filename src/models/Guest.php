<?php

Class Guest extends Model{

    protected static $tablename = 'convidado';
    protected static $columns = [
        'id',
        'name',
        'num_accompany',
        'email',
    ];
    
    public function insert() {
        $this->validate();
        return parent::insertGuest();
    }
    
    public function update() {
        $this->validateUpdate();
        return parent::updateGuest($this->event_id);
    }

    private function validate(){
        $errors = [];

        if(!$this->name){
            $errors['name'] = 'Insira um nome...';
        }else{
            $this->name = validateName($this->name);
        }

        if(!$this->email){
            $errors['email'] = 'Insira um email...';
        }elseif(!validateEmail($this->email)){
            $errors['email'] = 'Email inválido...';
        }else{
            $this->email = validate($this->email);
        }

        $phone = validatePhone($this->phone);
        if(!$this->phone){
            $errors['phone'] = 'Insira um telefone...';
        }elseif(!$phone){
            $errors['phone'] = 'Telefone inválido...';
        }else{
            $this->phone = $phone['number'];
        }

        if($this->num_accompany == ''){
            $errors['num_accompany'] = 'Insira a quantidade de acompanhantes...';
        }elseif(!is_numeric($this->num_accompany)){
            $errors['num_accompany'] = 'Insira apenas números...';
        }else{
            $this->num_accompany = validateName($this->num_accompany);
        }

        if(!$this->confirm){
            $errors['confirm'] = 'Selecione...';
        }elseif ($this->confirm == 'f'){
            $this->confirm = 'FALSE';
        }elseif ($this->confirm == 't'){
            $this->confirm = 'TRUE';
        }

        if(count($errors) > 0){
            throw new ValidationException($errors);
        }
    }

    private function validateUpdate(){
        $errors = [];

        if(!$this->name){
            $errors['name'] = 'Insira um nome...';
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

        if($this->num_accompany == ''){
            $errors['num_accompany'] = 'Insira a quantidade de acompanhantes...';
        }elseif(!is_numeric($this->num_accompany)){
            $errors['num_accompany'] = 'Insira apenas números...';
        }else{
            $this->num_accompany = validateName($this->num_accompany);
        }

        if ($this->confirm == 'f'){
            $this->confirm = 'FALSE';
        }elseif ($this->confirm == 't'){
            $this->confirm = 'TRUE';
        }

        if(count($errors) > 0){
            throw new ValidationException($errors);
        }
    }
}