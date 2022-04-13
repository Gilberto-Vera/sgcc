<?php

function addSuccessMsg($msg) {
    $_SESSION['message'] = [
        'type' => 'success',
        'message' => $msg
    ];
}

function addErrorMsg($msg) {
    $_SESSION['message'] = [
        'type' => 'error',
        'message' => $msg
    ];
}

function validate($str) {
    return trim(htmlspecialchars($str));
}

function validateCNPJ($cnpj){
    $cnpj = preg_replace('/[^0-9]/', '', (string) $cnpj);

    if (strlen($cnpj) != 14)
        return false;
    if (preg_match('/(\d)\1{13}/', $cnpj))
        return false;	

    // Valida primeiro dígito verificador
    for ($i = 0, $j = 5, $soma = 0; $i < 12; $i++){
        $soma += $cnpj[$i] * $j;
        $j = ($j == 2) ? 9 : $j - 1;
    }
    $resto = $soma % 11;
    if ($cnpj[12] != ($resto < 2 ? 0 : 11 - $resto))
        return false;

    // Valida segundo dígito verificador
    for ($i = 0, $j = 6, $soma = 0; $i < 13; $i++){
        $soma += $cnpj[$i] * $j;
        $j = ($j == 2) ? 9 : $j - 1;
    }
    $resto = $soma % 11;
    return $cnpj;
    // return $cnpj[13] == ($resto < 2 ? 0 : 11 - $resto);
}

function validateCPF($cpf) {
    $cpf = preg_replace( '/[^0-9]/is', '', $cpf );

    if (strlen($cpf) != 11) {
        return false;
    }

    if (preg_match('/(\d)\1{10}/', $cpf)) {
        return false;
    }
    
    for ($t = 9; $t < 11; $t++) {
        for ($d = 0, $c = 0; $c < $t; $c++) {
            $d += $cpf[$c] * (($t + 1) - $c);
        }
        $d = ((10 * $d) % 11) % 10;
        if ($cpf[$c] != $d) {
            return false;
        }
    }
    return $cpf;
}

function validateEmail($email){
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return false;
    }
    return true;
}

function validateName($name){
    if (!preg_match('/^[a-zA-Z0-9\s]\p{L}+/', $name)) { // /^[a-zA-Z0-9\s\x{00C0}-\x{00ff}]+$/
        return false;
    }
    $name = validate($name);
    return $name;
}

function validatePassword($password){
    if (strlen($password) < 6) {
        return false;
    }
    $password = validate($password);
    return $password;
}

function validateNumeric($numeric){
    if (!is_numeric($numeric)) {
        return false;
    }
    return $numeric;
}

/**
 * A função abaixo demonstra o uso de uma expressão regular que identifica, de forma simples, telefones válidos no Brasil.
 * Exemplos válidos: +55 (21) 98888-8888 / 9999-9999 / 21 98888-8888 / 5511988888888 / +55 (021) 98888-8888 / 021 99995-3333
 *
 * @param string $phoneString 
 * @param bool $forceOnlyNumber Passar false caso não queira remover o traço "-"
 * @return array|null ['ddi' => 'string', 'ddd' => string , 'number' => 'string']
 */
function validatePhone(string $phoneString, bool $forceOnlyNumber = true) : ? array {
    $phoneString = validate($phoneString);

    $phoneString = preg_replace('/[()]/', '', $phoneString);

    if (preg_match('/^(?:(?:\+|00)?(55)\s?)?(?:\(?([0-0]?[0-9]{1}[0-9]{1})\)?\s?)??(?:((?:9\d|[2-9])\d{3}\-?\d{4}))$/', $phoneString, $matches) == false){
        return null;
    }

    $ddi = $matches[1] ?? '';
    $ddd = preg_replace('/^0/', '', $matches[2] ?? '');
    $number = $matches[3] ?? '';
    if ($forceOnlyNumber == true){
        $number = preg_replace('/-/', '', $number);
    }

    return ['ddi' => $ddi, 'ddd' => $ddd , 'number' => $number];
}