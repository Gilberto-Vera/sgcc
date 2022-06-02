<?php
session_start();
requireValidSession();
$exception = null;
$eventId = null;

if(isset($_GET['event'])) {
    try {
        $eventId = ($_GET['event']);
        $includeEventPartners = Partner::getIncludeEventPartners($eventId);
    } catch (Exception $e) {
        $exception = $e;
    }
}

loadTemplateView('include_event_partner', [
    'includeEventPartners' => $includeEventPartners,
    'eventId' => $eventId,
    'exception' => $exception
]);