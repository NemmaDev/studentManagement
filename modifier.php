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
            <li><a href="dashbord.php">Accueil</a></li>
            <li><a href="inscription.html"  class="active">Inscription</a></li>
            <li><a href="liste.php">Liste étudiants</a></li>
            <li><a href="payement.php">Payement</a></li>    
        </ul>
      
        <i id="quitter" class=" fas fa-sign-out-alt" onclick="logout()"></i>
        <h3>Déconnexion</h3>
    </div>
    <?php
        try{
            $db= new PDO("mysql:host=localhost;dbname=student","root","");
        }catch(Exception $e){
            die( "Erreur :" .$e->getMessage());
        }
        $id=$_GET['id'];
        $req= "SELECT* FROM etudiant Where (id=:id)";
        //preparation de la requetes

        $reqPrepa= $db->prepare($req);
        $res=$reqPrepa-> execute(["id"=> $id]);
        $liste= $reqPrepa-> fetchAll();
        foreach($liste as $row){
            $contact=$row;
        }
    ?>
    <div class="form-container">
        <form action="update.php" method="post">
            <div class="form-group">
                <input type="hidden" name="id" value="<?php echo $id?>">
             </div>
            <div class="form-group">
                <label for="matricule">Matricule:</label>
                <input type="text" id="matricule" name="matricule" value="<?php echo $contact['matricule']?>">
            </div>
            <div class="form-group">
                <label for="nom">Nom de famille:</label>
                <input type="text" id="nom" name="nom" value="<?php echo $contact['nom']?>">
            </div>
            <div class="form-group">
                <label for="prenom">Prénom:</label>
                <input type="text" id="prenom" name="prenom"value="<?php echo $contact['prenom']?>">
            </div>
            <div class="form-group">
                <label for="birth">Date de Naissance:</label>
                <input type="date" id="birth" name="birth"value="<?php echo $contact['birth']?>">
            </div>
            <div class="form-group">
                <label for="class">Grade:</label>
                <select id="class" name="class" value="<?php echo $contact['grade']?>">
                    <option value="1ère année SIA" >1ère année SIA</option>
                    <option value="2ème année SIA"  >2ème année SIA</option>
                    <option value="3ème année génie">3ème année génie </option>
                    <option value="3ème année réseaux" >3ème année réseaux</option>

                </select>

            </div>
            <div class="form-group">
                <label for="admission">Date d'admission:</label>
                <input type="date" id="admission" name="admission"value="<?php echo $contact['admission']?>">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
               <input type="email" name="email" id="email" value="<?php echo $contact['email']?>">
                
            </div>
            <div class="form-group">
                <label for="parent">Nom/Prénom Parent:</label>
                <input type="text" id="parent" name="parent"value="<?php echo $contact['nomparent']?>">
            </div>
            <div class="form-group">
                <label for="numero">Contact Parent:</label>
                <input type="text" id="numero" name="numero"value="<?php echo $contact['telephone']?>">
            </div>
            <div class="form-group">
                <input type="submit" id="submit" value="Enregister">
            </div>
        </form>
    </div>
    <script src="script.js"></script>
</body>
</html>