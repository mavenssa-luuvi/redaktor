<?php

require_once __DIR__ . '/../models/Note.php';
require_once __DIR__ . '/../models/Notebook.php';

class NoteController {

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
        // Pobierz wszystkie notatki użytkownika
        $notebook_id = $_GET['notebook'] ?? null; // Opcjonalnie filtruj po zeszycie
        $notes = Note::getAll($_SESSION['user']['id'], $notebook_id);

        include __DIR__ . '/../views/notes/index.php';
    }

    public function add() {
        $error = '';

        // Pobierz zeszyty użytkownika
        $notebooks = Notebook::getAll($_SESSION['user']['id']);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = trim($_POST['title']);
            $content = trim($_POST['content']);
            $notebook_id = $_POST['notebook'] ?? null;

            if (empty($title) || empty($content) || empty($notebook_id)) {
                $error = 'Wszystkie pola są wymagane.';
            } else {
                $success = Note::add($title, $content, $_SESSION['user']['id'], $notebook_id);
                if ($success) {
                    header('Location: index.php');
                    exit;
                } else {
                    $error = 'Wystąpił błąd podczas dodawania notatki.';
                }
            }
        }

        include __DIR__ . '/../views/notes/add.php';
    }

    public function edit() {
        if (!isset($_GET['id'])) {
            header('Location: index.php');
            exit;
        }

        $noteId = $_GET['id'];
        $userId = $_SESSION['user']['id'];

        // Pobierz zeszyty i notatkę
        $notebooks = Notebook::getAll($userId);
        $note = Note::getById($noteId, $userId);

        if (!$note) {
            header('Location: index.php');
            exit;
        }

        $error = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = trim($_POST['title']);
            $content = trim($_POST['content']);
            $notebook_id = $_POST['notebook'] ?? null;

            if (empty($title) || empty($content) || empty($notebook_id)) {
                $error = 'Wszystkie pola są wymagane.';
            } else {
                $success = Note::update($noteId, $title, $content, $_SESSION['user']['id'], $notebook_id);
                if ($success) {
                    header('Location: index.php');
                    exit;
                } else {
                    $error = 'Wystąpił błąd podczas edytowania notatki.';
                }
            }
        }

        include __DIR__ . '/../views/notes/edit.php';
    }

    public function delete() {
        if (!isset($_GET['id'])) {
            header('Location: index.php');
            exit;
        }

        $noteId = $_GET['id'];
        $userId = $_SESSION['user']['id'];

        // Usuń notatkę
        $success = Note::delete($noteId, $userId);

        if ($success) {
            header('Location: index.php');
            exit;
        } else {
            echo "Wystąpił błąd podczas usuwania notatki.";
        }
    }
}
