<?php
session_start();
requireValidSession();

$exception = null;
$eventId = null;

if(isset($_GET['roadmap']) AND isset($_GET['event'])) {
    try {
        $eventId = $_GET['event'];
        $roadmapId = $_GET['roadmap'];
        $roadmapObject = Roadmap::getRoadmapModel($roadmapId);
        $id = Roadmap::importRoadmapByModel($roadmapObject, $eventId);
        $sequences = Sequence::getSequencesModel($roadmapId);
        foreach ($sequences as $sequence) {
            Sequence::insertSequences($sequence, $id);
        }
        addSuccessMsg('Modelo incluso no Roteiro com sucesso...');
        header("Location: event_roadmap.php?event={$eventId}");
        exit();
    } catch (Exception $e) {
        $exception = $e;
    }
}elseif(isset($_GET['roadmap'])) {
    try {
        $event = Roadmap::getEventIdFromRoadmap($_GET['roadmap']);
        $eventId = $event->getValues();
        $roadmapModelId = Roadmap::insertRoadmapModelById($_GET['roadmap']);
        $sequences = Sequence::getSequences($_GET['roadmap']);
        foreach ($sequences as $sequence) {
            Sequence::insertSequencesModel($sequence, $roadmapModelId);
        }
        addSuccessMsg('Roteiro salvo como modelo com sucesso...');
        header("Location: event_roadmap.php?event={$eventId['id']}");
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