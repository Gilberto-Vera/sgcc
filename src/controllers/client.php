<?php
session_start();
requireValidSession();

$clients = Client::getClients([]);

loadTemplateView('clients', ['clients' => $clients]);