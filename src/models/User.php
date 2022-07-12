<?php

Class User extends People{

    protected static $tablename = 'usuario';
    protected static $columns = [
        'id',
        'name',
        'phone',
        'email',
        'role',
        'password',
        'admin',
    ];
    
    public function insert() {
        $this->validate();
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        return parent::insertUser();
    }
    
    public function update() {
        $this->validateUpdate();
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        return parent::updateUser();
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

        $phone = validatePhone($this->phone);
        if(!$this->phone){
            $errors['phone'] = 'Insira um telefone...';
        }elseif(!$phone){
            $errors['phone'] = 'Telefone inválido...';
        }else{
            $this->phone = $phone['number'];
        }

        if(!$this->role){
            $errors['role'] = 'Escolha uma função...';
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

    private function validateUpdate(){
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

        if(!$this->role){
            $errors['role'] = 'Escolha uma função...';
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

    public static function searchToIncludeEventUser($name){
        $objects = [];
        $sql = "SELECT usuario.id, nome AS name, email FROM pessoa
            INNER JOIN usuario ON usuario.pessoa_id = pessoa.id
            LEFT JOIN usuario_evento ON usuario_evento.usuario_id = usuario.id
            WHERE nome ILIKE '%{$name}%'";
        $result = Database::getResultFromQuery($sql);
        if($result){
            $class = get_called_class();
            while ($row = pg_fetch_assoc($result)) {
                array_push($objects, new $class($row));
            }
        }
        return $objects;
    }

    public static function includeEventUser($id){
        $objects = [];
        $sql = "SELECT usuario.id, pessoa.nome AS name, pessoa.email FROM usuario
        INNER JOIN pessoa ON usuario.pessoa_id = pessoa.id
        WHERE usuario.id IN (SELECT usuario.id FROM usuario
                                EXCEPT
                                SELECT usuario_id FROM usuario_evento
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

    public static function getEventUsers($id){
        $objects = [];
        $sql = "SELECT usuario.id, usuario_evento.id AS manager_id, nome AS name, descricao AS function FROM pessoa
            INNER JOIN usuario ON usuario.pessoa_id = pessoa.id
            INNER JOIN funcao ON funcao.id = usuario.funcao_id
            INNER JOIN usuario_evento ON usuario_evento.usuario_id = usuario.id
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

    public static function includeEventManager($userId, $eventId){
        $sql = " INSERT INTO usuario_evento (id, usuario_id, evento_id)
            VALUES (default, {$userId}, {$eventId})";
        Database::executeSQL($sql);
    }

    public static function getNumUsersFromEvent($id){
        $sql = "SELECT COUNT(*) FROM usuario_evento
                    WHERE evento_id = {$id}";
        $class = get_called_class();
        $result = Database::getResultFromQuery($sql);
        return $result ? new $class(pg_fetch_assoc($result)) : null;
    }

    public static function deleteEventManagerById($id) {
        $sql = "DELETE FROM usuario_evento
            WHERE id = {$id}";
        Database::executeSQL($sql);
    }
}