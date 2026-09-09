<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Authenticated
{
    public function handle($next)
    {
        $session = Registry::get_object('session') ?: load_class('session', 'libraries');

        if (!$session || !$session->userdata('authenticated')) {
            $public_path = rtrim(str_replace('\\', '/', dirname(str_replace('\\', '/', $_SERVER['SCRIPT_NAME'] ?? '/'))), '/');
            header('Location: ' . ($public_path ?: '') . '/login');
            exit;
        }

        return $next();
    }
}