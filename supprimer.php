<?php

try{
    $db= new PDO("mysql:host=localhost;dbname=student","root","");
}catch(Exception $e){
    die( "Erreur :" .$e->getMessage());
}
$id=$_GET['etudiant_id'];
$req="DELETE FROM paiement WHERE etudiant_id=:id";
$reqPrepa= $db->prepare($req);
$res=$reqPrepa-> execute(["id"=>$id]);
if($res==true){
    echo"suppression effectuer avec succes";
    // redirection
   header("Location:payement.php");
}else{
    echo"Echec de suppression";
}


?>