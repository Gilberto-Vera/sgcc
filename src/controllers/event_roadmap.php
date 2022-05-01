<?php
session_start();
requireValidSession();

$exception = null;
$event_id = ($_GET['event']);

if(isset($_GET['delete'])) {
    try {
        $event = Roadmap::getEventIdFromRoadmap($_GET['delete']);
        $eventId = $event->getValues();
        Roadmap::deleteRoadmapById($_GET['delete']);
        addSuccessMsg('Convidado excluido com sucesso...');
        header("Location: event_roadmap.php?event={$eventId['id']}");
        exit();
    } catch (Exception $e) {
        $exception = $e;
    }
}

$roadmaps = Roadmap::getRoadmaps($event_id);

loadTemplateView('event_roadmaps', [
    'event_id' => $event_id,
    'roadmaps' => $roadmaps,
    'exception' => $exception
]);