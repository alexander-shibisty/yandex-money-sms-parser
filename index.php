<?php

require_once __DIR__ . '/helpers.php';

$text = '';

try {
    $text = getInput();

    if(isMessageWithPassword($text) == true) {
        preg_match(PASSWORD_PATTERN, $text, $resultPassword);
        preg_match(AMOUNT_PATTERN, $text, $resultAmount);
        preg_match(ACCOUNT_PATTERN, $text, $resultAccount);

        var_dump(
            'Код подтверждения ' . getArray($resultPassword, 1),
            'Сумма ' . getArray($resultAmount, 1),
            'Кошелек ' . getArray($resultAccount, 1)
        );
    } else {
        var_dump('Ошибка: Message without password.');
    }
} catch(Exception $error) {
    var_dump('Ошибка' . $error->getMessage());
}
