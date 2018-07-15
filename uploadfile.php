if ($_FILES['file-5[]']["error"] > 0)
                                { 
                                  echo "Return Code: " . $_FILES['file-5[]']["error"] . "<br />"; 
                                }
                                  else 
                                    if (file_exists($_FILES['file-5[]']["name"])) 
                                    {
                                        $a=$_FILES['file-5[]']['tmp_name'];
                                        $csv_file = $a;
                                        if (($getfile = fopen($csv_file, "r")) !== FALSE) {
                                               $data = fgetcsv($getfile, 1000, ",");
                                         while (($data = fgetcsv($getfile, 1000, ",")) !== FALSE) {

                                                $result = $data;
                                                $str = implode(",", $result);
                                                $slice = explode(",", $str);

                                                  $excel_academic_year= $slice[0];
                                                  $excel_academic_semester = $slice[1];
                                                  $excel_student_id = $slice[2];
                                                  $excel_student_name = $slice[3];
                                                  $excel_course_id = $slice[4];
                                                  $excel_course_name = $slice[5];
                                                  $excel_section_id = $slice[6];
                                                  $excel_course_CH = $slice[7];
                                                  $excel_teacher_name = $slice[8];

                                        $sql = "SELECT `section_id`, `course_id`, `year_num`, `semester`, 
                                                FROM `attendance`
                                                WHERE '$excel_section_id' = attendance.section_id AND
                                                      '$excel_course_id' = attendance.course_id AND
                                                      '$excel_academic_year' = attendance.year_num AND
                                                      '$excel_academic_semester' = attendance.semester ";

                                        $result = mysqli_query($conn,$sql);
                                        $count = mysqli_num_rows($result); 

                                        echo $count ;   
                                        if($count == 0) 
                                        {
                                            $sql = "INSERT INTO `atte`(`course_id`, `section_id`, `teacher_id`, `year`, `semester`, `capacity`) 
                                            VALUES ('{$_POST['CourseId']}','{$_POST['Sectionid']}','$teacher_id','{$_POST['year']}','{$_POST['semester']}','{$_POST['SectionCapacity']}')" ;
                                            $conn->query($sql);
                                        }
                                        else {
                                           echo "section added";
                                         }
                                       }
                                     }
                                    }