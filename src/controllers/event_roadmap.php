<?php
session_start();
requireValidSession();

$exception = null;
$event_id = ($_GET['event']);

if(isset($_GET['delete'])) {
    try {
        $event = Model::getEventIdFromRoadmap($_GET['delete']);
        $event_id = $event->getValues();
        Guest::deleteRoadmapById($_GET['delete']);
        addSuccessMsg('Convidado excluido com sucesso...');
        header("Location: event_roadmap.php?event={$event_id['id']}");
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