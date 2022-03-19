<?php
session_start();
requireValidSession();

$exception = null;
if(isset($_GET['delete'])) {
    try {
        Event::deleteEventById($_GET['delete']);
        addSuccessMsg('Usuário excluido com sucesso...');
    } catch (Exception $e) {
        $exception = $e;
    }
}

$events = Event::getEvents([]);

loadTemplateView('events', [
    'events' => $events,
    'exception' => $exception
]);