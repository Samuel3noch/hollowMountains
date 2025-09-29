<?php
require_once __DIR__ . '/../config/db.php';

class Onderhoudschema {
    public function getAll() {
        global $pdo;
        $stmt = $pdo->query('SELECT * FROM onderhoudsschema');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($attractie_id, $onderhoud_datum, $onderhoud_type) {
        global $pdo;
        $stmt = $pdo->prepare('INSERT INTO onderhoudsschema (attractie_id, onderhoud_datum, onderhoud_type) VALUES (?, ?, ?)');
        return $stmt->execute([$attractie_id, $onderhoud_datum, $onderhoud_type]);
    }

    public function getByAttractieId($attractie_id) {
        global $pdo;
        $stmt = $pdo->prepare('SELECT * FROM onderhoudsschema WHERE attractie_id = ?');
        $stmt->execute([$attractie_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>