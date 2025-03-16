<?php

require_once __DIR__ . '/../config/db.php';

class Note {

    // Pobierz wszystkie notatki użytkownika (opcjonalnie tylko z wybranego zeszytu)
    public static function getAll($user_id, $notebook_id = null) {
        $pdo = Database::connect();

        if ($notebook_id) {
            $stmt = $pdo->prepare("SELECT * FROM notes WHERE user_id = ? AND notebook_id = ? ORDER BY created_at DESC");
            $stmt->execute([$user_id, $notebook_id]);
        } else {
            $stmt = $pdo->prepare("SELECT * FROM notes WHERE user_id = ? ORDER BY created_at DESC");
            $stmt->execute([$user_id]);
        }

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Dodaj nową notatkę
    public static function add($title, $content, $user_id, $notebook_id) {
        try {
            $pdo = Database::connect();
            $stmt = $pdo->prepare("INSERT INTO notes (title, content, user_id, notebook_id) VALUES (?, ?, ?, ?)");
            return $stmt->execute([$title, $content, $user_id, $notebook_id]);
        } catch (PDOException $e) {
            return false;
        }
    }

    // Pobierz jedną notatkę po ID
    public static function getById($id, $user_id) {
        try {
            $pdo = Database::connect();
            $stmt = $pdo->prepare("SELECT * FROM notes WHERE id = ? AND user_id = ?");
            $stmt->execute([$id, $user_id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return false;
        }
    }

    // Aktualizuj istniejącą notatkę
    public static function update($id, $title, $content, $user_id, $notebook_id) {
        try {
            $pdo = Database::connect();
            $stmt = $pdo->prepare("UPDATE notes SET title=?, content=?, notebook_id=? WHERE id=? AND user_id=?");
            return $stmt->execute([$title, $content, $notebook_id, $id, $user_id]);
        } catch (PDOException $e) {
            return false;
        }
    }

    // Usuń notatkę
    public static function delete($id, $user_id) {
        try {
            $pdo = Database::connect();
            return ($pdo->prepare("DELETE FROM notes WHERE id=? AND user_id=?")->execute([$id,$user_id]));
        } catch (PDOException $e) {
            return false;
        }
    }
}
