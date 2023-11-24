
<?php
include ("../backend/server.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registracija</title>

    <!-- Vključitev Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container">
    <h2 class="mt-5">Registracija</h2>

    <form method="POST" action="../backend/obdelava_registracije.php">
        <div class="mb-3">
            <label for="ime" class="form-label">Ime:</label>
            <input type="text" class="form-control" name="ime" id="ime" required>
        </div>

        <div class="mb-3">
            <label for="priimek" class="form-label">Priimek:</label>
            <input type="text" class="form-control" name="priimek" id="priimek" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">E-pošta:</label>
            <input type="email" class="form-control" name="email" id="email" required>
        </div>

        <div class="mb-3">
            <label for="geslo" class="form-label">Geslo:</label>
            <input type="password" class="form-control" name="geslo" id="geslo" required>
        </div>

        <button type="submit" class="btn btn-primary">Registriraj se</button>
    </form>

    <!-- Vključitev Bootstrap JavaScript in jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
