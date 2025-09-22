<?php
require_once '../../backend/config/db.php';
require_once '../../backend/controllers/AttractieController.php';

$message = "";

// Als formulier verzonden is:
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $controller = new AttractieController($pdo);
    $message = $controller->createAttractie(
        $_POST['naam'],
        $_POST['locatie'],
        $_POST['type'],
        $_POST['technische_specs']
    );
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Nieuwe Attractie Toevoegen</title>
</head>
<body>
    <h1>Nieuwe Attractie Toevoegen</h1>

    <?php if ($message): ?>
        <p><?php echo $message; ?></p>
    <?php endif; ?>

    <form method="POST">
        <label>Naam:</label><br>
        <input type="text" name="naam" required><br><br>

        <label>Locatie:</label><br>
        <input type="text" name="locatie" required><br><br>

        <label>Type:</label><br>
        <select name="type">
            <option value="achtbaan">Achtbaan</option>
            <option value="carrousel">Carrousel</option>
            <option value="water">Waterattractie</option>
            <option value="overig">Overig</option>
        </select><br><br>

        <label>Technische specificaties:</label><br>
        <textarea name="technische_specs"></textarea><br><br>

        <button type="submit">Opslaan</button>
    </form>
</body>
</html>