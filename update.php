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
$id=$_POST['id'];
$req= "UPDATE  etudiant SET matricule=:matricule,nom=:nom,prenom=:prenom,birth=:birth,grade=:grade,admission=:admission,email=:email,nomparent=:nomparent,telephone=:telephone Where (id=:id)";

//preparation de la requetes

$reqPrepa= $db->prepare($req);
$res=$reqPrepa-> execute([
    "id"=>$id,
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
    echo"Modification effectuer avec succes";
    header("Location:liste.php");
    
}else{
    echo"Echec de modification";
}


?>