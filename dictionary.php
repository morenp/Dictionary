<?php
    session_start();

if(!isset($_SESSION['logged_in']))
{
    unset($_SESSION['error']);
    header('Location: index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang = "pl">
<head>
    <meta charset = "utf-8">
    <title>Mój własny słownik</title>
    <meta name = "description" content="">
    <meta name = "keywords" content="">
    <meta name = "author" content="">
    <meta http-equiv = "X-Ua-Compatible" content="IE=edge, chrome=1">
    <link rel = "stylesheet" href = "css/main.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <script src = "js/code.js"></script>
</head>
<body>
    
    <?php
        
    echo "<p>WITAJ ".$_SESSION['user']."!";
    echo "<a href=logout.php>Log out!</a>";
    echo "<p>E-mail: ".$_SESSION['email'];
    echo "<p>dni premium: ".$_SESSION['premium_days'];
	//ZMIANA 
	/// ZMIANA
	
	//NEXT CHANGE
    ?>
    
</body>

</html>