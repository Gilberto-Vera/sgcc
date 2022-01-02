<?php

// $services = Provider::getServices();

$test = validateCNPJ('91.550.358/0001-11');

if(!$test){
    echo('dentro do if...');
    echo ('<br>');
}else{
    echo ('fora do if...');
    echo ('<br>');
}
print_r ($test);

echo ('<br>');
echo ('Fim!');