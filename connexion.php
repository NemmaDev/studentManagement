<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=
, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php

try{
    $db= new PDO( "mysql:host=localhost;dbname=student","root","");
}catch(Exception $e){
    die( "Erreur :" .$e->getMessage());
}

$identifiant=$_POST ['username'];
$mdp=$_POST['password'];
//$password=md5($mdp);

$req= "SELECT* FROM tb_student where username=:ident and password=:pass ";
//preparation de la requetes

$reqPrepa= $db->prepare($req);
$reqPrepa-> execute([
    "ident"=>$identifiant,
    "pass"=>$mdp
]);

$nb=$reqPrepa->rowCount();

if($nb== 1){
    header("Location:dashbord.php");
}
else{
    echo  "Identifiant ou password incorrect";
    header("Location:index.html");
}

?>
</body>
</html>