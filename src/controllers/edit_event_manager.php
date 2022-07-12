<?php
session_start();
requireValidSession();
$exception = null;
$users = [];
$userId = null;
$eventId = $_GET["event"] ? $_GET["event"] : null;

if(isset($_GET['userid'])) {
    try {
        $userId = $_GET["userid"];
        User::includeEventManager($userId, $eventId);
        addSuccessMsg('Responsável incluido com sucesso');
        header("Location: event_manager.php?event={$eventId}");
        exit();

    } catch (Exception $e) {
        $exception = $e;
    }
}

$users = User::includeEventUser($eventId);

loadTemplateView('edit_event_managers', [
    'users' => $users,
    'eventId' => $eventId,
    'exception' => $exception
]);