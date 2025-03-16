<?php

require_once __DIR__ . '/../models/User.php';

class UserController {

    public function register() {
        $error = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (empty($_POST['username']) || empty($_POST['email']) || empty($_POST['password'])) {
                $error = "Wszystkie pola są wymagane!";
            } else {
                $success = User::register($_POST['username'], $_POST['email'], $_POST['password']);
                if ($success) {
                    header('Location: index.php?action=login');
                    exit;
                } else {
                    $error = "Błąd rejestracji. Użytkownik lub email może już istnieć.";
                }
            }
        }

        include __DIR__ . '/../views/users/register.php';
    }

    public function login() {
        $error = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($user = User::login($_POST['username'], $_POST['password'])) {
                $_SESSION['user'] = ['id' => $user['id'], 'username' => $user['username']];
                header('Location: index.php');
                exit;
            } else {
                $error = "Błędne dane logowania!";
            }
        }

        include __DIR__ . '/../views/users/login.php';
    }

    public function logout() {
        session_destroy();
        header('Location: index.php?action=login');
    }
}
