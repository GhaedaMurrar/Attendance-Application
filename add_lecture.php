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
            $add_lect_day = $_POST["add_lect_day"];
            $add_lect_month = $_POST["add_lect_month"];
            $add_lect_year = $_POST["add_lect_year"];
            echo $User_Email ;
            echo $add_lect_year ;
            echo $add_lect_day;

            $sql = "SELECT `teacher_id` 
                    FROM `teacher_account`
                    WHERE '$User_Email' = teacher_account.email ";
				$result = mysqli_query($conn,$sql);
                $my_id_array=mysqli_fetch_assoc($result);
                $teacher_id = $my_id_array['teacher_id'];
                               

            //mysql query
            $sql = "SELECT`student_id`
            		FROM `students` 
            		WHERE students.course_id = '$Course_id'
                    AND students.section_id = $Section_id 
                    AND students.section_year = '$Academic_year'
                    AND students.section_semester = '$Academic_semester' ";
            $result = $conn->query($sql);
            $students = mysqli_num_rows($result); 
            echo $students ;
            if (mysqli_num_rows($result) > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    $student_id = $row['student_id'];
                    $sql = "INSERT INTO `lect_attendane`(`student_id`, `section_id`, `course_id`, `section_year`, `section_semester`, `lect_day`, `lect_month`, `lect_year`, `attendance`, `note`) 
                     VALUES ('$student_id','$Section_id','$Course_id','$Academic_year','$Academic_semester','$add_lect_day','$add_lect_month','$add_lect_year',0,'')";
                     $conn->query($sql);
                }
            } else {
                echo "0 results";
            }
          
            $sql = "SELECT DISTINCT `lect_day`, `lect_month`, `lect_year`
                    FROM `lect_attendane` 
                    WHERE lect_attendane.course_id = '$Course_id'
                    AND lect_attendane.section_id = $Section_id 
                    AND lect_attendane.section_year = '$Academic_year'
                    AND lect_attendane.section_semester = '$Academic_semester' ";
            echo $teacher_id;
            $result = $conn->query($sql);
                       while($row= mysqli_fetch_assoc($result)){ $response[]= $row;}
                        $fp = fopen('send_section_lectures.json', 'w');
                        fwrite($fp, json_encode($response));
                        fclose($fp);
              
      ?>