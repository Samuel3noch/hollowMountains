<?php
require_once 'backend/config/db.php';
if ($pdo) echo "Database werkt!";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Hollow Mountains Beheer</title>
</head>
<body>
    <h1>Welkom bij Hollow Mountains Beheer!</h1>
    <p>De database connectie werkt: <?php
        require_once 'backend/config/db.php';
        echo $pdo ? "✅" : "❌";
    ?></p>

    <h1>Hollow Mountains</h1>

    <div id="attracties">
        <!-- Attracties will be loaded here -->
    </div>

    <h2>Onderhoudsschema Instellen</h2>
    <form id="onderhoud-form">
        <label for="attractie">Attractie:</label>
        <select id="attractie-select" name="attractie_id" required>
            <!-- Attractie options will be loaded here -->
        </select>
        <br>
        <label for="onderhoud-datum">Datum:</label>
        <input type="date" id="onderhoud-datum" name="onderhoud_datum" required>
        <br>
        <label for="onderhoud-type">Type onderhoud:</label>
        <input type="text" id="onderhoud-type" name="onderhoud_type" required>
        <br>
        <button type="submit">Schema Toevoegen</button>
    </form>

    <h2>Bestaande Onderhoudsschema's</h2>
    <div id="onderhoud-list">
        <!-- Onderhoudsschema's will be loaded here -->
    </div>

    <script src="frontend/script.js"></script>
</body>
</html>