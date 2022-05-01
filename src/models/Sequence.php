<?php

Class Sequence extends Model{

    protected static $tablename = 'sequencia';
    protected static $columns = [
        'id',
        'roteiro_id',
        'descricao',
        'ordem',
        'observacao',
    ];
    
    public function insert() {
        $this->validate();
        return parent::insertSequence();
    }
    
    public function update() {
        $this->validate();
        return parent::updateSequence($this->id);
    }

    public static function getNextOrder($id){
        $sql = "SELECT ordem + 1 AS next FROM sequencia
                    WHERE roteiro_id = {$id}
                    ORDER BY ordem DESC
                    LIMIT 1";
        $class = get_called_class();
        $result = Database::getResultFromQuery($sql);
        return $result ? new $class(pg_fetch_assoc($result)) : null;
    }

    private function validate(){
        $errors = [];

        if(!$this->description){
            $errors['description'] = 'Insira uma descrição...';
        }elseif(!validateName($this->description)){
            $errors['description'] = 'descrição inválido...';
        }

        if(!$this->note){
            $errors['note'] = 'Insira uma observação...';
        }elseif(!validateName($this->note)){
            $errors['note'] = 'observação inválido...';
        }

        if(count($errors) > 0){
            throw new ValidationException($errors);
        }
    }
}