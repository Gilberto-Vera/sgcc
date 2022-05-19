<?php
session_start();
requireValidSession();

$roadmapId = null;
$eventId = null;

$roadmapId = ($_GET['roadmap']);
$eventId = ($_GET['event']);
$sequences = Sequence::getSequencesModel($roadmapId);

loadTemplateView('sequences_model', [
    'roadmapId' => $roadmapId,
    'eventId' => $eventId,
    'sequences' => $sequences
]);