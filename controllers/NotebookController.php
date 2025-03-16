<?php

require_once __DIR__ . '/../models/Notebook.php';

class NotebookController {

    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['user'])) {
            header('Location: index.php?action=login');
            exit;
        }
    }

    public function index() {
        // Pobierz wszystkie zeszyty użytkownika
        $notebooks = Notebook::getAll($_SESSION['user']['id']);

        include __DIR__ . '/../views/notebooks/index.php';
    }

    public function add() {
        $error = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name']);

            if (empty($name)) {
                $error = 'Nazwa zeszytu jest wymagana.';
            } else {
                // Dodaj zeszyt do bazy danych
                Notebook::add($name, $_SESSION['user']['id']);
                header('Location: index.php?action=notebooks');
                exit;
            }
        }

        include __DIR__ . '/../views/notebooks/add.php';
    }
}
