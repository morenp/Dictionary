<?php
    session_start();

if(!isset($_SESSION['registration_OK']))
{
    header('Location: index.php');
    exit();
}
else
{
    unset($_SESSION['registration_OK']);
}
    
?>
<!DOCTYPE html>
<html lang = "pl">
<head>
    <meta charset = "utf-8">
    <title></title>
    <meta name = "description" content="">
    <meta name = "keywords" content="">
    <meta name = "author" content="">
    <meta http-equiv = "X-Ua-Compatible" content="IE=edge, chrome=1">
    <link rel = "stylesheet" href = "css/main.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <script src = "js/code.js"></script>
</head>
<body>
    
    <h1> Dziękujęmy za rejestrację w serwisie. Możesz zalogować się już na swoje konto</h1>
 
    <br /><br />
    <a href="index.php">Zaloguj się na swoje konto!</a>
    <br /><br />
  
</body>

</html>