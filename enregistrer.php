<?php
$matricule=$_POST['matricule'];
$prenom=$_POST['prenom'];
$nom=$_POST['nom'];
$birth=$_POST['birth'];
$choix=$_POST['class'];
$admission=$_POST['admission'];
$email=$_POST['email'];
$parent=$_POST['parent'];
$telephone=$_POST['numero'];

try{
    $db= new PDO("mysql:host=localhost;dbname=student","root","");
}catch(Exception $e){
    die( "Erreur :" .$e->getMessage());
}
$req= "INSERT INTO etudiant (matricule,nom,prenom,birth,grade,admission,email,nomparent,telephone) values(:matricule,:nom,:prenom,:birth,:grade,:admission,:email,:nomparent,:telephone)";
//preparation de la requetes

$reqPrepa= $db->prepare($req);
$res=$reqPrepa-> execute([
    "matricule"=>$matricule,
    "nom"=>$nom,
    "prenom"=>$prenom,
    "birth"=>$birth,
    "grade"=>$choix,
    "admission"=>$admission,
    "email"=>$email,
    "nomparent"=>$parent,
    "telephone"=>$telephone
]);

if($res==true){
    echo"Enregistrement effectuer avec succes";
    header("Location:inscription.html");
    
}else{
    echo"Echec d'enregistrement";
}


?>