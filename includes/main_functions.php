<?php

$options = get_option(REST_EXPOSE_OPTION_NAME);
$value = $options['re_exposed_fields'];

try {
    $fields = parseSetting($value);
    foreach ($fields as $field) {
        register_meta($field['type'], $field['key'], ['show_in_rest' => true]);
    }
} catch (InvalidArgumentException $e) {
    error_log('rest-expose: Unable to parse settings - ' . $e->getMessage());
}
