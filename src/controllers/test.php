<?php

// $string = file_get_contents("extras/data.json");
// $json_a = json_decode($string, true);


// $id = 1;
// $confirm = 'TRUE';
// $email = '';
// foreach ($json_a as $keys => $val) {
//     $pessoa = "(default, '{$val['nome']}', ";
//     $pessoa .= rand( 1, 5);
//     $email = explode("..", $val['email']);
//     if (count($email) == 1) {
//         $email = explode("__", $val['email']);
//         if (count($email) == 1) {
//             $pessoa .= ", '{$email[0]}'),";
//         }else {
//             $pessoa .= ", '{$email[1]}'),";
//         }
//     }else {
//         $pessoa .= ", '{$email[1]}'),";
//     }
    
    // $cel = explode(" ", $val['celular']);
    // $cel = explode("-", $cel[1]);

    // $telefone = "(default, {$id}, {$cel[0]}{$cel[1]}, TRUE),";


    // (default, 1, 2, TRUE),
    // $telGuest = "(default, ";
    // $telGuest .= rand( 1, 3);
    // $randConfirm = rand( 1, 3 );
    // $confirm = $randConfirm % 2 == 0 ? "FALSE" : "TRUE";
    // $telGuest .= ", {$id}, {$confirm}),";
    
    // $id ++;

    // var_dump($email);
    // echo ('<br>');
    // echo $email[1];
    // echo ('<br>');
    // echo $pessoa;
    // echo $telefone;
    // echo $telGuest;
    // echo ('<br>');
// }
// print_r ($json_a);


// $guestsTotal = Guest::guestsTotal(1);

// print_r ($guestsTotal);
// echo ('<br>');
// print_r ($guestsTotal[0]->initial);
// echo ('<br>');
// print_r ($guestsTotal[0]->guests);
// echo ('<br>');
// print_r ($guestsTotal[0]->confirmed);


// $guest = Model::getIdEvent('1');
// $guestData = $guest->getValues();
// print_r ($guestData['id']);

// echo "Hoje é " . date("d/m/Y") . "<br>";
// echo "Hoje é " . date("d/m/Y") . "<br>";
// echo "Hoje é " . date("d.m.Y") . "<br>";
// echo "Hoje é " . date("d-m-Y") . "<br>";
// echo "Hoje é " . date("l");
// echo "Horário:" . date("H:i:s") . "<br>";
// echo "Horário" . date("h:i:sa") . "<br>";

$test = false;

echo $test ? 'true' : 'false';

echo ('<br>');
echo ('Fim!');