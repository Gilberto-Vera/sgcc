<?php
session_start();
requireValidSession();

$exception = null;
$userData = [];
$disabledInput = false;

if(count($_POST) === 0 && isset($_GET['update'])){
    $disabledInput = true;
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
        if(isset($_GET['update'])){
            $user = Client::getClient($_GET['update']);
            $userData = $user->getValues();
            $_POST['cpf'] = $userData['cpf'];
            $_POST['email'] = $userData['email'];
            $disabledInput = true;
        }
        $exception = $e;
    } finally {
        $userData = $_POST;
    }
}

loadTemplateView('manage_client', $userData + [
    'exception' => $exception,
    'disabledInput' => $disabledInput,
]);