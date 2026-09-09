<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class AuthController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->call->library('session');
        $this->call->database();
        $this->call->model('UsersModel');
        $this->session = Registry::get_object('session');
        $this->request = Registry::get_object('request');
        $this->response = Registry::get_object('response');
    }

    public function login()
    {
        if ($this->session->userdata('authenticated')) {
            $this->response->redirect($this->route_url('/products'));
        }

        $this->call->view('login', ['error' => null]);
    }

    public function authenticate()
    {
        $username = trim((string) $this->request->post('username'));
        $password = (string) $this->request->post('password');
        $configured_hash = getenv('ADMIN_PASSWORD_HASH');
        $password_hash = $configured_hash ?: password_hash('admin123', PASSWORD_DEFAULT);
        $user = $this->UsersModel->find_by('username', $username);
        $registered_hash = $user['password_hash'] ?? null;

        $admin_login = $username === (getenv('ADMIN_USERNAME') ?: 'admin') && password_verify($password, $password_hash);
        $user_login = $user && $registered_hash && password_verify($password, $registered_hash);

        if (!$admin_login && !$user_login) {
            $this->call->view('login', ['error' => 'Invalid username or password.']);
            return;
        }

        session_regenerate_id(true);
        $this->session->set_userdata([
            'authenticated' => true,
            'admin_username' => $username,
            'user_id' => $user['id'] ?? null,
        ]);
        $this->response->redirect($this->route_url('/products'));
    }

    public function signup()
    {
        $this->call->view('signup', ['error' => null, 'form' => []]);
    }

    public function register()
    {
        $form = [
            'firstname' => trim((string) $this->request->post('firstname')),
            'lastname' => trim((string) $this->request->post('lastname')),
            'email' => trim((string) $this->request->post('email')),
            'username' => trim((string) $this->request->post('username')),
        ];
        $password = (string) $this->request->post('password');
        $confirmation = (string) $this->request->post('password_confirmation');
        $error = null;

        if (in_array('', $form, true)) {
            $error = 'Please complete all fields.';
        } elseif (!filter_var($form['email'], FILTER_VALIDATE_EMAIL)) {
            $error = 'Please enter a valid email address.';
        } elseif (strlen($password) < 8) {
            $error = 'Password must be at least 8 characters.';
        } elseif ($password !== $confirmation) {
            $error = 'Passwords do not match.';
        } elseif ($this->UsersModel->find_by('username', $form['username'])) {
            $error = 'That username is already taken.';
        } elseif ($this->UsersModel->find_by('email', $form['email'])) {
            $error = 'That email is already registered.';
        }

        if ($error) {
            $this->call->view('signup', ['error' => $error, 'form' => $form]);
            return;
        }

        $form['password_hash'] = password_hash($password, PASSWORD_DEFAULT);
        $this->UsersModel->insert($form);
        $this->response->redirect($this->route_url('/login'));
    }

    public function logout()
    {
        $this->session->sess_destroy();
        $this->response->redirect($this->route_url('/login'));
    }

    private function route_url($path)
    {
        $public_path = rtrim(str_replace('\\', '/', dirname(str_replace('\\', '/', $_SERVER['SCRIPT_NAME'] ?? '/'))), '/');
        return ($public_path ?: '') . $path;
    }
}