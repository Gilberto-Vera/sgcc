<?php

loadModel('People');

Class Login extends Model{

    public function validation(){
        $errors = [];
        if(!$this->nome){
            $errors['nome'] = 'Informe o nome do usuário...';
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
        $user = People::getOne(['nome' => $this->nome]);
        if($user){
            if(!$user->ativo){
                throw new AppException('Usuário inativo...');
            }
            if($this->senha == $user->senha){
                return $user;
            }
        }
        throw new AppException('Usuário e senha inválidos...');
    }

}