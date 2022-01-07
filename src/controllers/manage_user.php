<?php
session_start();
requireValidSession();

$exception = null;
$userData = [];
$selectedRoleId = $_POST['role'] ? $_POST['role'] : '';
$roles = User::getRoles();
$disabledInput = false;

if(count($_POST) === 0 && isset($_GET['update'])){
    $disabledInput = true;
    $user = User::getUser($_GET['update']);
    $selectedRoleId = $user->role;
    $userData = $user->getValues();
}elseif(count($_POST) > 0){
    try {
        $dbUser = new User($_POST);
        if($dbUser->id){
            $dbUser->update();
            addSuccessMsg('Usuário alterado com sucesso');
            header('Location: user.php');
            exit();
        } else {
            $dbUser->insert();
            addSuccessMsg('Usuário cadastrado com sucesso');
        }
        $_POST = [];
    } catch (Exception $e) {
        if(isset($_GET['update'])){
            $user = User::getUser($_GET['update']);
            $userData = $user->getValues();
            $selectedRoleId = $user->role;
            $_POST['email'] = $userData['email'];
            $disabledInput = true;
        }
        $exception = $e;
    } finally {
        $userData = $_POST;
    }
}

loadTemplateView('manage_user', $userData + [
    'roles' => $roles,
    'selectedRoleId' => $selectedRoleId,
    'exception' => $exception,
    'disabledInput' => $disabledInput,
]);