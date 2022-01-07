<?php
session_start();
requireValidSession();

$exception = null;
if(isset($_GET['delete'])) {
    try {
        User::deleteUserById($_GET['delete']);
        addSuccessMsg('Usuário excluido com sucesso...');
    } catch (Exception $e) {
        $exception = $e;
    }
}

$users = User::getUsers([]);

loadTemplateView('users', ['users' => $users, 'exception' => $exception]);