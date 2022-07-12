<?php
session_start();
requireValidSession();

$exception = null;
$eventId = null;
$situations = [];
$selectedSituationId = null;
$eventData = [];
$eventId = $_GET['event'] ? $_GET['event'] : null;

if(count($_POST) === 0 && isset($_GET['event'])) {
    $event = Event::getEventToEdit($eventId);
    $eventData = $event->getValues();
    $selectedSituationId = $eventData['situation'];
}elseif(count($_POST) > 0){
    try {
        $dbEvent = new Event($_POST);
        $dbEvent->update($eventId);
        addSuccessMsg('Evento alterado com sucesso');
        header("Location: event.php");
        exit();
    } catch (Exception $e) {
        $selectedSituationId = $_POST['situation'];
        $exception = $e;
    } finally {
        $eventData = $_POST;
    }
}

$situations = Event::getSituations();

loadTemplateView('edit_event', $eventData + [
    'situations' => $situations,
    'selectedSituationId' => $selectedSituationId,
    'exception' => $exception
]);