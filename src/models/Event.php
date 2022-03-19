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
        return parent::insertEvent();
    }
    
    public function update() {
        $this->validateUpdate();
        return parent::updateEvent();
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

        if(count($errors) > 0){
            throw new ValidationException($errors);
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

        if(count($errors) > 0){
            throw new ValidationException($errors);
        }
    }
}