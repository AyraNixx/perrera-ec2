<?php

//Comprobamos que la sesion esta iniciada
session_start();
//Si no tenemos guardado login 
if (!isset($_SESSION["login"])) {
    header("Location:../controller/LoginC.php");
}
$nombre = $_SESSION["nombre"];

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    
    <h1><?=$nombre?></h1>

</body>
</html>