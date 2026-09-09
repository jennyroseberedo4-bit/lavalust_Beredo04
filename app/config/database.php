<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

$env_value = static function ($names, $default = '') {
    foreach ((array) $names as $name) {
        $value = getenv($name);
        if ($value !== false && trim($value) !== '') {
            return trim($value);
        }
    }

    return $default;
};

$database['main'] = array(
    'driver'    => 'mysql',
    'hostname'  => $env_value(['DB_HOST', 'MYSQL_HOST', 'AIVEN_HOST']),
    'port'      => $env_value(['DB_PORT', 'MYSQL_PORT', 'AIVEN_PORT'], '3306'),
    'username'  => $env_value(['DB_USERNAME', 'MYSQL_USER', 'AIVEN_USER']),
    'password'  => $env_value(['DB_PASSWORD', 'MYSQL_PASSWORD', 'AIVEN_PASSWORD']),
    'database'  => $env_value(['DB_NAME', 'MYSQL_DATABASE', 'AIVEN_DATABASE']),
    'charset'   => 'utf8mb4',
    'dbprefix'  => '',
    'path'      => ''
);
