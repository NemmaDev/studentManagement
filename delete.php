<?php

try{
    $db= new PDO("mysql:host=localhost;dbname=student","root","");
}catch(Exception $e){
    die( "Erreur :" .$e->getMessage());
}
$id=$_GET['id'];
$req="DELETE FROM etudiant WHERE id=:id";
$reqPrepa= $db->prepare($req);
$res=$reqPrepa-> execute(["id"=>$id]);
if($res==true){
    echo"suppression effectuer avec succes";
    // redirection
   header("Location:liste.php");
}else{
    echo"Echec de suppression";
}


?>