<?php
session_start();
requireValidSession();

$exception = null;
$userData = [];

if(count($_POST) === 0 && isset($_GET['update'])){
    $user = Client::getClient($_GET['update']);
    $userData = $user->getValues();
}elseif(count($_POST) > 0){
    try {
        $dbClient = new Client($_POST);
        if($dbClient->id){
            $dbClient->update();
            addSuccessMsg('Cliente alterado com sucesso');
            header('Location: client.php');
            exit();
        } else {
            $dbClient->insert();
            addSuccessMsg('Cliente cadastrado com sucesso');
        }
        $_POST = [];
    } catch (Exception $e) {
        $exception = $e;
    } finally {
        $userData = $_POST;
    }
}

loadTemplateView('save_client', $userData + ['exception' => $exception]);