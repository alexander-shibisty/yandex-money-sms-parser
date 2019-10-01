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

function isMessageWithPassword(string $text): bool {
    return preg_match(PASSWORD_PATTERN, $text);
}

function getArray(array $array, $key) {
    return isset($array[$key])? $array[$key] : null;
}