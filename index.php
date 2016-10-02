<?php
    session_start();

if((isset($_SESSION['logged_in'])) && ($_SESSION['logged_in'] == true))
{
    header('Location: dictionary.php');
    exit();
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
    <script src = "js/code.js"></script>
</head>
<body>
    
    <h1> Witaj w swoim słowniku!!!</h1>
    
    
    <form action="log_in.php" method="post">
    
        Login:<br /> <input type = "text" name = "login"><br />
        Password:<br /> <input type = "password" name ="password"><br /><br />
    
    <br>
    <input type="submit" value="Log In"></button>
            
    </form>
	       
    <?php
    
    if(isset($_SESSION['error']))
    {
        echo $_SESSION['error'];
        unset($_SESSION['error']);
    }
        
    
    
    ?>


    
</body>

</html>