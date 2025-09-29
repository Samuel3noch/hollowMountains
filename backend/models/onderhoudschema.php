<?php
// onderhoudschema.php

class Onderhoudschema
{
    private $conn;
    private $table = 'attracties';

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Update attractie
    public function updateAttractie($id, $naam, $beschrijving, $status)
    {
        $query = "UPDATE {$this->table} SET naam = :naam, beschrijving = :beschrijving, status = :status WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':naam', $naam);
        $stmt->bindParam(':beschrijving', $beschrijving);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Delete attractie
    public function deleteAttractie($id)
    {
        $query = "DELETE FROM {$this->table} WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
?>