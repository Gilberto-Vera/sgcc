<?php
session_start();
requireValidSession();

$exception = null;
$partnerData = [];
$providerId = null;
$eventId = $_GET['event'];
$partnerId = $_GET['update'] ? $_GET['update'] : null;
$selectedServiceId = $_POST['service_id'] ? $_POST['service_id'] : '';
$disabledInput = false;

if(count($_POST) === 0 && isset($_GET['update'])){
    $providerId = $_GET['provider'];
    $services = Partner::getPartnerServices($providerId);
    $partner = Partner::getPartner($_GET['update']);
    $selectedServiceId = $partner->service_id;
    $partnerData = $partner->getValues();
    $disabledInput = true;
}elseif(count($_POST) === 0 && isset($_GET['partner'])){
    $partnerId = $_GET['partner'];
    $services = Partner::getPartnerServices($partnerId);
    $provider = Provider::getProviderForPartner($partnerId);
    $partnerData = $provider->getValues();
    $disabledInput = true;
}elseif(count($_POST) > 0){
    try {
        $dbPartner = new Partner($_POST);
        if($dbPartner->id){
            $dbPartner->update();
            addSuccessMsg('Parceiro alterado com sucesso');
            header("Location: event_partner.php?event={$eventId}");
            exit();
        } else {
            $dbPartner->insert();
            addSuccessMsg('Parceiro cadastrado com sucesso');
            header("Location: event_partner.php?event={$eventId}");
            exit();
        }
        $_POST = [];
    } catch (Exception $e) {
        if(isset($_GET['update'])){
            $providerId = $_GET['provider'];
            $services = Partner::getPartnerServices($providerId);
            $partner = Partner::getPartner($_GET['update']);
            $partnerData = $partner->getValues();
            $_POST['business_name'] = $partnerData['business_name'];
            $disabledInput = true;
        }else{
            $partnerId = $_GET['partner'];
            $services = Partner::getPartnerServices($partnerId);
            $provider = Provider::getProviderForPartner($partnerId);
            $partnerData = $provider->getValues();
            $disabledInput = true;
        }
        $exception = $e;
    } finally {
        $partnerData = $_POST;
    }
}

loadTemplateView('manage_event_partner', $partnerData + [
    'eventId'=> $eventId,
    'disabledInput' => $disabledInput,
    'selectedServiceId' => $selectedServiceId,
    'services' => $services,
    'exception' => $exception
]);