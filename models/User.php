<?php

require_once __DIR__ . '/../config/db.php';

class User {
    public static function register($username, $email, $password) {
        try {
            $pdo = Database::connect();
            $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
            return $stmt->execute([$username, $email, password_hash($password, PASSWORD_DEFAULT)]);
        } catch (PDOException $e) {
            return false; // np. gdy użytkownik/email już istnieje
        }
    }

    public static function login($username, $password) {
        try {
            $pdo = Database::connect();
            $stmt = $pdo->prepare("SELECT * FROM users WHERE username=?");
            $stmt->execute([$username]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($user && password_verify($password, $user['password'])) {
                return $user;
            }
            return false;
        } catch (PDOException $e) {
            return false;
        }
    }
}
