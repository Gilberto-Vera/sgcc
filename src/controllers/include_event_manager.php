<?php
session_start();
requireValidSession();

$users = [];
$clientName = null;
$name = null;
$date = null;
$clientId = null;
$numGuests = null;
$providerId = null;
$providerName = null;
$serviceId = null;
$userName = null;
$userId = null;
$situation = null;

$name = $_POST['name'];
$date = $_POST['date'];
$clientId = $_POST['clientId'];
$numGuests = $_POST['numGuests'];
$providerId = $_POST['providerId'];
$providerName = $_POST['providerName'];
$serviceId = $_POST['serviceId'];
$userName = $_POST['userName'];
$userId = $_POST['userId'];
$situation = $_POST['situation'];
$clientName = $_POST['clientName'];

$users = User::searchToIncludeEventUser($userName);

loadTemplateView('include_event_manager', [
    'users' => $users,
    'name' => $name,
    'date' => $date,
    'clientId' => $clientId,
    'clientName' => $clientName,
    'numGuests' => $numGuests,
    'providerId' => $providerId,
    'providerName' => $providerName,
    'serviceId' => $serviceId,
    'userName' => $userName,
    'userId' => $userId,
    'situation' => $situation
]);