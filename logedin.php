<?php 
     
    session_start();
    //for read excel sheet 
    require_once "PHPExcel-1.8/Classes/PHPExcel.php";
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "mydatabase";
      
    //Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
     if($conn->connect_errno) die('Connection Error!');
      else{
          $conn->set_charset("utf8");
      }

      //echo "Hello";
    if(isset($_POST['submitAdd']) ) 
     {
        //echo'im in add section ';

            $Entered_Course_id = $_POST['CourseId'];
          /* echo $Entered_Course_id;
            echo "<br>";*/
            $Entered_year = $_POST['year'] ;
           /* echo $Entered_year;
            echo "<br>";*/
            $Entered_semester = $_POST['semester'];
        /*   echo $Entered_semester;
            echo "<br>";*/
            $Entered_Section_id = $_POST['Sectionid'] ;
         /*  echo $Entered_Section_id;
            echo "<br>";*/

            $sql = "SELECT `section_id`, `course_id`, `section_year`, `section_semester`
                              FROM `section`
                              WHERE '$Entered_Section_id' = section.section_id AND
                                    '$Entered_Course_id' = section.course_id AND
                                    '$Entered_year' = section.section_year AND
                                    '$Entered_semester' = section.section_semester ";

                      $added_sections = mysqli_query($conn,$sql);
                      $num_added_sections = mysqli_num_rows($added_sections); 
                     // echo $num_added_sections ; // print number of already exist sections 

                      if($num_added_sections == 0) 
                      {

                          $filename = 'C:\xampp\htdocs\Attendance App\uploads' . time() . $_SERVER['REMOTE_ADDR'] . 'xlsx'; 
                              // Copy the file (if it is deemed safe) 
                              if (!is_uploaded_file($_FILES['file-5']['tmp_name']) or 
                                  !copy($_FILES['file-5']['tmp_name'], $filename)) 
                              { 
                                $error = "Could not  save file as $filename!"; 
                                include $_SERVER['DOCUMENT_ROOT'] . '/includes/error.html.php'; 
                                exit(); 
                              }
                              else {

                          $filename=$_FILES['file-5']['tmp_name'];
                          $excelReader = PHPExcel_IOFactory::createReaderForFile( $filename);
                          $excelObj = $excelReader->load( $filename);
                          $worksheet = $excelObj->getActiveSheet();
                          $lastRow = $worksheet->getHighestDataRow(); 
                          $lastcolumn = $worksheet->getHighestDataColumn();
                         /* echo  $lastRow ;
                          echo "<br>";
                          echo $lastcolumn ;*/
                            
                          /* ----------------------check if the uploaded file is not for this section  ----------------------------*/
                          $two =2;
                          $uploaded_course_id = $worksheet->getCell('E'.$two)->getValue(); // get the course number from the first row
                         /* echo $uploaded_course_id;
                          echo"<br>";*/
                          $uploaded_section_id = $worksheet->getCell('G'.$two)->getValue(); // get the section number from the first row
                         /* echo $uploaded_section_id;
                          echo"<br>";*/
                          $uploaded_section_Year = $worksheet->getCell('A'.$two)->getValue(); // get the Academic Year from the first row
                       /*   echo $uploaded_section_Year;
                          echo"<br>";*/
                          $uploaded_section_semester = $worksheet->getCell('B'.$two)->getValue(); // get the Semester No from the first row
                      /*   echo  $uploaded_section_semester ;
                          echo"<br>";*/


                          if ( $Entered_Course_id == $uploaded_course_id && $Entered_Section_id == $uploaded_section_id 
                                &&  $Entered_semester == $uploaded_section_semester && $Entered_year == $uploaded_section_Year)

                          {
                                  
                                //add course information
                                 $course_name = $worksheet->getCell('F'.$two)->getValue();
                                 $course_CH = $worksheet->getCell('H'.$two)->getValue();
                                 $sql = "INSERT INTO `course`(`course_id`, `course_name`, `cridit_hour`)VALUES('$uploaded_course_id','$course_name','$course_CH')";
                                $conn->query($sql);

                                //getting teacher id 
                                $parseEmail = isset($_SESSION["useremail"]) ? $_SESSION["useremail"] :'';
                             // echo $parseEmail ;

                                $sql = "SELECT `teacher_id` 
                                        FROM `teacher_account`
                                        WHERE '$parseEmail' = teacher_account.email ";

                                $result = mysqli_query($conn,$sql);
                                $my_id_array=mysqli_fetch_assoc($result);
                                $teacher_id = $my_id_array['teacher_id'];
                               // echo $teacher_id;

                                //add section information
                                $sql = "INSERT INTO `section`(`section_id`, `course_id`, `teacher_id`, `capacity`, `section_year`, `section_semester`) 
                             VALUES ('$uploaded_section_id','$uploaded_course_id','$teacher_id','$lastRow','$uploaded_section_Year','$uploaded_section_semester')";
                                $conn->query($sql);
                                $conn->error;


                                  // loop for adding students' information 
                              for ($row = 2; $row <= $lastRow  ; $row++) 
                              {
                                 $student_id= $worksheet->getCell('C'.$row)->getValue();
                                // echo $student_id;
                                 $student_full_name = $worksheet->getCell('D'.$row)->getValue();
                                
                                 $sql = "INSERT INTO `student`(`student_id`, `student_name`) VALUES ('$student_id','$student_full_name')" ;
                                 $conn->query($sql);
                                 $conn->error;

                                 $sql = "INSERT INTO `students`(`student_id`, `course_id`, `section_id`, `section_year`, `section_semester`) 
                                      VALUES ('$student_id','$uploaded_course_id','$uploaded_section_id','$uploaded_section_Year','$uploaded_section_semester')" ;
                                 $conn->query($sql);
                                 $conn->error;

                               }

                          }
                          else {
                            echo ' The uploaded file is not for added section';
                          }
                              }
                          
                      }
                      else {
                        echo 'You are atempt to add an exist section for this course !';
                      }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Theme Made By www.w3schools.com - No Copyright -->

  <title>Home</title>
  <meta http-equiv="Content-Type" content="text/html" charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="utf-8">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="about.css">
  <link rel="stylesheet" href="logedin.css">
  <link rel="stylesheet" href="demo.css">
  <link rel="stylesheet" href="regestrationandmodel.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- for popup model -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
 

  <!-- for sign up form-->
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600' rel='stylesheet' type='text/css'>
  <link href="//netdna.bootstrapcdn.com/font-awesome/3.1.1/css/font-awesome.css" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

</head>
<body id="myPage2" data-spy="scroll" data-target=".navbar" style="background-color: #BDBDBD;" >
  
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
        <li><a id="logout" href="http://127.0.0.1/attendance%20app/about.php" class="hover" ><span class="glyphicon glyphicon-log-out"></span> Log Out </a></li>
          </ul>
          <div class="tabs">
              <ul class="tab-links">
                  <li class="active"><a href="#addTab" id="addSection">Add Section</a></li>
                  <li><a href="#deleteTab" id="deleteSection">Delete Section</a></li>
                  <li><a href="#getTab" id="getData">Get Data</a></li>
              </ul>
           
              <div class="tab-content">
                  <div id="addTab" class="tab active">
                      <div>
                           <label for="addTab"><b>Add Your New Section</b></label>
                           <form  action = "logedin.php" method="POST" id="AddSection" autocomplete="off" enctype="multipart/form-data"  >
                      <div class="cont">

                        <div id="form-group-course-id">
                        <label for="CourseId"><b>Course Id</b></label>
                        <input type="number" class="form-control input-lg" tabindex="2" placeholder="Enter Course Id" 
                                name="CourseId" id="CourseId" pattern=".{2,16}"  title="2 to 12 characters" required>
                        <span id="form-span-course-id" aria-hidden="true"></span>
                        </div></br>

                        <hr class="style-seven ">
                        <div id="form-group-section-id">
                        <label for="Sectionid"><b>Section Number</b></label>
                        <input type="number" class="form-control input-lg" tabindex="6" placeholder="Enter Section Number" name="Sectionid" id="Sectionid" required>
                        <span id="form-span-section-id" aria-hidden="true"></span>
                        </div></br>

                        <hr class="style-seven ">
                        <div id="form-group-year">
                        <label for="year"><b>Academic Year</b></label>
                        <div class="styled-select moveColor rounded">
                            <select required form="AddSection" size="1" id="year" tabindex="4" name="year">
                              <option value="2015">2015</option>
                              <option value="2016">2016</option>
                              <option value="2017">2017</option>
                              <option value="2018">2018</option>
                              <option value="2019">2019</option>
                              <option value="2020">2020</option>
                              <option value="2021">2021</option>
                            </select>
                          </div>
                        <span id="form-span-year" aria-hidden="true"></span>
                        </div></br>

                        <hr class="style-seven ">
                        <div id="form-group-semester">
                        <label for="semester"><b>Academic Semester</b></label>
                         <div class="styled-select moveColor rounded">
                              <select required form="AddSection" size="1" id="semester" tabindex="5" name="semester">
                                <option value="1">First Semester</option>
                                <option value="2">Second Semester</option>
                                <option value="3">Summer</option>
                              </select>
                            </div>
                          <span id="form-span-semester" aria-hidden="true"></span>
                          </div></br></br>

                      <!--  <hr class="style-seven ">
                        <label for="lect_day" ><b>Section's Lecture Day(s)</b></label>
                        <div class="row">
                          <div class="col-sm-5 col-md-2"><input type="checkbox" name="lect_day[]" id="lect_day" value="saturday">&nbsp Saturday</div>
                          <div class="col-sm-5 col-md-2"><input type="checkbox" name="lect_day[]" id="lect_day" value="sanday">&nbsp Sanday</div>
                          <div class="col-sm-5 col-md-2"><input type="checkbox" name="lect_day[]" id="lect_day" value="monday">&nbsp Monday</div>
                          <div class="col-sm-5 col-md-2"><input type="checkbox" name="lect_day[]" id="lect_day" value="tuseday">&nbsp Tuseday</div>
                          <div class="col-sm-5 col-md-2"><input type="checkbox" name="lect_day[]" id="lect_day" value="wednesday">&nbsp Wednesday</div>
                          <div class="col-sm-5 col-md-2"><input type="checkbox" name="lect_day[]" id="lect_day" value="thursday">&nbsp Thursday</div>
                        </div>-->

                        <hr class="style-seven ">
                        <div id="uploadIcon">
                        <input type="file" name="file-5" id="file-5" class="inputfile inputfile-4" style="display: none;" accept="xlsx" required>
                        <label for="file-5" tabindex="8"><figure><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg></figure> <span>Choose a file &hellip;</span></label>
                        </div>

                        </br></br>
                        <div class="clearfix">
                          <button type="submit" id="addbtn" class="btns" name="submitAdd" tabindex="9"><font color="white" size="3" >Add Section </font></button>
                        </div>
                      </div>
                    </form>
                     </div>
                  </div>
           
                  <div id="deleteTab" class="tab">
                     <div>
                      <label for="addTab"><b>Delete a Section</b></label>
                           <form  method="POST" id="DeleteSection" autocomplete="off">
                      <div class="cont">
                        <div id="form-group-delete-course-id">
                        <label for="CourseId"><b>Course Id</b></label>
                        <input type="number" class="form-control input-lg" tabindex="2" placeholder="Enter Course Id" 
                                name="CourseId" id="CourseId" pattern=".{2,16}"  title="2 to 12 characters" required>
                        <span id="form-span-delete-course-id" aria-hidden="true"></span>
                        </div></br>

                        <div id="form-group-year">
                        <label for="year"><b>Year</b></label>
                        <div class="styled-select moveColor rounded">
                            <select required form="AddSection" size="1" id="year">
                              <option value="2017">2016/2017</option>
                              <option value="2018">2017/2018</option>
                              <option value="2019">2018/2019</option>
                              <option value="2020">2019/2020</option>
                              <option value="2021">2020/2021</option>
                              <option value="2022">2021/2022</option>
                            </select>
                          </div>
                        <span id="form-span-year" aria-hidden="true"></span>
                        </div></br>

                        <div id="form-group-semester">
                        <label for="semester"><b>Semester</b></label>
                         <div class="styled-select moveColor rounded">
                              <select required form="AddSection" size="1" id="semester">
                                <option value="1">First Semester</option>
                                <option value="2">Second Semester</option>
                                <option value="3">Summer</option>
                              </select>
                            </div>
                          <span id="form-span-semester" aria-hidden="true"></span>
                          </div></br></br>

                        <div id="form-group-section-id">
                        <label for="Sectionid"><b>Section Number</b></label>
                        <input type="number" class="form-control input-lg" tabindex="3" placeholder="Enter Section Number" name="Sectionid" id="Sectionid" required>
                        <span id="form-span-section-id" aria-hidden="true"></span>
                        </div></br>

                        </br></br>
                        <div class="clearfix">
                          <button type="submit" id="deletebtn" class="btns"><font color="white" size="3" >Delete Section </font></button>
                        </div>
                      </div>
                    </form>
                     </div>
                  </div>
           
                  <div id="getTab" class="tab">
                      <font style =" font-family:""Comic Sans MS", cursive, sans-serif" color:black ;" color="black;">Tab #4 content goes here!</font>
                  </div>
              </div>
          </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
       <script type="text/javascript" src="logedinNew.js"></script> 
        </body>
</html>