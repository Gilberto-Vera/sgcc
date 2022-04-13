<?php
session_start();
requireValidSession();

$exception = null;
$event_id = ($_GET['event']);
$roadmapData = [];
$selectedHourId = null;
$selectedMinuteId = null;

if(count($_POST) === 0 && isset($_GET['update'])){
    $roadmap = Roadmap::getRoadmap($_GET['update']);
    $selectedHourId = $roadmap->hour;
    $selectedMinuteId = $roadmap->minute;
    $roadmapData = $roadmap->getValues();
}elseif(count($_POST) > 0){
    try {
        $dbRoadmap = new Roadmap($_POST);
        if($dbRoadmap->id){
            $selectedHourId = $_POST['hour'];
            $selectedMinuteId = $_POST['minute'];
            $dbRoadmap->update();
            addSuccessMsg('Roteiro alterado com sucesso');
            header("Location: event_roadmap.php?event={$event_id}");
            exit();
        } else {
            $selectedHourId = isset($_POST['hour']) ? $_POST['hour'] : '';
            $selectedMinuteId = isset($_POST['minute']) ? $_POST['minute'] : '';
            $dbRoadmap->insert();
            $selectedHourId = null;
            $selectedMinuteId = null;
            addSuccessMsg('Roteiro cadastrado com sucesso');
        }
        $_POST = [];
    } catch (Exception $e) {
        $exception = $e;
    } finally {
        $roadmapData = $_POST;
    }
}

loadTemplateView('manage_event_roadmap', $roadmapData + [
    'event_id'=> $event_id,
    'selectedHourId' => $selectedHourId,
    'selectedMinuteId' => $selectedMinuteId,
    'exception' => $exception
]);