<?php


Class People extends Model{

    protected static $tablename = 'pessoa';
    protected static $columns = [
        'id',
        'nome',
        'email',
        'senha',
        'ativo',
    ];


}