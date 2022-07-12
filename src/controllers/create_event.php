<?php
session_start();
requireValidSession();

$exception = null;
$situations = [];
$name = null;
$date = null;
$numGuests = null;
$situation = null;
$clientId = null;
$clientName = null;
$providerId = null;
$providerName = null;
$serviceId = null;
$userId = null;
$userName = null;
$selectedSituationId = null;
$eventData = [];

if(count($_POST) === 0) {
    $clientId = $_GET['clientId'];
    $clientName = $_GET['clientName'];
    $providerId = $_GET['providerId'];
    $providerName = $_GET['providerName'];
    $serviceId = $_GET['serviceId'];
    $userId = $_GET['userId'];
    $userName = $_GET['userName'];
    $name = $_GET['name'];
    $date = $_GET['date'];
    $numGuests = $_GET['numGuests'];
    $selectedSituationId = $_GET['situation'];
}elseif(count($_POST) > 0){
    try {
        $dbEvent = new Event($_POST);
        $dbEvent->insert();
        addSuccessMsg('Evento cadastrado com sucesso');
        $_POST = [];
    } catch (Exception $e) {
        if($_POST['id'] == ''){
            $clientId = $_GET['clientId'];
            $clientName = $_GET['clientName'];
            $providerId = $_GET['providerId'];
            $providerName = $_GET['providerName'];
            $serviceId = $_GET['serviceId'];
            $userId = $_GET['userId'];
            $userName = $_GET['userName'];
            $name = $_POST['name'];
            $date = $_POST['date'];
            $numGuests = $_POST['numGuests'];
            $selectedSituationId = $_POST['situation'];
        }
        $exception = $e;
    } finally {
        $eventData = $_POST;
    }
}

$situations = Event::getSituations();

loadTemplateView('create_event', $eventData + [
    'name' => $name,
    'date' => $date,
    'numGuests' => $numGuests,
    'clientId' => $clientId,
    'clientName' => $clientName,
    'providerId' => $providerId,
    'providerName' => $providerName,
    'serviceId' => $serviceId,
    'userId' => $userId,
    'userName' => $userName,
    'situations' => $situations,
    'selectedSituationId' => $selectedSituationId,
    'exception' => $exception
]);