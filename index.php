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
    <?php if (!empty($attractie['foto'])): ?>
    <p><strong>Foto:</strong><br>
       <img src="/hollowMountains/<?php echo htmlspecialchars($attractie['foto']); ?>" alt="Foto attractie" style="max-width:400px;">
    </p>
    <?php endif; ?>

</body>
</html>