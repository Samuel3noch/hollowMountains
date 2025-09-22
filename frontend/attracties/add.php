<?php
require_once __DIR__ . '/../../backend/config/db.php';
require_once __DIR__ . '/../../backend/controllers/attractieController.php';

$message = "";
$controller = new attractieController($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $naam = $_POST['naam'] ?? '';
    $locatie = $_POST['locatie'] ?? '';
    $type = $_POST['type'] ?? '';
    $technische_specs = $_POST['technische_specs'] ?? null;

    if (trim($naam) === '' || trim($locatie) === '' || trim($type) === '') {
        $message = "Vul minimaal naam, locatie en type in.";
    } else {
        $ok = $controller->createAttractie($naam, $locatie, $type, $technische_specs);
        if ($ok) {
            header("Location: /hollowMountains/frontend/attracties/add.php?success=1");
            exit;
        } else {
            $message = "Er ging iets mis bij het opslaan.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="utf-8">
    <title>Nieuwe attractie registreren</title>
</head>
<body>
    <h1>Nieuwe attractie registreren</h1>

    <?php if (isset($_GET['success'])): ?>
        <p style="color:green;">✅ Attractie succesvol toegevoegd!</p>
    <?php endif; ?>

    <?php if ($message): ?>
        <p style="color:red;"><?php echo htmlspecialchars($message); ?></p>
    <?php endif; ?>

    <form method="post" action="">
        <label>Naam:</label><br>
        <input type="text" name="naam" required><br><br>

        <label>Locatie:</label><br>
        <input type="text" name="locatie" required><br><br>

        <label>Type:</label><br>
        <select name="type" required>
            <option value="achtbaan">Achtbaan</option>
            <option value="carrousel">Carrousel</option>
            <option value="water">Water</option>
            <option value="overig">Overig</option>
        </select><br><br>

        <label>Technische specificaties:</label><br>
        <textarea name="technische_specs"></textarea><br><br>

        <button type="submit" name="submit">Opslaan</button>
    </form>
</body>
</html>