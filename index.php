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
    
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel = "stylesheet" href = "css/main.css">
    <link rel = "stylesheet" href = "fontello/css/fontello.css">
    <script src = "js/code.js"></script>
</head>
<body>
    <div id="container" >
        
        <div id="top_bar" class="col-md-12 col-lg-12">   
            
            <div id="tittle" class="col-lg-5 col-lg-offset-2 col-md-5 col-md-offset-2"> 
                 Your Dictionary
            </div>

            <div class = "log_bar" class="col-md-6 col-lg-6">
                <form class="form-inline" action="log_in.php" method="post">

                      <div class="form-group">
                        <label class="sr-only" >Login</label>
                        <input type="text" name = "login" class="form-control" placeholder="Login">
                      </div>
                      <div class="form-group">
                        <label class="sr-only" for="exampleInputPassword3">Password</label>
                        <input type="password" name="password" class="form-control" id="exampleInputPassword3" placeholder="Password">
                      </div>
                 
            
                
                      <div class="checkbox">
                        <label id = "remember">
                          <input type="checkbox"> Remember me
                        </label>
                      </div>
                      <button type="submit" class="btn btn-primary">Sign in</button>
                        <a href="registration.php"><button type="button" class="btn btn-primary">Sign Up</button></a>
        

                <?php   
                    if(isset($_SESSION['error']))
                    {

                        echo '<br />'.$_SESSION['error'];
                        unset($_SESSION['error']);
                    }
                ?> 

            
               </div>  <!-- END DIV LOG_BAR-->
                </form>



            
        </div> <!-- END DIV TOP_BAR-->
        
        <div id="content" class="col-sm-10 col-sm-offset-1">
                MENU!!!;
        </div>
        
        <div id="nav_bar" class="col-sm-12 ">
            WYBIERZ
        </div>
        
        </div><!-- END DIV CONTENT-->

    </div><!-- END DIV CONTAINER-->
    
    
    <div class="social col-sm-12 ">
        <div class="social_divs col-md-8 col-sm-offset-3">
            <div class="fb col-sm-2 "><i class="icon-facebook"></i></div>
            <div class="yt col-sm-2 "><i class="icon-youtube"></i></div>
            <div class="tw col-sm-2 "><i class="icon-twitter"></i></div>
            <div class="gp col-sm-2 "><i class="icon-gplus"></i></div>
        </div>
    </div>
    
    <div class="footer">
    YourDictionary.com &copy; 2016
    </div>

    
</body>

</html>

<!-- background-color: #dedede !important; -->