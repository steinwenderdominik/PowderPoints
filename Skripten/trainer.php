<?php
session_start();

// Datenbankverbindung
$host = 'localhost';
$dbname = 'powderpoints';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Verbindung fehlgeschlagen: " . $e->getMessage());
}

// Highscore-Daten abrufen
$query = "SELECT id, username, toranzahl, laufzeit FROM trainings";
$result = $pdo->query($query);
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Trainer – Highscores Übersicht</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background-image: url('../Bilder/bild für website.jpg');
            background-size: cover;
            background-position: center;
            font-family: Arial, sans-serif;
        }
        .snow-effect {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.3);
        }
    </style>
</head>
<body class="flex flex-col min-h-screen">
    <!-- Header -->
    <header class="bg-blue-900 text-white shadow-md py-4 px-6 flex justify-between items-center">
        <div class="flex-1 flex justify-center"></div>
        <div class="flex space-x-6">
            <a href="hsmelden.php" class="icon-btn flex items-center hover:bg-blue-700 px-3 py-2 rounded-lg transition">
                <img src="../Bilder/ski symbol.jpg" alt="Highscore" class="h-8 w-8 mr-2"> Highscore
            </a>
            <a href="login.php" class="icon-btn flex items-center hover:bg-blue-700 px-3 py-2 rounded-lg transition">
                <img src="../Bilder/login mänchen.jpg" alt="Anmelden" class="h-8 w-8 mr-2"> Anmelden
            </a>
        </div>
    </header>

    <!-- Inhalt -->
    <main class="flex-grow flex items-center justify-center py-10">
        <div class="snow-effect w-full max-w-4xl">
            <h2 class="text-2xl font-bold mb-6 text-center">Highscores Übersicht</h2>
            <table class="min-w-full bg-white border border-gray-300 rounded">
                <thead class="bg-blue-200">
                    <tr class="text-center">
                        <th class="py-2 px-4 border">ID</th>
                        <th class="py-2 px-4 border">Benutzername</th>
                        <th class="py-2 px-4 border">Toranzahl</th>
                        <th class="py-2 px-4 border">Laufzeit</th>
                        <th class="py-2 px-4 border">Aktionen</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($result as $row): ?>
                        <tr class="text-center hover:bg-gray-100">
                            <td class="py-2 px-4 border"><?= htmlspecialchars($row['id']) ?></td>
                            <td class="py-2 px-4 border"><?= htmlspecialchars($row['username']) ?></td>
                            <td class="py-2 px-4 border"><?= htmlspecialchars($row['toranzahl']) ?></td>
                            <td class="py-2 px-4 border"><?= htmlspecialchars($row['laufzeit']) ?></td>
                            <td class="py-2 px-4 border">
                                <a href="hsbearbeiten.php?id=<?= $row['id'] ?>" class="text-blue-600 hover:underline">Bearbeiten</a> |
                                <a href="hsloeschen.php?id=<?= $row['id'] ?>" class="text-red-600 hover:underline" onclick="return confirm('Wirklich löschen?');">Löschen</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>
