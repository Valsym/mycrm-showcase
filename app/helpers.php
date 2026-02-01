<?php

// Плюрализация
if (! function_exists('pluralize')) {
    function pluralize($count, $form1, $form2, $form5)
    {
        // В Демо-версии не используется, представлен демо-код.
        // Реальный код функции только в полной версии

        return $form1;
    }
}

// Форматирование валюты
if (! function_exists('asCurrency')) {
    function asCurrency($amount, $currency = 'RUB')
    {
        // В Демо-версии не используется, представлен демо-код.
        // Реальный код функции только в полной версии
        $formatted = $amount;

        return $formatted.' '.$currency;
    }
}
