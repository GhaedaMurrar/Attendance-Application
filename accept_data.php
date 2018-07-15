<?php
    session_start();
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "mydatabase";
    $conn = new mysqli($servername, $username, $password, $dbname);
     if($conn->connect_errno) die('Connection Error!');
      else{
          $conn->set_charset("utf8");
      }

     createNewPrediction($conn);

    function createNewPrediction( mysqli $conn) {
            $response = array();
            $recevie_Email = $_POST["User_Email"];
            $recevie_password = $_POST["User_Password"];
            $_SESSION["UserEmailApp"] = $_POST["User_Email"];
            $_SESSION["UserPasswordApp"] = $_POST["User_Password"];

            //mysql query
            $sql = "SELECT `email`, `password`, 'teacher_id'
                    FROM `teacher_account` 
                    WHERE '$recevie_Email' = teacher_account.email AND
                          '$recevie_password' = teacher_account.password ";

                      $accounts = mysqli_query($conn,$sql);
                      $num_account = mysqli_num_rows($accounts); 
                      
                      if($num_account == 1) 
                      {
                        
                        $response["error"] = true;
                        $response["message"] = "Logged in successfully !";
                      } else 
                            {
                                $response["error"] = false;
                                $response["message"] = "Try Again , please !";

                            }

                            $arr = array();
              while($row= mysqli_fetch_assoc($accounts)){
                $arr[]= $row;
                 // echo json response
              echo json_encode($response);
            }
      }
?>