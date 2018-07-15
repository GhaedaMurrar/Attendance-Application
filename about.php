<?php 
    session_start();
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "mydatabase";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if($conn->connect_errno) die('Connection Error!');
      else{
          $conn->query("SET NAMES 'utf8'");
          $conn->query("SET CHARACTER SET utf8");
      }


    //registration process
        if(isset($_POST['SignUpForm']))
    {
        $sql = "INSERT INTO `teacher`(`teacher_id`, `teacher_first_name`, `teacher_last_name`) 
                  VALUES ('{$_POST['id']}','{$_POST['FirstName']}','{$_POST['SecondName']}')";
         $conn->query($sql);

         $sql = "INSERT INTO `teacher_account`(`teacher_id`, `email`, `password`) VALUES ('{$_POST['id']}','{$_POST['email']}','{$_POST['psw']}')";
         $conn->query($sql);
        $_SESSION["useremail"] = $_POST['email'];
        $_SESSION["userpassword"] = $_POST['psw'];
        header("location: http://127.0.0.1/attendance%20app/logedin.php") ;
    }

    //login check 
         if(isset($_POST['LogInForm'])) {      
            $myuseremail = $_POST['userEmail'] ;
            $mypassword = $_POST['userPsw'] ;
            $sql = "SELECT `teacher_id` FROM `teacher_account` WHERE teacher_account.email = '$myuseremail' and teacher_account.password = '$mypassword'";
            $result = mysqli_query($conn,$sql);
            $count = mysqli_num_rows($result);      
            if($count == 1) 
            {
                $_SESSION["useremail"] = $myuseremail;
                $_SESSION["userpassword"] = $mypassword;
                header("location: http://127.0.0.1/attendance%20app/logedin.php") ;
                exit();
            }
            else {
               $error = "Your Login Name or Password is invalid";
            }
         }
      ?>

<!DOCTYPE html>
<html >
<head>
  <!-- Theme Made By www.w3schools.com - No Copyright -->
  <title>Home</title>
  <meta http-equiv="Content-Type" content="text/html" charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="utf-8">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="about.css">
  <link rel="stylesheet" href="regestrationandmodel.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- for popup model -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
 

  <!-- for sign up form-control            data-spy="scroll" data-target=".navbar"-->
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600' rel='stylesheet' type='text/css'>
  <!-- <link href="//netdna.bootstrapcdn.com/font-awesome/3.1.1/css/font-awesome.css" rel="stylesheet"> -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

