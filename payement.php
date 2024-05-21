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
    <di class="navbar">
        
        <ul>
            <i id="user" class=" fas fa-user"></i>
            <h2>Welcome</h2>
            <h2>Admin</h2>
            <hr><br>
            <li><a href="dashbord.php">Accueil</a></li>
            <li><a href="inscription.html">Inscription</a></li>
            <li><a href="liste.php">Liste étudiants</a></li>
            <li><a href="payement.php" class="active">Payement</a></li>    
        </ul>
      
        <i id="quitter" class=" fas fa-sign-out-alt" onclick="logout()"></i>
        <h3>Déconnexion</h3>
    </div>

        <div class="payement-form-container">
            <form action="confirm_payement.php" method="post">
              <div class="input-group">
                <label for="etudiant_id">Matricule:</label>
                <input type="text" id="etudiant_id" name="etudiant_id" required>
            </div>
            <div class="input-group">
                <label for="montant">Montant:</label>
                <input type="text" id="montant" name="montant"required>
            </div>
            
            <div class="input-group">
                <label for="date_paiement">Date de payement:</label>
                <input type="date" id="date_paiement" name="date_paiement"required>
            </div>
            
            <div class="input-group">
                <input type="submit" id="submit" value="Payé">
            </div>
          
        </form>
    </div>
   
    <?php

        try{
            $db= new PDO("mysql:host=localhost;dbname=student","root","");
        }catch(Exception $e){
            die( "Erreur :" .$e->getMessage());
        }

        $req="SELECT *FROM paiement";
        //preparation de la requete

        $reqPrepa= $db->prepare($req);
        $reqPrepa-> execute();
        $liste= $reqPrepa-> fetchAll();
        
    ?>
    <table class="tb_payement" border="1">
        <tr>
            <th>Matricule</th>
            <th>Montant</th>
            <th>Date_paiement</th>
            <th colspan="2">Action</th>

        </tr>

        <?php

        foreach($liste as $row){
           
            echo"<tr>";
                echo"<td>".$row['etudiant_id']."</td>";
                echo"<td>".$row['montant']."</td>";
                echo"<td>".$row['date_paiement']."</td>";
                echo"<td ><a href=\"modifier.php?id=".$row['etudiant_id']."\"><i id='edit' class=' fas fa-edit'></i></a></td>";
                echo"<td ><a href=\"supprimer.php?id=".$row['etudiant_id']."\"><i id='remove' class=' fas fa-trash-alt'></i></a></a></td>";

            echo"</tr>";
            
        }
    ?>
    </table>
    
    <script src="script.js"></script>
</body>
</html>