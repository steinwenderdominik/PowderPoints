<?php
require_once("db_connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['name'], $_POST['toranzahl'], $_POST['laufzeit'])) {
        $name = htmlspecialchars($_POST['name']);
        $toranzahl = htmlspecialchars($_POST['toranzahl']);
        $laufzeit = htmlspecialchars($_POST['laufzeit']);

        try {
            $stmt = $pdo->prepare("INSERT INTO trainings (benutzername, toranzahl, laufzeit, datum) 
                                   VALUES (:benutzername, :toranzahl, :laufzeit, NOW())");
            $stmt->bindParam(":benutzername", $name);
            $stmt->bindParam(":toranzahl", $toranzahl);
            $stmt->bindParam(":laufzeit", $laufzeit);
            $stmt->execute();

            $message = "<div class='text-green-600 font-semibold mt-4'>Highscore erfolgreich eingetragen!</div>";
        } catch (PDOException $e) {
            $message = "<div class='text-red-600 font-semibold mt-4'>Fehler beim Einfügen in die Datenbank.</div>";
        }
    } else {
        $message = "<div class='text-red-600 font-semibold mt-4'>Bitte fülle alle Felder aus!</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PowderPoints – Highscore melden</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background-image: url('../Bilder/bild%20für%20website.jpg');
            background-size: cover;
            background-position: center;
            font-family: Arial, sans-serif;
        }
        .snow-effect {
            background: rgba(255, 255, 255, 0.9);
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
    <header class="bg-blue-900 text-white shadow-md py-4 px-6 flex justify-between items-center">
        <div class="flex-1 flex justify-center"></div>
        <div class="flex space-x-6">
            <a href="highscore.php" class="icon-btn flex items-center hover:bg-blue-700 px-3 py-2 rounded-lg transition">
                <img src="../Bilder/ski%20symbol.jpg" alt="Highscore" class="h-8 w-8 mr-2"> Highscore
            </a>
            <a href="login.php" class="icon-btn flex items-center hover:bg-blue-700 px-3 py-2 rounded-lg transition">
                <img src="../Bilder/login%20mänchen.jpg" alt="Anmelden" class="h-8 w-8 mr-2"> Anmelden
            </a>
        </div>
    </header>

    <main class="flex-grow flex justify-center items-center p-6">
        <section class="snow-effect max-w-lg w-full text-center">
            <h2 class="text-3xl font-semibold text-blue-900 mb-4">Highscore melden</h2>
            <p class="text-gray-700 mb-4">Trage deine Trainingsdaten ein und vergleiche dich mit anderen Athleten!</p>

            <form method="POST" class="space-y-4">
                <div>
                    <label for="name" class="block text-blue-900 font-semibold">Name:</label>
                    <input type="text" name="name" id="name" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label for="toranzahl" class="block text-blue-900 font-semibold">Toranzahl:</label>
                    <input type="number" name="toranzahl" id="toranzahl" min="1" step="1" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label for="laufzeit" class="block text-blue-900 font-semibold">Laufzeit (Sekunden):</label>
                    <input type="number" name="laufzeit" id="laufzeit" min="1" step="0.01" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <button type="submit" name="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition">
                    Highscore melden
                </button>
            </form>

            <?php if (isset($message)) echo $message; ?>
        </section>
    </main>

    <footer class="bg-blue-900 text-white text-center py-4 mt-6">
        <p>&copy; 2025 PowderPoints. Alle Rechte vorbehalten.</p>
    </footer>
</body>
</html>
