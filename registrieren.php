<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>PowderPoints – Skihighscore</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body {
      background-image: url('../Bilder/bild für website.jpg'); /* Schneelandschaft als Hintergrund */
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
    </div>
  </header>

  <!-- Hauptinhalt -->
  <main class="flex-grow flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full snow-effect">
      <h2 class="text-center text-3xl font-extrabold text-gray-900">Registrieren</h2>
      <form class="mt-8 space-y-6" action="login.php" method="POST">
        <div class="rounded-md shadow-sm -space-y-px">
          <div>
            <label for="username" class="sr-only">Benutzername</label>
            <input id="username" name="username" type="text" autocomplete="username" required
              class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm"
              placeholder="Benutzername">
          </div>
          <div>
            <label for="password" class="sr-only">Passwort</label>
            <input id="password" name="password" type="password" autocomplete="current-password" required
              class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm"
              placeholder="Passwort">
          </div>
        </div>

        <div>
          <button type="submit"
            class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-900 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
            Registrieren
          </button>
        </div>
      </form>
    </div>
  </main>

</body>
</html>
