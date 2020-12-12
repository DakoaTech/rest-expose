<?php

function parseSetting($setting)
{
    $fields = explode(";", $setting);
    $result = [];
    foreach ($fields as $field) {
        if (empty(trim($field))) continue;
        $field = explode(".", $field);
        $type = trim($field[0]);
        $key = trim($field[1]);
        if (!strlen($type) || !strlen($key)) {
            throw new InvalidArgumentException("Invalid format.");
        }
        $result[] = ['type' => $type, 'key' => $key];
    }
    return $result;
}