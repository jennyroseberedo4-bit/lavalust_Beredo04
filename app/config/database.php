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

$is_render = strtolower((string) getenv('RENDER')) === 'true'
    || getenv('RENDER_SERVICE_ID') !== false
    || stripos((string) ($_SERVER['HTTP_HOST'] ?? ''), '.onrender.com') !== false;
$default_host = $is_render
    ? 'mysql-3b526c30-lavalustproject-beredo24.aivencloud.com'
    : '127.0.0.1';
$default_port = $is_render ? '12239' : '3306';
$default_user = $is_render ? 'avnadmin' : 'root';
$default_database = $is_render ? 'defaultdb' : 'mydbb';
$hostname = $env_value(['DB_HOST', 'MYSQL_HOST', 'AIVEN_HOST'], $default_host);
$port = $env_value(['DB_PORT', 'MYSQL_PORT', 'AIVEN_PORT'], $default_port);

if ($is_render && in_array(strtolower($hostname), ['127.0.0.1', 'localhost'], true)) {
    $hostname = $default_host;
    $port = $default_port;
}

$database['main'] = array(
    'driver'    => 'mysql',
    'hostname'  => $hostname,
    'port'      => $port,
    'username'  => $env_value(['DB_USERNAME', 'MYSQL_USER', 'AIVEN_USER'], $default_user),
    'password'  => $env_value(['DB_PASSWORD', 'MYSQL_PASSWORD', 'AIVEN_PASSWORD'], ''),
    'database'  => $env_value(['DB_NAME', 'MYSQL_DATABASE', 'AIVEN_DATABASE'], $default_database),
    'ssl'       => $is_render || strtolower($env_value(['DB_SSL_MODE'], '')) === 'required',
    'charset'   => 'utf8mb4',
    'dbprefix'  => '',
    'path'      => ''
);
