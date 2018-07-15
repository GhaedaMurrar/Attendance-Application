<?php 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mydatabase";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

 ob_start();
 session_start();
 if( isset($_SESSION['user'])!="" ){
  header("Location: home.php");
 }
        echo 'yes' ;

         $sql = "INSERT INTO `teacher_account`(`teacher_id`, `email`, `password`) VALUES ('{$_POST['myid']}','{$_POST['myemail']}','{$_POST['pass']}')";
         $conn->query($sql);

         $sql = "INSERT INTO `teacher`(`teacher_id`, `teacher_first_name`, `teacher_last_name`) 
                  VALUES ('{$_POST['myid']}','{$_POST['fn']}','{$_POST['ln']}')";
         $conn->query($sql);
?>
