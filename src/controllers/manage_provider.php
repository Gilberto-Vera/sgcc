<?php
session_start();
requireValidSession();

$exception = null;
$providerData = [];
$selectedServiceId = $_POST['service_id'] ? $_POST['service_id'] : '';
$services = Provider::getServices();
$disabledInput = false;

if(count($_POST) === 0 && isset($_GET['update'])){
    $disabledInput = true;
    $provider = Provider::getProvider($_GET['update']);
    $selectedServiceId = $provider->serviceid;
    $providerData = $provider->getValues();
}elseif(count($_POST) > 0){
    try {
        $dbProvider = new Provider($_POST);
        if($dbProvider->id){
            $dbProvider->update();
            addSuccessMsg('Fornecedor alterado com sucesso');
            header('Location: provider.php');
            exit();
        } else {
            $dbProvider->insert();
            addSuccessMsg('Fornecedor cadastrado com sucesso');
        }
        $_POST = [];
    } catch (Exception $e) {
        if(isset($_GET['update'])){
            $disabledInput = true;
            $provider = Provider::getProvider($_GET['update']);
            $selectedServiceId = $provider->serviceid;
            $providerData = $provider->getValues();
            $_POST['cnpj'] = $providerData['cnpj'];
            $_POST['email'] = $providerData['email'];
        }
        $exception = $e;
    } finally {
        $providerData = $_POST;
    }
}

loadTemplateView('manage_provider', $providerData + [
    'exception' => $exception,
    'services' => $services,
    'selectedServiceId' => $selectedServiceId,
    'disabledInput' => $disabledInput,
]);