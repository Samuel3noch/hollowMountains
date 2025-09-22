<?php
// backend/controllers/attractieController.php

class attractieController {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function createAttractie(string $naam, string $locatie, string $type, ?string $technische_specs): bool {
        $sql = "INSERT INTO attractie (naam, locatie, type, technische_specs)
                VALUES (:naam, :locatie, :type, :technische_specs)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':naam' => trim($naam),
            ':locatie' => trim($locatie),
            ':type' => trim($type),
            ':technische_specs' => $technische_specs !== "" ? trim($technische_specs) : null
        ]);
    }

    public function getAllAttracties(): array {
        $stmt = $this->pdo->query("SELECT * FROM attractie ORDER BY id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}