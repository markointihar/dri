<?php
include "../backend/server.php";

include "../backend/login_obdelava.php";


session_start();

// Preverimo, ali je uporabnik prijavljen
if (!isset($_SESSION['uporabnik_id'])) {
    // Uporabnik ni prijavljen, preusmerimo ga na login stran
    header("Location: login.php");
    exit();
}



$stmt = $povezava->query("SELECT * FROM zunanji_izvajalec");
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seznam zunanji izvajalcev</title>

    <!-- Vključitev Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container">
    <h2 class="mt-5">Vnos podatkov za zunanji izvajalec</h2>
    <form method="POST" action="../backend/zunanji_izvajalci.php">
    
        <div class="mb-3">
            <label for="naziv" class="form-label">Naziv:</label>
            <input type="text" class="form-control" name="naziv" id="naziv" value="<?php echo isset($row['naziv']) ? $row['naziv'] : ''; ?>" required>
        </div>

        <div class="mb-3">
            <label for="kontaktna_stevilka" class="form-label">Kontaktna številka:</label>
            <input type="text" class="form-control" name="kontaktna_stevilka" id="kontaktna_stevilka" value="<?php echo isset($row['kontaktna_stevilka']) ? $row['kontaktna_stevilka'] : ''; ?>" required>
        </div>

        <div class="mb-3">
            <label for="kontaktna_oseba" class="form-label">Kontaktna oseba:</label>
            <input type="text" class="form-control" name="kontaktna_oseba" id="kontaktna_oseba" value="<?php echo isset($row['kontaktna_oseba']) ? $row['kontaktna_oseba'] : ''; ?>" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">E-pošta:</label>
            <input type="email" class="form-control" name="email" id="email" value="<?php echo isset($row['email']) ? $row['email'] : ''; ?>" required>
        </div>

        <button type="submit" class="btn btn-primary">Shrani</button>
    </form>

    <h2 class="mt-5">Seznam zunanjih izvajalcev</h2>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Naziv</th>
                <th>Kontaktna številka</th>
                <th>Kontaktna oseba</th>
                <th>E-pošta</th>
                <th>Opcije</th> 
            </tr>
        </thead>
        <tbody>
            <?php foreach ($results as $row): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['naziv']; ?></td>
                    <td><?php echo $row['kontaktna_stevilka']; ?></td>
                    <td><?php echo $row['kontaktna_oseba']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td>
                    <a href="uredi_zunanji_izvajalec.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">Uredi</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>


    <!-- Gumb za izpis -->
<button type="button" onclick="odjava()">Izbriši sejo</button>

<!-- Vaša obstoječa vsebina -->
<!-- ... -->



    <script>
        function odjava() {
            // Pošlji zahtevek na strežnik, da seja uniči
            // To lahko naredite s pomočjo Ajax zahtevka
            // V tem primeru uporabljamo jQuery za poenostavitev
            $.ajax({
                type: 'POST',
                url: '../backend/odjava.php', // Navedite pravilno pot do skripta za izbris seje
                success: function(response) {
                    // Uspešno izbrisano
                    location.reload();
                    // Dodajte druge ukrepe, ki jih želite izvesti po izbrisu seje
                },
                error: function(error) {
                    // Napaka pri izbrisu
                    alert('Napaka pri izbrisu seje. '+ response.error);
                }
            });
        }
</script>

    <!-- Vključitev Bootstrap JavaScript in jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>


