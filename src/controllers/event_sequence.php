<?php
session_start();
requireValidSession();

$exception = null;
$roadmapId = null;
$eventId = null;

if(isset($_GET['delete'])) {
    try {
        $roadmapId = Sequence::getRoadmapIdFromSequence($_GET['delete']);
        $roadmapId = $roadmapId->getValues();
        $eventId = Sequence::getEventIdFromSequence($_GET['delete']);
        $eventId = $eventId->getValues();
        Sequence::deleteSequenceById($_GET['delete'], $roadmapId['roadmapid']);
        addSuccessMsg('Sequência excluida com sucesso...');
        header("Location: event_sequence.php?roadmap={$roadmapId['roadmapid']}&event={$eventId['eventid']}");
        exit();
    } catch (Exception $e) {
        $exception = $e;
    }
}

$roadmapId = ($_GET['roadmap']);
$eventId = ($_GET['event']);
$sequences = Sequence::getSequences($roadmapId);

loadTemplateView('event_sequences', [
    'roadmapId' => $roadmapId,
    'eventId' => $eventId,
    'sequences' => $sequences,
    'exception' => $exception
]);