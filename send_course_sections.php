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
            $Academic_year = $_POST["Academic_year"];
            $Academic_semester = $_POST["Academic_semester"];
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
                               

            //mysql query
            $sql = "SELECT DISTINCT section.section_id , `course_name` , `capacity`
            		FROM `section` 
            		JOIN `course` ON section.course_id = course.course_id
            		WHERE section.teacher_id = '$teacher_id'
                    AND section.course_id = '$Course_id' 
                    AND section.section_year = '$Academic_year'
                    AND section.section_semester = '$Academic_semester' ";

                
            echo $teacher_id;
            $result = $conn->query($sql);
					   while($row= mysqli_fetch_assoc($result)){ $response[]= $row;}
		                $fp = fopen('send_course_sections.json', 'w');
						fwrite($fp, json_encode($response));
						fclose($fp);
					
              
      ?>