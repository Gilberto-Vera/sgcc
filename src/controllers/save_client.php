<?php
session_start();
requireValidSession();

$exception = null;

if(count($_POST) > 0){
    try {
        $newClient = new Client($_POST);
        $newClient->insert();
        addSuccessMsg('Cliente cadastrado com sucesso');
        $_POST = [];
    } catch (Exception $e) {
        $exception = $e;
    }
}

loadTemplateView('save_client', $_POST + ['exception' => $exception]);