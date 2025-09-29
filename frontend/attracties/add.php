<?php
// frontend/attracties/add.php
require_once __DIR__ . '/../../backend/config/db.php';
require_once __DIR__ . '/../../backend/controllers/AttractieController.php';

$controller = new AttractieController($pdo);
$message = "";
$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // basisvalidatie van tekstvelden
    $naam = $_POST['naam'] ?? '';
    $locatie = $_POST['locatie'] ?? '';
    $type = $_POST['type'] ?? '';
    $technische_specs = $_POST['technische_specs'] ?? null;

    if (trim($naam) === '' || trim($locatie) === '' || trim($type) === '') {
        $error = "Vul minimaal naam, locatie en type in.";
    } else {
        // FOTO: standaard geen foto-pad
        $fotoPath = null;

        // Behandel upload als er één is
        if (isset($_FILES['foto']) && $_FILES['foto']['error'] !== UPLOAD_ERR_NO_FILE) {
            $file = $_FILES['foto'];

            // 1) basis checks
            if ($file['error'] !== UPLOAD_ERR_OK) {
                $error = "Fout bij uploaden (error code: " . $file['error'] . ")";
            } else {
                // 2) limieten en types
                $maxSize = 2 * 1024 * 1024; // 2MB
                if ($file['size'] > $maxSize) {
                    $error = "Bestand is te groot (max 2MB).";
                } else {
                    // veilige MIME-check
                    $finfo = new finfo(FILEINFO_MIME_TYPE);
                    $mime = $finfo->file($file['tmp_name']);
                    $allowed = ['image/jpeg' => 'jpg', 'image/png' => 'png', 'image/gif' => 'gif'];
                    if (!array_key_exists($mime, $allowed)) {
                        $error = "Ongeldig bestandstype. Alleen JPG, PNG of GIF toegestaan.";
                    } else {
                        // 3) maak uploads map indien nodig
                        $uploadDir = __DIR__ . '/../../uploads/';
                        if (!is_dir($uploadDir)) {
                            mkdir($uploadDir, 0755, true);
                        }

                        // 4) veilige bestandsnaam
                        $ext = $allowed[$mime];
                        $random = bin2hex(random_bytes(6));
                        $filename = time() . "_" . $random . "." . $ext;
                        $target = $uploadDir . $filename;

                        // 5) verplaats bestand
                        if (move_uploaded_file($file['tmp_name'], $target)) {
                            // sla relatief pad op (zodat URL later: /hollowMountains/uploads/...)
                            $fotoPath = 'uploads/' . $filename;
                        } else {
                            $error = "Kon het bestand niet verplaatsen naar uploads-directory.";
                        }
                    }
                }
            }
        }

        // Als geen fouten bij upload/verwerking: opslaan in DB
        if ($error === "") {
            $ok = $controller->createAttractie($naam, $locatie, $type, $technische_specs, $fotoPath);
            if ($ok) {
                // redirect zodat F5 niet dubbel invoegt
                header("Location: /hollowMountains/frontend/attracties/add.php?success=1");
                exit;
            } else {
                $error = "Er ging iets mis bij het opslaan in de database.";
            }
        }
    }
}

// eind POST verwerking
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

    <?php if ($error): ?>
        <p style="color:red;"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>

    <form action="" method="POST" enctype="multipart/form-data">
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
        <textarea name="technische_specs" rows="4" cols="50"></textarea><br><br>

        <label>Foto (JPG/PNG/GIF, max 2MB):</label><br>
        <input type="file" name="foto" accept="image/*"><br><br>

        <button type="submit">Opslaan</button>
    </form>
</body>
</html>
