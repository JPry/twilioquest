<?php

require_once __DIR__ . '/vendor/autoload.php';

/*
 * Load credentials from config.json.
 *
 * The format should be Constant name => value.
 */
if (!is_readable(__DIR__ . '/config/config.json')) {
    throw new RuntimeException('You must define a config/config.json file');
}

$config = json_decode(file_get_contents(__DIR__ . '/config/config.json'));
foreach ($config as $name => $value) {
    define($name, $value);
}

unset($name, $value, $config);
