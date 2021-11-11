<?php

require_once(realpath(MODEL_PATH . '/Model.php'));

Class People extends Model{

    protected static $tablename = 'pessoa';
    protected static $columns = [
        'nome',
        'email',
        'senha',
    ];


}