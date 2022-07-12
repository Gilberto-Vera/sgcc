<?php
session_start();
requireValidSession();

$exception = null;
$event_id = ($_GET['event']);

if(isset($_GET['delete'])) {
    try {
        $event = Model::getEventIdFromGuest($_GET['delete']);
        $event_id = $event->getValues();
        Guest::deleteGuestById($_GET['delete']);
        addSuccessMsg('Convidado excluido com sucesso...');
        header("Location: event_guest.php?event={$event_id['id']}");
        exit();
    } catch (Exception $e) {
        $exception = $e;
    }
}

$guests = Guest::getGuests($event_id);
$guestsTotal = Guest::guestsTotal($event_id);

loadTemplateView('event_guests', [
    'event_id' => $event_id,
    'guests' => $guests,
    'guestsTotal' => $guestsTotal,
    'exception' => $exception
]);