<?php
session_start();
requireValidSession();

$exception = null;
if(isset($_GET['delete'])) {
    try {
        Provider::deleteProviderById($_GET['delete']);
        addSuccessMsg('Fornecedor excluido com sucesso...');
    } catch (Exception $e) {
        $exception = $e;
    }
}
$providers = Provider::getProviders([]);

loadTemplateView('provider', ['providers' => $providers, 'exception' => $exception]);