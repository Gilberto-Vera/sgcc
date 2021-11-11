<?php

require_once(dirname(__FILE__, 2) . '/src/config/config.php');
require_once(dirname(__FILE__, 2) . '/src/models/People.php');

require_once(VIEW_PATH . '/login.php');

// print_r(People::get(['id' => 1], 'nome, email'));

// echo '<br>';


// foreach (People::get([], 'email') as $user) {
//     echo $user->email;
//     echo '<br>';
// }