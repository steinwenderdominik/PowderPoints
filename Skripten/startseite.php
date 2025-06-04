<?php 
    require_once("db_connection.php");
?>

<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PowderPoints – Skihighscore</title>
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
    </style>
</head>
<body class="flex flex-col min-h-screen">
    <!-- Header -->
    <header class="bg-blue-900 text-white shadow-md py-4 px-6 flex justify-between items-center">
        <div class="flex-1 flex justify-center">
            <!--<img src="logo.png" alt="Logo" class="h-16">-->
        </div>
        <div class="flex space-x-6">
            <a href="hsmelden.php" class="icon-btn flex items-center hover:bg-blue-700 px-3 py-2 rounded-lg transition">
                <img src="../Bilder/ski symbol.jpg" alt="Highscore" class="h-8 w-8 mr-2"> Highscore
            </a>
            <a href="login.php" class="icon-btn flex items-center hover:bg-blue-700 px-3 py-2 rounded-lg transition">
                <img src="../Bilder/login mänchen.jpg" alt="Anmelden" class="h-8 w-8 mr-2"> Anmelden
            </a>
            <a href="registrieren.php" class="icon-btn flex items-center hover:bg-blue-700 px-3 py-2 rounded-lg transition">
                <img src="../Bilder/login mänchen.jpg" alt="Registrieren" class="h-8 w-8 mr-2"> Registrieren
            </a>
        </div>
    </header>

    <!-- Hauptinhalt -->
    <main class="flex-grow flex justify-center items-center p-6">
        <section class="snow-effect max-w-3xl w-full text-center flex items-center space-x-6">
            <img src="../Bilder/Logo.png" alt="Logo" class="h-24">
            <div>
                <h2 class="text-3xl font-semibold text-blue-900 mb-4">PowderPoints – Die digitale Skihighscore-Datenbank</h2>
                <p class="text-gray-700">
                    PowderPoints ist ein innovatives Tracking-System für Skitrainingsdaten, entwickelt für den Skiclub Bad Kleinkirchheim (SC-BKK). 
                    Es ermöglicht Trainern und Athleten, ihre Laufzeiten, Toranzahlen und Leistungen zu erfassen und auszuwerten. 
                    Das Projekt wird von Franziska Sommeregger, Leonie Staudacher und Dominik Steinwender umgesetzt.
                </p>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="bg-blue-900 text-white text-center py-4 mt-6">
        <p>&copy; 2025 PowderPoints. Alle Rechte vorbehalten.</p>
    </footer>
</body>
</html>
