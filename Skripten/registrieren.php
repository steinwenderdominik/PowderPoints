<?php
// ✅ Datenbankverbindung einrichten
$host = 'localhost';
$db = 'powderpoints';
$user = 'root';         // XAMPP Standard-Benutzer
$pass = '';             // XAMPP Standard-Passwort (leer)
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    die("Datenbankverbindung fehlgeschlagen: " . $e->getMessage());
}

// ✅ Formularverarbeitung
$successMessage = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (!empty($username) && !empty($password)) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
        $stmt->execute([
            ':username' => $username,
            ':password' => $hashedPassword
        ]);
        $successMessage = "✅ Registrierung erfolgreich!";
    } else {
        $successMessage = "❌ Bitte Benutzername und Passwort eingeben.";
    }
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>PowderPoints – Registrierung</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body {
      background-image: url('../Bilder/bild für website.jpg');
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

  <!-- Hauptinhalt -->
  <main class="flex-grow flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full snow-effect">
      <h2 class="text-center text-3xl font-extrabold text-gray-900 mb-6">Registrieren</h2>

      <?php if (!empty($successMessage)): ?>
        <div class="mb-4 text-center text-green-700 font-semibold">
          <?= htmlspecialchars($successMessage) ?>
        </div>
      <?php endif; ?>

      <form class="space-y-4" method="POST" action="">
        <div>
          <label for="username" class="block text-sm font-medium text-gray-700">Benutzername</label>
          <input id="username" name="username" type="text" required
            class="mt-1 w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        <div>
          <label for="password" class="block text-sm font-medium text-gray-700">Passwort</label>
          <div class="relative">
            <input id="password" name="password" type="password" required
              class="mt-1 w-full px-4 py-2 border rounded-lg pr-10 focus:outline-none focus:ring-2 focus:ring-blue-500">
            <button type="button" onclick="togglePassword()" class="absolute right-2 top-1/2 -translate-y-1/2 text-gray-600">
              👁
            </button>
          </div>
        </div>
        <div class="flex items-start">
          <input id="privacy" name="privacy" type="checkbox" required class="mt-1 mr-2">
          <label for="privacy" class="text-sm text-gray-700">
            Ich akzeptiere die <a href="#" class="text-blue-600 underline">Datenschutzbestimmungen</a>.
          </label>
        </div>
        <button type="submit"
          class="w-full bg-blue-900 text-white py-2 rounded-lg hover:bg-blue-700 transition">
          Registrieren
        </button>
      </form>
    </div>
  </main>

  <script>
    function togglePassword() {
      const passwordInput = document.getElementById('password');
      passwordInput.type = passwordInput.type === 'password' ? 'text' : 'password';
    }
  </script>

</body>
</html>
