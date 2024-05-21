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
            <li><a href="dashbord.php" >Accueil</a></li>
            <li><a href="inscription.html">Inscription</a></li>
            <li><a href="liste.php" class="active" >Liste étudiants</a></li>
            <li><a href="payement.php">Payement</a></li>    
        </ul>
      
        <i id="quitter" class=" fas fa-sign-out-alt" onclick="logout()"></i>
        <h3>Déconnexion</h3>
       
    </div>
    <form class="recherche" method="get">
        <input type="text" name="search">
        <input type="submit" id="submit" value="Rechercher">
    </form>

    <?php
    // Connexion à la base de données
    try{
        $db= new PDO("mysql:host=localhost;dbname=student","root","");
    }catch(Exception $e){
        die( "Erreur :" .$e->getMessage());
    }
    
    // Vérifier si la variable de recherche est définie
    if (isset($_GET['search']) && !empty($_GET['search'])) {
        $search = $_GET['search'];
        
        // Requête SQL pour filtrer les données en fonction de la recherche
        $req = "SELECT * FROM etudiant WHERE matricule LIKE '%$search%' OR nom LIKE '%$search%' OR prenom LIKE '%$search%' OR birth LIKE '%$search%' OR grade LIKE '%$search%' OR admission LIKE '%$search%' OR email LIKE '%$search%' OR nomparent LIKE '%$search%' OR telephone LIKE '%$search%'";
    } 
    else {
        $req="SELECT etudiant.id,etudiant.matricule,etudiant.nom,etudiant.prenom,etudiant.birth,etudiant.grade,etudiant.admission,etudiant.email,etudiant.nomparent,etudiant.telephone,
            CASE WHEN paiement.etudiant_id IS NULL THEN 'Non payé' ELSE ' Payé' END AS statut_paiement
            FROM etudiant
            LEFT JOIN paiement
            ON etudiant.id = paiement.etudiant_id";
    
    }

    // Préparation et exécution de la requête
    $reqPrepa = $db->prepare($req);
    $reqPrepa->execute();
    $liste = $reqPrepa->fetchAll();
    ?>

    <table border="1">
        <tr>
            <th>Matricule</th>
            <th>Nom</th>
            <th>Prenom</th>
            <th>Birthday</th>
            <th>Grade</th>
            <th>Admission</th>
            <th>Email</th>
            <th>Parent</th>
            <th>Contact</th>
            <th>Statut de paiement</th>
            <th colspan="2">Action</th>
        </tr>

        <?php
        foreach($liste as $row){
            echo"<tr>";
                echo"<td>".$row['matricule']."</td>";
                echo"<td>".$row['nom']."</td>";
                echo"<td>".$row['prenom']."</td>";
                echo"<td>".$row['birth']."</td>";
                echo"<td>".$row['grade']."</td>";
                echo"<td>".$row['admission']."</td>";
                echo"<td>".$row['email']."</td>";
                echo"<td>".$row['nomparent']."</td>";
                echo"<td>".$row['telephone']."</td>";
                echo"<td>".$row['statut_paiement']."</td>";
                echo"<td><a href=\"modifier.php?id=".$row['id']."\"><i id='edit' class='fas fa-edit'></i></a></td>";
                echo"<td><a href=\"delete.php?id=".$row['id']."\"><i id='remove' class='fas fa-trash-alt'></i></a></td>";
            echo"</tr>";
        }
        ?>
    </table>
    <script src="script.js"></script>
</body>
</html>
