<?php
session_start();
requireValidSession();

$exception = null;
$eventId = ($_GET['event']);

if(isset($_GET['delete'])) {
    try {
        Roadmap::deleteRoadmapModelById($_GET['delete']);
        addSuccessMsg('Modelo de roteiro excluido com sucesso...');
        header("Location: roadmap_model.php?event={$eventId}");
        exit();
    } catch (Exception $e) {
        $exception = $e;
    }
}

$roadmaps = Roadmap::getRoadmapsModel($eventId);

loadTemplateView('roadmaps_model', [
    'eventId' => $eventId,
    'roadmaps' => $roadmaps,
    'exception' => $exception
]);