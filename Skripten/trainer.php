<?php 
    require_once("db_connection.php");

    // Highscores abrufen
    $query = "SELECT id, username, toranzahl, laufzeit";
    $result = $pdo->query($query);
?>

<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PowderPoints – Trainer-Bereich</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background-image: url('../Bilder/bild\ für\ website.jpg'); /* Schneelandschaft als Hintergrund */
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
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 12px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #007bff;
            color: white;
        }
        tr:hover {
            background-color: rgba(0, 123, 255, 0.1);
        }
    </style>
</head>
<body class="flex flex-col min-h-screen">
    <!-- Header -->
    <header class="bg-blue-900 text-white shadow-md py-4 px-6 flex justify-between items-center">
        <div class="flex-1 flex justify-center">
            <!--<img src="logo.png" alt="Logo" class="h-16">-->
        </div>
        <div class="flex space-x-6">
            <a href="highscore.php" class="icon-btn flex items-center hover:bg-blue-700 px-3 py-2 rounded-lg transition">
                <img src="../Bilder/ski symbol.jpg" alt="Highscore" class="h-8 w-8 mr-2"> Highscore
            </a>
            <a href="login.php" class="icon-btn flex items-center hover:bg-blue-700 px-3 py-2 rounded-lg transition">
                <img src="../Bilder/login mänchen.jpg" alt="Anmelden" class="h-8 w-8 mr-2"> Anmelden
            </a>
        </div>
    </header>

    <!-- Hauptinhalt -->
    <main class="flex-grow flex flex-col items-center p-6">
        <section class="snow-effect max-w-4xl w-full text-center">
            <h2 class="text-3xl font-semibold text-blue-900 mb-4">PowderPoints – Trainer-Bereich</h2>
            <p class="text-gray-700 mb-6">
                Willkommen im Trainer-Bereich! Hier kannst du alle Trainingsdaten der Athleten einsehen, analysieren und verwalten.
            </p>

            <!-- Tabelle mit Trainingsdaten -->
            <table>
                <tr>
                    <th>Name</th>
                    <th>Toranzahl</th>
                    <th>Laufzeit</th>
                    <th>Aktionen</th>
                </tr>

                <?php foreach ($result as $row): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['benutzername']) ?></td>
                        <td><?= htmlspecialchars($row['toranzahl']) ?></td>
                        <td><?= htmlspecialchars($row['laufzeit']) ?> s</td>
                        <td>
                            <a href="hsbearbeiten.php?id=<?= $row['id'] ?>" class="text-blue-600 hover:underline">Bearbeiten</a> |
                            <a href="hsloeschen.php?id=<?= $row['id'] ?>" class="text-red-600 hover:underline">Löschen</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </section>
    </main>

    <!-- Footer -->
    <footer class="bg-blue-900 text-white text-center py-4 mt-6">
        <p>&copy; 2025 PowderPoints. Alle Rechte vorbehalten.</p>
    </footer>
</body>
</html>
