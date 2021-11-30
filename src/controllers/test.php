<?php

$user = new Client(['id' => 1, 'nome' => 'gilberto', 'cpf' => 29108908800, 'telefone' => 999743570,
    'endereco' => 'Rua Onix Qd01 N37', 'email' => 'rasvejr@gmail.com', 'senha' => 123]);

echo $user->insert();

echo ('<br>');
echo ('Fim!');