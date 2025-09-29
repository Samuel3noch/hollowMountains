<?php
// backend/controllers/AttractieController.php

class AttractieController {
    private $pdo;

    // $pdo wordt doorgegeven vanuit frontend via require config/db.php
    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    // Create (slaat ook pad van foto op)
    public function createAttractie(string $naam, string $locatie, string $type, ?string $technische_specs, ?string $fotoPath): bool {
        $sql = "INSERT INTO attractie (naam, locatie, type, technische_specs, foto)
                VALUES (:naam, :locatie, :type, :technische_specs, :foto)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':naam' => trim($naam),
            ':locatie' => trim($locatie),
            ':type' => trim($type),
            ':technische_specs' => $technische_specs !== "" ? $technische_specs : null,
            ':foto' => $fotoPath
        ]);
    }

    // Read all
    public function getAllAttracties(): array {
        $stmt = $this->pdo->query("SELECT * FROM attractie ORDER BY id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Read by id
    public function getAttractieById(int $id): ?array {
        $stmt = $this->pdo->prepare("SELECT * FROM attractie WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ?: null;
    }
}