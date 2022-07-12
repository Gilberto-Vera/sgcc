<?php
session_start();
requireValidSession();
$exception = null;
$buttonDisabled = false;
$numUsers = null;
$eventId = $_GET['event'] ? $_GET['event'] : null;

if(isset($_GET['delete'])) {
    try {
        User::deleteEventManagerById($_GET['delete']);
        addSuccessMsg('Usuário excluido com sucesso...');
        header("Location: event_manager.php?event={$eventId}");
        exit();
    } catch (Exception $e) {
        $exception = $e;
    }
}

$numUsers = User::getNumUsersFromEvent($eventId);

if($numUsers->count == 1){
    $buttonDisabled = true;
}

$eventUsers = User::getEventUsers($eventId);

loadTemplateView('event_managers', [
    'buttonDisabled' => $buttonDisabled,
    'eventUsers' => $eventUsers,
    'eventId' => $eventId,
    'exception' => $exception
]);