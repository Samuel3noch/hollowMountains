<?php
class AttractieController {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Functie om een nieuwe attractie toe te voegen
    public function createAttractie($naam, $locatie, $type, $technische_specs) {
        try {
            $sql = "INSERT INTO attractie (naam, locatie, type, technische_specs) 
                    VALUES (:naam, :locatie, :type, :technische_specs)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ':naam' => $naam,
                ':locatie' => $locatie,
                ':type' => $type,
                ':technische_specs' => $technische_specs
            ]);
            return "✅ Attractie succesvol toegevoegd!";
        } catch (PDOException $e) {
            return "❌ Fout bij toevoegen: " . $e->getMessage();
        }
    }
}