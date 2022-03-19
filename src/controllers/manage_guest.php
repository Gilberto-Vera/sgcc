<?php
session_start();
requireValidSession();

$exception = null;
$event_id = ($_GET['event']);
$guestData = [];
$disabledInput = false;

if(count($_POST) === 0 && isset($_GET['update'])){
    $disabledInput = true;
    $guest = Guest::getGuest($_GET['update']);
    $guestData = $guest->getValues();
}elseif(count($_POST) > 0){
    try {
        $dbGuest = new Guest($_POST);
        if($dbGuest->id){
            $dbGuest->update();
            addSuccessMsg('Convidado alterado com sucesso');
            header("Location: event_guest.php?event={$event_id}");
            exit();
        } else {
            $dbGuest->insert();
            addSuccessMsg('Convidado cadastrado com sucesso');
        }
        $_POST = [];
    } catch (Exception $e) {
        if(isset($_GET['update'])){
            $guest = Guest::getGuest($_GET['update']);
            $guestData = $guest->getValues();
            $_POST['email'] = $guestData['email'];
            $disabledInput = true;
        }
        $exception = $e;
    } finally {
        $guestData = $_POST;
    }
}

loadTemplateView('manage_guest', $guestData + [
    'event_id'=> $event_id,
    'exception' => $exception,
    'disabledInput' => $disabledInput
]);