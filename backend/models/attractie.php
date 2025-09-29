<?php
require_once __DIR__ . '/../config/db.php';

class Attractie {
    public function getAll() {
        global $pdo;
        $stmt = $pdo->query('SELECT * FROM attracties');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        global $pdo;
        $stmt = $pdo->prepare('SELECT * FROM attracties WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($naam, $type, $capaciteit, $bouwjaar, $laatste_onderhoud) {
        global $pdo;
        $stmt = $pdo->prepare('INSERT INTO attracties (naam, type, capaciteit, bouwjaar, laatste_onderhoud) VALUES (?, ?, ?, ?, ?)');
        return $stmt->execute([$naam, $type, $capaciteit, $bouwjaar, $laatste_onderhoud]);
    }
}
?>