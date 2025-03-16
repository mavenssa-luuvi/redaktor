<?php

require_once __DIR__ . '/../models/Note.php';

class NoteController {

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

        $notes = Note::getAll($_SESSION['user']['id']);
        include __DIR__ . '/../views/notes/index.php';
    }

    public function add() {
        if (!isset($_SESSION['user'])) {
            header('Location: index.php?action=login');
            exit;
        }

        $error = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = trim($_POST['title']);
            $content = trim($_POST['content']);

            if (empty($title) || empty($content)) {
                $error = 'Tytuł i treść są wymagane.';
            } else {
                $success = Note::add($title, $content, $_SESSION['user']['id']);
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
        if (!isset($_SESSION['user'])) {
            header('Location: index.php?action=login');
            exit;
        }

        if (!isset($_GET['id'])) {
            header('Location: index.php');
            exit;
        }

        $noteId = $_GET['id'];
        $userId = $_SESSION['user']['id'];
        
        $note = Note::getById($noteId, $userId);

        if (!$note) {
            header('Location: index.php');
            exit;
        }

        $error = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = trim($_POST['title']);
            $content = trim($_POST['content']);

            if (empty($title) || empty($content)) {
                $error = 'Tytuł i treść są wymagane.';
            } else {
                $success = Note::update($noteId, $title, $content, $userId);
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
        if (!isset($_SESSION['user'])) {
            header('Location: index.php?action=login');
            exit;
        }

        if (!isset($_GET['id'])) {
            header('Location: index.php');
            exit;
        }

        $noteId = $_GET['id'];
        $userId = $_SESSION['user']['id'];

        $success = Note::delete($noteId, $userId);

        if ($success) {
            header('Location: index.php');
            exit;
        } else {
            echo "Wystąpił błąd podczas usuwania notatki.";
        }
    }
}
