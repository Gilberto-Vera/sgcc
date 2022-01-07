<?php

// $services = Provider::getServices();

// $test = validateCNPJ('91.550.358/0001-11');

$roles = User::getRoles();

// if(!$test){
//     echo('dentro do if...');
//     echo ('<br>');
// }else{
//     echo ('fora do if...');
//     echo ('<br>');
// }
print_r ($roles);

echo ('<br>');
echo ('Fim!');