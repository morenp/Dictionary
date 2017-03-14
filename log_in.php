<?php
     
    session_start();

    if((!isset($_POST['login']) ) || (!isset($_POST['password'])))
    {
        header('Location: index.php');
        exit();
    }

    require_once"login.php";
    mysqli_report(MYSQLI_REPORT_STRICT);// raportowania błęów oparty o wyjątki  

    $conn = new mysqli($hostname, $username, $pw, $DBname);
    
    if($conn->connect_errno!=0)
    {
        throw new Exception(mysqli_connect_errno());
    }
    else
    {  
        $login = $_POST['login'];
        $password = $_POST['password'];
        
        $login = htmlentities($login, ENT_QUOTES, "UTF-8");
       
        
        if($result = $conn->query(sprintf("SELECT *FROM users WHERE name ='%s'",
                                         mysqli_real_escape_string($conn, $login))))
                                         
        {
            $users_amount = $result->num_rows;
            if($users_amount>0)
            {
                
                $row = $result->fetch_assoc();
                
                if(password_verify($password, $row['pass']))
                {
                    $_SESSION['logged_in'] = true;
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
                    $_SESSION['error'] = '<span style = "color:red">Bad login or password!</span>';
                    header('Location: index.php');
                }
            }
            else
            {
                $_SESSION['error'] = '<span style = "color:red">Bad login or password!</span>';
                header('Location: index.php');
            }
            
        }
        else
        {
            throw new Exception($conn->error);
        }
        
        $conn->close();
    }
      
?>
    
    
