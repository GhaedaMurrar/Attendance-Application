    $Lect_day = $_POST["selected_lect_day"];
            $Lect_month = $_POST["selected_lect_month"];
            $Lect_year = $_POST["selected_lect_year"];

            //mysql query
            $sql = "SELECT DISTINCT `student_name` , `attendance`, `note` 
            		FROM `lect_attendane` 
            		JOIN `student` ON lect_attendane.student_id = student.student_id
            		WHERE lect_attendane.course_id = '$Course_id'
                    AND lect_attendane.section_id = $Section_id 
                    AND lect_attendane.section_year = '$Academic_year'
                    AND lect_attendane.section_semester = '$Academic_semester' 
                    AND lect_attendane.lect_day = '$Lect_day'
                    AND lect_attendane.lect_month = '$Lect_month'
                    AND lect_attendane.lect_year ='$Lect_year' ";