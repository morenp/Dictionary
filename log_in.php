<?php
     
    session_start();

    if((!isset($_POST['login']) ) || (!isset($_POST['password'])))
    {
        header('Location: index.php');
        exit();
    }

    require_once"login.php";


    $conn = @new mysqli($hostname, $username, $pw, $DBname);
    
    if($conn->connect_errno!=0)
    {
        echo"Error: ".$conn->connect_errno;
    }
    else
    {  
        $login = $_POST['login'];
        $password = $_POST['password'];
        
        $login = htmlentities($login, ENT_QUOTES, "UTF-8");
        $password = htmlentities($password, ENT_QUOTES, "UTF-8");
        
        
        
        
        
        if($result = $conn->query(sprintf("SELECT *FROM users WHERE name ='%s' AND pass='%s'",
                                         mysqli_real_escape_string($conn, $login),
                                         mysqli_real_escape_string($conn, $password))))
        {
            $users_amount = $result->num_rows;
            if($users_amount>0)
            {
                $_SESSION['logged_in'] = true;
    
                $row = $result->fetch_assoc();
                $_SESSION['id'] = $row['ID'];
                $_SESSION['user'] = $row['name'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['premium_days'] = $row['premium_days'];
                
                unset($_SESSION['error']);
                $result->free_result();
                header('Location: dictionary.php');
            }
            else
            {
                $_SESSION['error'] = '<span style = "color:red">Nieprawidłowy login lub hasło!</span>';
                header('Location: index.php');
            }
            
        }
        else
        {
            
        }
        
        $conn->close();
    }
    
    


    
    
    
      
?>
    
    
