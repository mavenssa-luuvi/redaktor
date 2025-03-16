<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$action = $_GET['action'] ?? 'index';

switch ($action) {

    // Użytkownicy:
    case 'register':
        require_once 'controllers/UserController.php';
        (new UserController)->register();
        break;

    case 'login':
        require_once 'controllers/UserController.php';
        (new UserController)->login();
        break;

    case 'logout':
        require_once 'controllers/UserController.php';
        (new UserController)->logout();
        break;

    // Zeszyty:
    case 'notebooks':
    case 'addNotebook':
        require_once 'controllers/NotebookController.php';
        $method = ($action == 'addNotebook') ? 'add' : 'index';
        call_user_func([(new NotebookController), $method]);
        break;

    // Notatki:
    case 'add':
    case 'edit':
    case 'delete':
        require_once 'controllers/NoteController.php';
        call_user_func([(new NoteController), $action]);
        break;

    // Domyślnie pokaż listę notatek:
    default:
        require_once 'controllers/NoteController.php';
        (new NoteController)->index();
}
