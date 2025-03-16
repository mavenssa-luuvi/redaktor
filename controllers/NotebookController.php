<?php

require_once __DIR__ . '/../models/Notebook.php';

class NotebookController {

    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function index() {
        if (!isset($_SESSION['user'])) {
            header('Location: index.php?action=login');
            exit;
        }

        // Pobierz wszystkie zeszyty użytkownika
        $notebooks = Notebook::getAll($_SESSION['user']['id']);
        
        // Przekaż zeszyty do widoku
        include __DIR__ . '/../views/notebooks/index.php';
    }

    public function add() {
        if (!isset($_SESSION['user'])) {
            header('Location: index.php?action=login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name']);
            
            if (!empty($name)) {
                Notebook::add($name, $_SESSION['user']['id']);
                header('Location: index.php?action=notebooks');
                exit;
            } else {
                echo "Nazwa zeszytu nie może być pusta.";
            }
        }

        include __DIR__ . '/../views/notebooks/add.php';
    }
}
