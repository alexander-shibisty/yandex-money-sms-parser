<?php

require_once __DIR__ . '/helpers.php';

$text = '';

try {
    $text = getInput();

    if(isMessageWithPassword($text) == true) {
        var_dump(parse($text));
    } else {
        var_dump('Ошибка: Message without password.');
    }
} catch(Exception $error) {
    var_dump('Ошибка' . $error->getMessage());
}
