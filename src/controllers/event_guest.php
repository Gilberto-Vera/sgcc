<?php
session_start();
requireValidSession();

$exception = null;
$event_id = ($_GET['event']);

if(isset($_GET['delete'])) {
    try {
        $event = Model::getIdEvent($_GET['delete']);
        $event_id = $event->getValues();
        Guest::deleteGuestById($_GET['delete']);
        addSuccessMsg('Convidado excluido com sucesso...');
        header("Location: event_guest.php?event={$event_id['id']}");
        exit();
    } catch (Exception $e) {
        $exception = $e;
    }
}

$guests = Guest::getGuests($_GET['event']);
$guestsTotal = Guest::guestsTotal($_GET['event']);

loadTemplateView('event_guests', [
    'event_id' => $event_id,
    'guests' => $guests,
    'guestsTotal' => $guestsTotal,
    'exception' => $exception
]);