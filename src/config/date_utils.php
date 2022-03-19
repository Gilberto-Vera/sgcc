<?php

function getDateAsDateTime($date) {
    return is_string($date) ? new DateTime($date) : $date;
}

function formatDate($date) {
    $time = getDateAsDateTime($date);
    return date_format($time, 'd/m/Y');
}