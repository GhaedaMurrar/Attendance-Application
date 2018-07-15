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

            $response = array();
            $User_Email = $_POST["User_Email"];
            $User_Password = $_POST["User_Password"];
            $Course_id = $_POST["Course_id"];
            $Section_id = $_POST["Section_id"];
            $Academic_year = $_POST["Academic_year"];
            $Academic_semester = $_POST["Academic_semester"];
            $lect_day = $_POST["lect_day"];
            $lect_month = $_POST["lect_month"];
            $lect_year = $_POST["lect_year"];
            echo $User_Email ;
            echo $Academic_semester ;
            echo $Academic_year;
            echo $Course_id ;

            $sql = "SELECT `teacher_id` 
                    FROM `teacher_account`
                    WHERE '$User_Email' = teacher_account.email ";
				$result = mysqli_query($conn,$sql);
                $my_id_array=mysqli_fetch_assoc($result);
                $teacher_id = $my_id_array['teacher_id'];
                               

                //`student_id` ,`student_name` ,`attendance`, `note`
            //mysql query
            $sql = "SELECT *
                    FROM `lect_attendane` 
                    JOIN  `student` on student.student_id = lect_attendane.student_id 
                    WHERE lect_attendane.course_id = '$Course_id'
                    AND lect_attendane.section_id = $Section_id 
                    AND lect_attendane.section_year = '$Academic_year'
                    AND lect_attendane.section_semester = '$Academic_semester'
                    AND lect_attendane.lect_day = '$lect_day' 
                    AND lect_attendane.lect_month ='$lect_month'
                    AND lect_attendane.lect_year = '$lect_year'";
            $result = $conn->query($sql);
					   while($row= mysqli_fetch_assoc($result)){ $response[]= $row;}
		                $fp = fopen('send_students.json', 'w');
						fwrite($fp, json_encode($response));
						fclose($fp);
					
              
      ?>