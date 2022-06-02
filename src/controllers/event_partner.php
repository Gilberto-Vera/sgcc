<?php
session_start();
requireValidSession();
$exception = null;
$eventId = null;

if(isset($_GET['delete'])) {

    try {
        $eventId = Partner::deletePartnerById($_GET['delete']);
        addSuccessMsg('Evento excluido com sucesso...');
        header("Location: event_partner.php?event={$eventId}");
        exit();
    } catch (Exception $e) {
        $exception = $e;
    }
}

$eventId = ($_GET['event']);
$eventPartners = Partner::getEventPartners($eventId);

loadTemplateView('event_partner', [
    'eventPartners' => $eventPartners,
    'eventId' => $eventId,
    'exception' => $exception
]);