<?php

define('PASSWORD_PATTERN', '/([0-9]{4,})[\r\n]/');
define('AMOUNT_PATTERN', '/([0-9]+,?[0-9]+?)р\./');
define('ACCOUNT_PATTERN', '/([0-9]{11,20})/');

function getInput(): ?string {
    $text = null;

    $phpInput = @fopen("php://input", "r");

    if($phpInput !== false) {
        $text = '';

        while (!feof($phpInput)) {
            $text .= fgets($phpInput);
        }
    } else {
        throw new Exception('Can\'t opened.');
    }

    fclose($phpInput);

    return $text;
}

function parse(string $message): string {
    preg_match(PASSWORD_PATTERN, $message, $resultPassword);
    preg_match(AMOUNT_PATTERN, $message, $resultAmount);
    preg_match(ACCOUNT_PATTERN, $message, $resultAccount);

    return 'Код подтверждения ' . getArray($resultPassword, 1) . "\r\n" .
        'Сумма ' . getArray($resultAmount, 1) . "\r\n" .
        'Кошелек ' . getArray($resultAccount, 1)
    ;
}

function isMessageWithPassword(string $text): bool {
    return preg_match(PASSWORD_PATTERN, $text);
}

function getArray(array $array, $key) {
    return isset($array[$key])? $array[$key] : null;
}