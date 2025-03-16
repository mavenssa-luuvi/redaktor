<?php

require_once __DIR__ . '/../models/User.php';

class UserController {

    public function register() {
        $error = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username']);
            $email = trim($_POST['email']);
            $password = $_POST['password'];

            if (empty($username) || empty($email) || empty($password)) {
                $error = 'Wszystkie pola są wymagane.';
            } else {
                $success = User::register($username, $email, $password);
                if ($success) {
                    header('Location: index.php?action=login');
                    exit;
                } else {
                    $error = 'Błąd rejestracji. Nazwa użytkownika lub email może już istnieć.';
                }
            }
        }

        include __DIR__ . '/../views/users/register.php';
    }

    public function login() {
        $error = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username']);
            $password = $_POST['password'];

            if ($user = User::login($username, $password)) {
                session_start();
                $_SESSION['user'] = ['id' => $user['id'], 'username' => $user['username']];
                header('Location: index.php');
                exit;
            } else {
                $error = 'Błędne dane logowania.';
            }
        }

        include __DIR__ . '/../views/users/login.php';
    }

    public function logout() {
        session_start();
        session_destroy();
        header('Location: index.php?action=login');
        exit;
    }
}
