<?php
require_once("db_connection.php");

$message = ""; // Initialisieren der Message-Variable

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['username']) && !empty($_POST['toranzahl']) && !empty($_POST['laufzeit'])) {
        $username = htmlspecialchars(trim($_POST['username']));
        $toranzahl = (int) $_POST['toranzahl'];
        $laufzeit = htmlspecialchars(trim($_POST['laufzeit']));

        try {
            $stmt = $pdo->prepare("INSERT INTO trainings (username, toranzahl, laufzeit) VALUES (:username, :toranzahl, :laufzeit)");
            $stmt->bindParam(":username", $username);
            $stmt->bindParam(":toranzahl", $toranzahl, PDO::PARAM_INT);
            $stmt->bindParam(":laufzeit", $laufzeit);
            $stmt->execute();

            $message = "<div class='text-green-600 font-semibold mt-4'>Highscore erfolgreich eingetragen!</div>";
        } catch (PDOException $e) {
            $message = "<div class='text-red-600 font-semibold mt-4'>Fehler: " . htmlspecialchars($e->getMessage()) . "</div>";
        }
    } else {
        $message = "<div class='text-red-600 font-semibold mt-4'>Bitte fülle alle Felder aus!</div>";
    }
}

// Alle bisherigen Highscores abrufen
$highscores = [];
try {
    $stmt = $pdo->query("SELECT * FROM trainings ORDER BY toranzahl DESC, laufzeit ASC");
    $highscores = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $message .= "<div class='text-red-600 font-semibold mt-4'>Fehler beim Laden der Highscores: " . htmlspecialchars($e->getMessage()) . "</div>";
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>PowderPoints – Highscore melden</title>
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
        .icon-btn img {
            border-radius: 50%;
            background: white;
            padding: 4px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body class="flex flex-col min-h-screen">

    <!-- Header -->
    <header class="bg-blue-900 text-white shadow-md py-4 px-6 flex justify-between items-center">
        <div class="flex-1 flex justify-center">
            <!-- Logo oder Titel -->
        </div>
        <div class="flex space-x-6">
            <a href="login.php" class="icon-btn flex items-center hover:bg-blue-700 px-3 py-2 rounded-lg transition">
                <img src="../Bilder/login mänchen.jpg" alt="Anmelden" class="h-8 w-8 mr-2" /> Anmelden
            </a>
            <a href="startseite.php" class="icon-btn flex items-center hover:bg-blue-700 px-3 py-2 rounded-lg transition">
                <img src="../Bilder/ski symbol.jpg" alt="startseite" class="h-8 w-8 mr-2" />Startseite
            </a>
        </div>
    </header>

    <!-- Hauptinhalt -->
    <main class="flex-grow flex justify-center items-center p-6">
        <div class="snow-effect max-w-3xl w-full">
            <h2 class="text-3xl font-semibold text-blue-900 mb-4 text-center">Highscore melden</h2>
            <p class="text-gray-700 mb-6 text-center">
                Trage deine Trainingsdaten ein und vergleiche dich mit anderen Athleten!
            </p>

            <form method="POST" action="" class="space-y-4">
                <div>
                    <label for="username" class="block text-blue-900 font-semibold">Name:</label>
                    <input type="text" name="username" id="username" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
                </div>

                <div>
                    <label for="toranzahl" class="block text-blue-900 font-semibold">Toranzahl:</label>
                    <input type="number" name="toranzahl" id="toranzahl" min="1" step="1" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
                </div>

                <div>
                    <label for="laufzeit" class="block text-blue-900 font-semibold">Laufzeit (Sekunden):</label>
                    <input type="text" name="laufzeit" id="laufzeit" placeholder="z. B. 00:45"
                        pattern="^[0-9]{2}:[0-5][0-9]$" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
                </div>

                <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition">
                    Highscore melden
                </button>
            </form>

            <?= $message ?>

            <!-- Highscore Tabelle -->
            <?php if (!empty($highscores)) : ?>
                <h3 class="text-2xl font-bold text-blue-900 mt-8 mb-4 text-center">Aktuelle Highscores</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-300 rounded text-center">
                        <thead class="bg-blue-200">
                            <tr>
                                <th class="py-2 px-4 border">#</th>
                                <th class="py-2 px-4 border">Name</th>
                                <th class="py-2 px-4 border">Toranzahl</th>
                                <th class="py-2 px-4 border">Laufzeit</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($highscores as $index => $row): ?>
                                <tr class="hover:bg-gray-100">
                                    <td class="py-2 px-4 border"><?= $index + 1 ?></td>
                                    <td class="py-2 px-4 border"><?= htmlspecialchars($row['username']) ?></td>
                                    <td class="py-2 px-4 border"><?= htmlspecialchars($row['toranzahl']) ?></td>
                                    <td class="py-2 px-4 border"><?= htmlspecialchars($row['laufzeit']) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-blue-900 text-white text-center py-4 mt-6">
        <p>&copy; 2025 PowderPoints. Alle Rechte vorbehalten.</p>
    </footer>
</body>
</html>
