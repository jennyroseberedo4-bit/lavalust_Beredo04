<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Welcome extends Controller {
	public function index() {
		$script_path = str_replace('\\', '/', $_SERVER['SCRIPT_NAME'] ?? '/index.php');
		$project_path = rtrim(str_replace('\\', '/', dirname(dirname($script_path))), '/');
		header('Location: ' . ($project_path ?: '') . '/users');
		exit;
	}
}
?>