<?php
include "../backend/server.php";

include "../backend/login_obdelava.php";
include "../backend/zunanji_izvajalci.php";

session_start();

// Preverimo, ali je uporabnik prijavljen
if (!isset($_SESSION['uporabnik_id'])) {
    // Uporabnik ni prijavljen, preusmerimo ga na login stran
    header("Location: login.php");
    exit();
}


$stmt = $povezava->query("SELECT * FROM zamenjan_del");
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
    
<?php include "navbar.php" ?>
    <h2 class="mt-5">Vnos podatkov za zunanji izvajalec</h2>
    <form method="POST" action="../backend/zamenjan_del.php">
    
        <div class="mb-3">
            <label for="naziv" class="form-label">Naziv:</label>
            <input type="text" class="form-control" name="naziv" id="naziv" value="<?php echo isset($row['naziv']) ? $row['naziv'] : ''; ?>" required>
        </div>

        <div class="mb-3">
            <label for="kontaktna_stevilka" class="form-label">Opomba:</label>
            <input type="text" class="form-control" name="opomba" id="opomba" value="<?php echo isset($row['opomba']) ? $row['opomba'] : ''; ?>" required>
        </div>

    

        <button type="submit" class="btn btn-primary">Shrani</button>
    </form>

    <h2 class="mt-5">Seznam zunanjih izvajalcev</h2>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Naziv</th>
                <th>Opomba</th>
                
            </tr>
        </thead>
        <tbody>
            <?php foreach ($results as $row): ?>
                <tr>
                    <td><?php echo $row['idzamenjen_del']; ?></td>
                    <td><?php echo $row['naziv']; ?></td>
                    <td><?php echo $row['opomba']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>



<button type="button" onclick="odjava()">Izbriši sejo</button>


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