</head>
<body id="myPage" >
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <script type="text/javascript" src="about.js"></script>   

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span> 
      </button>
      <div id="left-side">
          <a href="#home" id="logo" class="col-md-1"> <img id="ppu-logo" src="https://ppu.edu/p/sites/default/files/ppu%20logo-copy_1_1_0.png"></a>
          <div class="col-md-8">
              <div class ="row" id="row1"><p>Palestine Polytechnic University</p></div>
              <div class = "row" id="row2"> <p>Attendance Application</p></div>
          </div>
      </div>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">

      <ul class="nav navbar-nav navbar-right">
        <li ><a  id="SignUpTrigger" data-toggle="modal" data-target="#signupModal"> <span class="glyphicon glyphicon-user"></span>Sign Up</a></li>
          <div id="signupModal" class="modal" >
          <!-- Modal content -->
              <div class="content center">
                  <div class="modal-header">
                    <span class="close hide-t-c" id="closeSignup">&times;</span>
                    <font size= "5" > Registration </font>
                  </div>
                  <div class="modal-body">
                  <form class="modal-content animate" action = "about.php" method="POST" id="SignUpForm" name ="SignUpForm" autocomplete="off">
                      <div class="cont">

                        <div id="form-group-first-name">
                        <label><b>First Name</b></label>
                        <input type="text" class="form-control input-lg" tabindex="1" placeholder="Enter your First Name" name="FirstName" id="FirstName" >
                        <span id="form-span-first-name" aria-hidden="true"></span>
                        </div>

                        <div id="form-group-second-name">
                        <label><b>Second Name</b></label>
                        <input type="text" class="form-control input-lg" tabindex="2" placeholder="Enter your Second Name" name="SecondName" id="SecondName">
                        <span id="form-span-second-name" aria-hidden="true"></span>
                        </div>

                        <div id="form-group-id">
                        <label><b>ID</b></label>
                        <input type="number" class="form-control input-lg" tabindex="3" placeholder="Enter your ID" name="id" id="id">
                        <span id="form-span-id" aria-hidden="true"></span>
                        </div>

                        <div id="form-group-email">
                        <label><b>Email</b></label>
                        <input type="email" class="form-control input-lg" tabindex="4" placeholder="Enter Email" name="email" id="email">
                        <span id="form-span-email" aria-hidden="true"></span>
                        </div>

                        <div id="form-group-password">
                        <label><b>Password</b></label>
                        <input type="password" class="form-control input-lg" tabindex="5" placeholder="Enter Password" name="psw" id="psw" required>
                        <span id="form-span-password" aria-hidden="true"></span>
                        </div>

                        <div id="form-group-password-confirm">
                        <label><b>Repeat Password</b></label>
                        <input type="password" class="form-control input-lg" tabindex="6" placeholder="Repeat Password" name="psw-repeat" id="psw-repeat" required>
                        <span id="form-span-password-confirm" aria-hidden="true"></span>
                        </div></br>
                        <div class="clearfix">
                          <button type="submit" class="centerBtn" tabindex="7" id="signupbtn" name="SignUpForm" disabled style="color: #E64A19;">
                          <font color="white" size="3">Sign Up</font></button>
                        </div>
                      </div>
                    </form>
                    </div>
              </div>
      </div>
        <li><a id="loginTrigger" data-toggle="modal" data-target="#loginModal" ><span class="glyphicon glyphicon-log-in"></span> Log In</a></li>
        <li ><a href="http://127.0.0.1/attendance%20app/about.php" class="hover">About </a></li>
        <div id="loginModal" class="modal">
          <!-- Modal content -->
              <div class="content center">
                  <div class="modal-header">
                    <span class="close hide-t-c" id="closeLogin">&times;
                        <script> 
                                    $('#closeLogin').click(function()  // click x in signup modal  
                                        {
                                          'use strict';
                                            $('#loginModal').modal('hide');
                                        });
                            </script>
                    </span>
                    <font size= "5" > Log In Your Account </font>
                  </div>
                  <div class="modal-body">
                  <form class="modal-content animate" id="LogInForm" autocomplete="on" method="POST" name="LogInForm" action="about.php">
                      <div class="cont">

                        <div id="form-group-user-email">
                        <label><b>Email</b></label>
                        <input type="text" tabindex="1" placeholder="Enter Your Email" id="userEmail" name="userEmail" required>
                        <span id="form-span-user-email"></span>
                        </div>

                        <div id="form-group-user-psw">
                        <label><b>Password</b></label>
                        <input type="password" tabindex="2" placeholder="Enter Your Password" id="userPsw" name="userPsw" required>
                        <span id="form-span-user-psw">
                        <div>

                        <input type="checkbox" tabindex="3" checked="checked"> Remember me </br>
                        <font color ="black"> <a href="#" tabindex="4"> forget your password ?</a></font>
                        <div class="clearfix ">
                          </br></br>
                          <button class = "centerBtn" type="submit" tabindex="5" name="LogInForm"><font color="white" size="3">Login</font></button>
                          <font color ="black"> <a href="#" tabindex="6" id="RegisterNow">
                          <script> 
                                    $('#RegisterNow').click(function()  // click x in signup modal  
                                        {
                                          'use strict';
                                            $('#loginModal').modal('hide');
                                            $('#signupModal').modal('show');
                                        });
                            </script>
                          First Time Here? Register Now</a></font>
                        </div>
                      </div>
                    </form>
                  </div>
              </div>
          </div>
      </ul>
    </div>
  </div>
</nav>

<div class="carousel fade-carousel slide" data-ride="carousel" data-interval="4000" id="bs-carousel">
  <!-- Overlay -->
  <div class="overlay"></div>

  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#bs-carousel" data-slide-to="0" class="active"></li>
    <li data-target="#bs-carousel" data-slide-to="1"></li>
    <li data-target="#bs-carousel" data-slide-to="2"></li>
  </ol>
  
  <!-- Wrapper for slides -->
  <div class="carousel-inner">
    <div class="item slides active">
      <div class="slide-1"></div>
      <div class="hero">
        <hgroup>
            <h1>Creative</h1>        
            <h3>Get start your next awesome project</h3>
        </hgroup>
      </div>
    </div>
    <div class="item slides">
      <div class="slide-2"></div>
      <div class="hero">        
        <hgroup>
            <h1>Smart</h1>        
            <h3>Get start your next awesome project</h3>
        </hgroup>       
      </div>
    </div>
    <div class="item slides">
      <div class="slide-3"></div>
      <div class="hero">        
        <hgroup>
            <h1>Amazing</h1>        
            <h3>Get start your next awesome project</h3>
        </hgroup>
      </div>
    </div>
  </div> 
</div>
</body>
</html>
