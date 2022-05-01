<?php
session_start();
requireValidSession();

$exception = null;
$roadmapId = ($_GET['roadmap']);
$eventId = ($_GET['event']);
$sequenceData = [];
$order = null;

if(count($_POST) === 0 && isset($_GET['update'])){
    $sequence = Sequence::getSequence($_GET['update']);
    $sequenceData = $sequence->getValues();
}
if(count($_POST) === 0 && isset($_GET['roadmap'])){
    $next = Sequence::getNextOrder($_GET['roadmap']);
    $order = $next->next;
}elseif(count($_POST) > 0){
    try {
        $dbSequence = new Sequence($_POST);
        if($dbSequence->id){
            $dbSequence->update();
            addSuccessMsg('Sequência alterada com sucesso');
            header("Location: event_sequence.php?roadmap={$roadmapId}&event={$eventId}");
            exit();
        } else {
            $dbSequence->insert();
            addSuccessMsg('Sequência cadastrada com sucesso');
        }
        $_POST = [];
    } catch (Exception $e) {
        $exception = $e;
    } finally {
        $sequenceData = $_POST;
    }
}

loadTemplateView('manage_event_sequence', $sequenceData + [
    'eventId' => $eventId,
    'roadmapId' => $roadmapId,
    'order' => $order,
    'exception' => $exception
]);