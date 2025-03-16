<?php

require_once __DIR__ . '/../config/db.php';

class Notebook {
    public static function getAll($user_id) {
        $pdo = Database::connect();
        $stmt = $pdo->prepare("SELECT * FROM notebooks WHERE user_id = ? ORDER BY name ASC");
        $stmt->execute([$user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function add($name, $user_id) {
        try {
            $pdo = Database::connect();
            $stmt = $pdo->prepare("INSERT INTO notebooks (name, user_id) VALUES (?, ?)");
            $stmt->execute([$name, $user_id]);
            return true;
        } catch (PDOException $e) {
            echo "Błąd PDO: " . $e->getMessage();
            exit;
        }
    }
    
}
