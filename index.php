<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

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
            call_user_func([(new NotebookController), str_replace('Notebook', '', $action)]);
            break;    

    // Notatki:
    case 'add': // Obsługa dodawania notatek
    case 'edit': // Obsługa edytowania notatek
    case 'delete': // Obsługa usuwania notatek
        require_once 'controllers/NoteController.php';
        call_user_func([(new NoteController), $action]);
        break;

    // Domyślnie pokaż listę notatek:
    default:
        require_once 'controllers/NoteController.php';
        (new NoteController)->index();
}
