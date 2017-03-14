<?php
    
session_start();
if(isset($_POST['email']))    
{
       //Udana walidacja?Załózmy, że tak!
    $everything_OK = true;
    
    //Sprawdź poprawność loginu
    $login = $_POST['login'];
    
    //Sprawdzenie długości loginu 
    if((strlen($login)<3) || (strlen($login)>20))
    {
        $everything_OK=false;
        $_SESSION['e_login']="Login has to contain 3 to 20 charackters!";
    }
 
    if(ctype_alnum($login) == false)
    {
        $everything_OK=false;
        $_SESSION['e_login']= "Login can consist only of digits and letters  (without national characters)";
    }
    
    
    // Sprawdzenie poprawności adresu email
    $email = $_POST['email'];
    $emailB = filter_var($email, FILTER_SANITIZE_EMAIL);
    
    if((filter_var($emailB, FILTER_VALIDATE_EMAIL) == false) || ($emailB!=$email))
    {
        $everything_OK=false;
        $_SESSION['e_email'] = "E-mail is incorrect!";
    }
    
    
    // Sprawdzenie poprawności hasła

    $password_1 = $_POST['password_1'];
    $password_2 = $_POST['password_2'];
    

    
    // Ograniczenie długości hasła
    if((strlen($password_1)<8) || (strlen($password_1)>20))
    {
        $everything_OK=false;
        $_SESSION['e_password'] = "Password has to contain 8 to 20 characters!"; 
        
    }
    
    // Sprawdzenie przypadku gdy podane hasła są różne
    if($password_1 != $password_2)
    {
        $everything_OK=false;
        $_SESSION['e_password'] = "Both passwords have to be the same!"; 
    }

    // Konwersja hasła do formy hash
    $password_hash = password_hash($password_1, PASSWORD_DEFAULT);
    
    // Akceptacja regulaminu 
    if(!isset($_POST['regulations']))
    {
        $everything_OK=false;
        $_SESSION['e_regulations'] = "Confirm acceptance of regulations!"; 
    }
    
    // Weryfikacja bota 
    $secret = 	"6LeKNggUAAAAAKa8gtrXqgsFyuMe_jeFY_nPoR0z";
    $check = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
    $response = json_decode($check);
    
    if(!($response->success))
    {
        $everything_OK=false;
        $_SESSION['e_bot'] = "Confirm you're not a bot!"; 
    }
    
    require_once "login.php";
    mysqli_report(MYSQLI_REPORT_STRICT);// sposób raportowania błęów oparty o wyjątki 
    try
    {
        $conn = new mysqli($hostname, $username, $pw, $DBname);
        
        if($conn->connect_errno!=0)
        {
            throw new Exception(mysqli_connect_errno());
        }
        else// Połącznie udane 
        {
            // Czy dany email istnieje w bazie
            $result = $conn->query("SELECT id FROM users Where email = '$email'");
            if(!$result) throw new Exception($conn->error);
            
            $same_mails = $result->num_rows;
            if($same_mails >0 )
            {
                $everything_OK=false;
                $_SESSION['e_email'] = "This e-mail is assigned to other account, try with another e-mail!"; 
            }
            
            
            // Czy dany login istnieje w bazie
            $result = $conn->query("SELECT id FROM users Where name = '$login'");
            if(!$result) throw new Exception($conn->error);
            
            $same_logins = $result->num_rows;
            if($same_logins >0 )
            {
                $everything_OK=false;
                $_SESSION['e_login'] = "This login is assigned to other account, try with another login!"; 
            }
            
   
            if($everything_OK == true)
            {
                //Wszystko OK 
                $result = $conn->query("SELECT max(id) FROM users");
                
                if(!$result) throw new Exception($conn->error);
               
                 while ($row = $result->fetch_assoc()) 
                 {
                     $row_number=$row['max(id)']+1;
                 }
                
                if($conn->query("INSERT INTO users VALUES ('$row_number', '$login','$password_hash','$email',0)"))
                {
                    $_SESSION['registration_OK']=true;
                    header('Location: welcome.php');
                }
                else
                {
                    throw new Exception($conn->error);
                }
                
                
                
                echo "Udana walidacja";
                exit();
            }
            // Zamknięcie połączenia z bazą danych
            $conn->close();
        }
        
    }
    catch(Exception $e)
    {
        echo "Server Error!";
        echo '<br />'.$e;
    }
}

?>
<!DOCTYPE html>
<html lang = "pl">
<head>
    <meta charset = "utf-8">
    <title>Your Dictionary - Create free account!</title>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <meta name = "description" content="">
    <meta name = "keywords" content="">
    <meta name = "author" content="">
    <meta http-equiv = "X-Ua-Compatible" content="IE=edge, chrome=1">
    
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel = "stylesheet" href = "css/main.css">
    <script src = "js/code.js"></script>
</head>
<body>
    
    
    <div id="registration">
           <form method = "post" >
           <fieldlist>
               <legend><h3>Fill it to sign up!</h3></legend>


               <!-- LOGIN -->
               <div class="form-group">
                   Login: <br /> <input type="text" name="login" class="form-control input-sm" />
               </div> 
                   <?php
                        if(isset($_SESSION['e_login']))
                        {
                            echo '<div class="alert alert-danger" role="alert">'.$_SESSION['e_login'].'</div>';
                            unset($_SESSION['e_login']);
                        }
                   ?>
               
               <!-- E-MAIL -->
               <div class="form-group">
                   E-mail: <br /> <input type="text" name="email" class="form-control input-sm" />
               </div>
                   <?php
                        if(isset($_SESSION['e_email']))
                        {
                            echo '<div class="alert alert-danger" role="alert">'.$_SESSION['e_email'].'</div>';
                            unset($_SESSION['e_email']);
                        }
                   ?>
               
               <!-- PASSWORD -->
               <div class="form-group">
                   Password: <br /> <input type="password" name="password_1" class="form-control input-sm"/>
               </div>
                   <?php
                            if(isset($_SESSION['e_password']))
                            {
                                echo '<div class="alert alert-danger" role="alert">'.$_SESSION['e_password'].'</div>';
                                unset($_SESSION['e_password']);
                            }
                   ?>
               
               <!-- REPEAT PASSWORD -->
               <div class="form-group">
                    Repeat password: <br /><input type="password" name="password_2" class="form-control input-sm"/>
               </div>
               <!-- REGULATIONS -->
               <div class="checkbox">
                    <label><input type ="checkbox" name="regulations" /> Accept regulations</label>
               </div>
                   <?php
                            if(isset($_SESSION['e_regulations']))
                            {
                                echo '<div class="alert alert-danger" role="alert">'.$_SESSION['e_regulations'].'</div>';
                                unset($_SESSION['e_regulations']);
                            }
                   ?>
               <!-- CAPTCHA -->
               <div class="g-recaptcha gc-reset" data-sitekey="6LeKNggUAAAAALLhRikRKSLHDErPaiAWVeQZ_Pzu"></div>
                   <?php
                            if(isset($_SESSION['e_bot']))
                            {
                                echo '<div class="alert alert-danger" role="alert">'.$_SESSION['e_bot'].'</div>';
                                unset($_SESSION['e_bot']);
                            }
                    ?>

               <br />
               <legend></legend>
            
               <button type ="submit" class="btn btn-primary btn-lg">Sign up</button>
               <a href="index.php"><button type ="button" class="btn btn-primary btn-lg" style = "float:right">Back</button>
               
               
               </fieldlist>
           </form>
        </div> <!-- END OF CONTAINER -->


    
</body>

</html>










