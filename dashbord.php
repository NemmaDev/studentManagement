<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>
<body>
    <div class="navbar">
        
        <ul>
            <i id="user" class=" fas fa-user"></i>
            <h2>Welcome</h2>
            <h2>Admin</h2>
            <hr><br>
            <li><a href="dashbord.php" class="active">Accueil</a></li>
            <li><a href="inscription.html">Inscription</a></li>
            <li><a href="liste.php">Liste étudiants</a></li>
            <li><a href="payement.php">Payement</a></li>    
        </ul>
      
        <i id="quitter" class=" fas fa-sign-out-alt" onclick="logout()"></i>
        <h3>Déconnexion</h3>
        <?php
        try {
            $db = new PDO("mysql:host=localhost;dbname=student", "root", "");
        } catch (Exception $e) {
            die("Erreur :" . $e->getMessage());
        }
        
        // Requête pour obtenir le nombre total d'étudiants
        $req_total_etudiants = "SELECT COUNT(*) FROM etudiant";
        $stmt_total_etudiants = $db->query($req_total_etudiants);
        $total_etudiants = $stmt_total_etudiants->fetchColumn();
        
        // Requête pour obtenir le nombre d'étudiants payés
        $req_etudiants_payes = "SELECT COUNT(*) FROM paiement ";
        $stmt_etudiants_payes = $db->query($req_etudiants_payes);
        $etudiants_payes = $stmt_etudiants_payes->fetchColumn();
        
        // Calcul du nombre d'étudiants impayés en soustrayant les étudiants payés du total des étudiants
        $etudiants_impayes = $total_etudiants - $etudiants_payes;
        ?>   
    </div>
    <div class="container">
        <div class="rectangle">
            <h2>Total étudiants</h2>
            <h1 id="total"><?php echo $total_etudiants; ?></h1>
        </div>
        <div class="rectangle">
            <h2>Total payés</h2>
            <h1 id="paye"><?php echo $etudiants_payes; ?></h1>
        </div>
        <div class="rectangle">
            <h2>Total impayés</h2>
            <h1 id="impaye"><?php echo $etudiants_impayes; ?></h1>
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>