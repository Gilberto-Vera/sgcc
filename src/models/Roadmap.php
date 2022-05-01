<?php

Class Roadmap extends Model{

    protected static $tablename = 'roteiro';
    protected static $columns = [
        'id',
        'evento_id',
        'nome',
        'horario',
        'situacao',
    ];
    
    public function insert() {
        $this->validate();
        return parent::insertRoadmap();
    }
    
    public function update() {
        $this->validateUpdate();
        return parent::updateRoadmap($this->id);
    }

    private function validate(){
        $errors = [];

        if(!$this->name){
            $errors['name'] = 'Insira uma descrição...';
        }elseif(!validateName($this->name)){
            $errors['name'] = 'Nome inválido...';
        }else{
            $this->name = validateName($this->name);
        }

        if($this->hour == ''){
            $errors['hour'] = 'Selecione a hora...';
        }

        if($this->minute == ''){
            $errors['minute'] = 'Selecione o minuto...';
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
            $errors['name'] = 'Nome inválido...';
        }else{
            $this->name = validateName($this->name);
        }

        if($this->hour == ''){
            $errors['hour'] = 'Selecione a hora...';
        }

        if($this->minute == ''){
            $errors['minute'] = 'Selecione o minuto...';
        }

        if(count($errors) > 0){
            throw new ValidationException($errors);
        }
    }
}