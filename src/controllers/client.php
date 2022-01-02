<?php
session_start();
requireValidSession();

$exception = null;
if(isset($_GET['delete'])) {
    try {
        Client::deleteClientById($_GET['delete']);
        addSuccessMsg('Usuário excluido com sucesso...');
    } catch (Exception $e) {
        $exception = $e;
    }
}

$clients = Client::getClients([]);

loadTemplateView('clients', ['clients' => $clients, 'exception' => $exception]);