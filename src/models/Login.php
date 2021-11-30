<?php

Class Login extends Model{

    public function validation(){
        $errors = [];
        if(!$this->email){
            $errors['email'] = 'Informe seu email...';
        }
        if(!$this->senha){
            $errors['senha'] = 'Informe a senha...';
        }
        if(count($errors) > 0){
            throw new ValidationException($errors);            
        }
    }

    public function checkLogin(){
        $this->validation();
        $user = People::getOne(['email' => $this->email]);
        if($user){
            if($this->senha == $user->senha){
                if($user->ativo == 'f'){
                    throw new AppException('Usuário inativo...');
                }
                return $user;
            }
        }
        throw new AppException('Email e senha inválidos...');
    }

}